<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

use App\Http\Requests;

class NearbyController extends Controller
{
    public function __construct()
    {
        $this->wechat = app('wechat');
    }

    public function index()
    {
        return view('nearby.list')->with('js', $this->wechat->js);
    }
}
