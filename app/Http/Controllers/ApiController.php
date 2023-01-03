<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $response = ["status"=>0,"msg"=>""];

        $data = json_decode($request->getContent());

        $user = User::where('email',$data->email)->first();

        if($user){
            if(Hash::check($data->password, $user->password)){

                $token = $user->createToken('token');
                $response['status'] = 1; 
                $response['msg'] = $token->plainTextToken; 

            }else{
                $response['msg'] = "Incorrect credentials."; 
            }
        }else{
            $response['msg'] = "User not found.";
        }

        return response()->json($response);
    }
}
