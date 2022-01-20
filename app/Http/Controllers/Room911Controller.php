<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Room911;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class Room911Controller extends Controller
{
    
    public function index(){
        return view('room.index');
    }

    public function access(Request $request){
        $user = \Auth::user();

        if( !$user->hasPermission('room_access')){
            $room = new Room911;

            $room->user_id = $request->user_id;
            $room->status = env('ROOM_WITHOUT_PERMISSION_ACCESS');

            $room->save();
            Alert::error('Permission Error', "You don't have permissions to access this room");
            return redirect('/access-room');

        }

        if( $user->id != $request->user_id || $user->user_pin != $request->user_pin ){
            $room = new Room911;

            $room->user_id = $request->user_id;
            $room->status = env('ROOM_ACCESS_DENY');

            $room->save();
            Alert::error('Authentication Error', "User ID or PIN where invalid");
            return redirect('/access-room');
        }

        Session::put('access-room', true);
        Alert::success('Room 911', "You are in room 911 now");
        return redirect('/room911');

    }

    public function room(){
        if ( !Session::has('access-room') ){
            Alert::error('Error', "You have not been accessed to room 911");
            return redirect('/access-room');    
        }

        return view('room.room');
    }

    public function getOut(){
        Session::forget('access-room');
        Alert::success('Success', "You are out of room 911");
        return redirect('/dashboard');
    }

}
