<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class realTimeController extends Controller
{
    function realTime()
    {
        // Pusher credentials
        $options = [
            'cluster' => env('Pusher_cluster'),
            'useTLS' => true
        ];
        
        $pusher = new Pusher(
            env('Pusher_key'),
            env('Pusher_secret'),
            env('Pusher_app_id'),
            $options
        );
        
        // Sample event trigger
        $data = ['message' => 'Hello, real-time world!'];
        $pusher->trigger('channel-kasim', 'auctionEvent', $data);
        
        echo "Event triggered!";
        
    }
}
