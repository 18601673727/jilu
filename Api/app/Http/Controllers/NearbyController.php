<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

use App\Http\Requests;

use App\Location;

class NearbyController extends Controller
{
    public function __construct()
    {
        $this->wechat = app('wechat');
    }

    public function index()
    {
        $location = Location::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(1)->first();

        return view('nearby.list')->with('js', $this->wechat->js)->with('location', $location);
    }
}
