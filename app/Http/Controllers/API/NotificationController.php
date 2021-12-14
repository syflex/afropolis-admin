<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{

    public function read($id){

    }

    public function read_all(){
        $user = User::find(Auth::user()->id);
        $user->unreadNotifications()->update(['read_at' => now()]);
    }

    public function delete(){
        
    }
}
