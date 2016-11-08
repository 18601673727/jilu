<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Location;

class NearbyController extends Controller
{
    public function __construct()
    {
        $this->wechat = app('wechat');
    }

    public function index()
    {
        // Current user's location
        $mine = Location::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(1)->first();

        // Others location
        $others = DB::select('SELECT user_id, ( 6371 * acos( cos( radians(:latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:longitude) ) + sin( radians(:latitude_dupe) ) * sin( radians( latitude ) ) ) ) AS distance FROM locations WHERE user_id <> :mine_id HAVING distance < :distance ORDER BY distance LIMIT 0, 20', [
            'latitude' => $mine->latitude,
            'latitude_dupe' => $mine->latitude,
            'longitude' => $mine->longitude,
            'distance' => 50,
            'mine_id' => auth()->user()->id,
        ]);

        Log::info(json_encode(['result'=>$others]));

        return view('nearby.list')
            ->with('js', $this->wechat->js)
            ->with('others', $others)
            ->with('mine', $mine);
    }
}
