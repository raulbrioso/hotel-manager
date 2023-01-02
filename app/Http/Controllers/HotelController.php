<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Province;
use App\Models\Country;
use Illuminate\Http\Request;

/**
 * Class HotelController
 * @package App\Http\Controllers
 */
class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::paginate();

        return view('hotel.index', compact('hotels'))
            ->with('i', (request()->input('page', 1) - 1) * $hotels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotel = new Hotel();
        $provinces = Province::pluck('name','id');
        $countries = Country::pluck('name','id');
        return view('hotel.create', compact('hotel','provinces','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Hotel::$rules);

        $hotel = Hotel::create($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Hotel::find($id);

        return view('hotel.show', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::find($id);
        $provinces = Province::pluck('name','id');
        $countries = Country::pluck('name','id');

        return view('hotel.edit', compact('hotel','provinces','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Hotel $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        request()->validate(Hotel::$rules);

        $hotel->update($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id)->delete();

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel deleted successfully');
    }
}
