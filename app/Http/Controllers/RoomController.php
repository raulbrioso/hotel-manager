<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class RoomController
 * @package App\Http\Controllers
 */
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkstatus();
        $rooms = Room::with('users')->paginate();
        $hotels = Hotel::pluck('name','id');
        //$hotels = array_merge([''=>''], Hotel::pluck('name','id')->toArray());
        

        return view('room.index', compact('rooms','hotels'))
            ->with('i', (request()->input('page', 1) - 1) * $rooms->perPage());
    }
    
    public function indexfilter(Request $request)
    {

        $this->checkstatus();
        $rooms = Room::with('users');
        $hotels = Hotel::pluck('name','id')->toArray();

        if($request->has('name_filter') && $request->input('name_filter')!=''){
            $name_filter = $request->input('name_filter');
            $rooms->where('name','like','%'.$name_filter.'%');
        }
        if($request->has('status_filter') && $request->input('status_filter')!=null){
            $status_filter = $request->input('status_filter');
            $rooms->where('status',$status_filter);
        }
        if($request->has('hotel_filter') && $request->input('hotel_filter')!=null){
            $hotel_filter = $request->input('hotel_filter');
            $rooms->where('hotel_id',$hotel_filter);
        }
        //$sql = dd($rooms->toSql(), $rooms->getBindings());
        $rooms = $rooms->paginate();
        
        $filtered = true;

        return view('room.index', compact('rooms','hotels','name_filter','status_filter','hotel_filter','filtered'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room = new Room();
        $hotels = Hotel::pluck('name','id');
        return view('room.create', compact('room','hotels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Room::$rules);

        $room = Room::create($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        return view('room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        $hotels = Hotel::pluck('name','id');
        return view('room.edit', compact('room','hotels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        request()->validate(Room::$rules);

        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $room = Room::find($id)->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully');
    }

    public function reservation($id)
    {
        $room = Room::find($id);

        return view('room.reservation', compact('room'));
    }

    public function reservationstore(Request $request)
    {
        request()->validate([
            'checkin' => 'required|lte:checkout',
            'checkout' => 'required',
        ]);

        $reservation = [
            $request->input('user_id') => [
                'checkin' => $request->input('checkin'),
                'checkout' => $request->input('checkout')
            ]
        ];
            
        $room = Room::find($request->input('room_id'));
        $room->users()->attach($reservation);
        $room->update(['status'=>1]);

        return view('room.show', compact('room'))
            ->with('success', 'Room reserved successfully.');
    }

    public function checkout(Request $request)
    {
        $room = Room::find($request->input('room_id'))->update(['status' => 0]);
        $users = DB::table('room_user')
        ->where('room_id',$request->input('room_id'))
        ->where('user_id',auth()->user()->id)
        ->update(['checkout' => \Carbon\Carbon::now()->format('Y-m-d')]);

        return response(json_encode($users),200)->header('Content-type','text/plain');
    }

    public function checkstatus()
    {
        $rooms = Room::with('users')->paginate();
        foreach($rooms as $room){
            $users = DB::table('room_user')
            ->selectRaw('COUNT(*) as count')
            ->whereRaw("room_id = ? AND (checkin < '".\Carbon\Carbon::now()."' AND checkout > '".\Carbon\Carbon::now()."')", [$room->id])
            ->first();
            if($users->count>0){
                if(!$room->status){
                    $room->update(['status'=>1]);
                }
            }else{
                if($room->status){
                    $room->update(['status'=>0]);
                }
            }
        }
    }

    //API
    public function list($hotel_id,Request $request)
    {
        $rooms = Room::where('hotel_id',$hotel_id);
        if($request->has('status')){
            $rooms->where('status',$request->input('status'));
        }
        if($request->has('name')){
            $rooms->where('name','like','%'.$request->input('name').'%');
        }
        
        return response()->json($rooms->get());
    }
}
