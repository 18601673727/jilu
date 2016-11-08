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
        $mine = Location::where('user_id', auth()->user()->id)->take(1)->first();

        // Others location
        $others = DB::select('
            SELECT user_id, latitude, longitude, ( 6371 * acos( cos( radians(:latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:longitude) ) + sin( radians(:latitude_dupe) ) * sin( radians( latitude ) ) ) ) AS distance
            FROM locations WHERE user_id <> :mine_id HAVING distance < :distance
            ORDER BY distance LIMIT 0, 20', [
            'latitude' => $mine->latitude,
            'latitude_dupe' => $mine->latitude,
            'longitude' => $mine->longitude,
            'distance' => 50,
            'mine_id' => auth()->user()->id,
        ]);

        $locations = array_unshift($others, $mine);

        Log::info(json_encode(['locations' => $locations]));

        // TODO: check if $others is null?
        return view('nearby.list')->with('locations', $locations);
    }
}
