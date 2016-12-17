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
        $location = Location::where('user_id', auth()->user()->id)->take(1)->first(['latitude', 'longitude']);
        $user = auth()->user();
        $location->avatar = $user->avatar;
        $location->nickname = $user->nickname;
        $location->gender = $user->gender;

        // Others location
        $nearby = DB::select(
            '
SELECT 
  user_id, latitude, longitude, ( 6371 * acos( cos( radians(:latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:longitude) ) + sin( radians(:latitude_dupe) ) * sin( radians( latitude ) ) ) ) AS distance,
  users.nickname, users.avatar, users.gender
FROM locations 
INNER JOIN users ON locations.user_id = users.id
WHERE user_id <> :mine_id HAVING distance < :distance
ORDER BY distance LIMIT 0, 20
            ',
            [
                'latitude' => $location->latitude,
                'latitude_dupe' => $location->latitude,
                'longitude' => $location->longitude,
                'distance' => 50,
                'mine_id' => $user->id,
            ]
        );

        array_unshift($nearby, $location);

        // TODO: check if $nearby is null?
        return view('nearby.list')->with('locations', $nearby);
    }
}
