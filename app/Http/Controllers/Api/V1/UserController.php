<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ViewUserRank;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function get_karma_position(Request $request, $id)
    {

        $result_arr = $before_arr = $after_arr = array();

        $num = 5;

        if ($request->has('num'))
            $num = intval($request->num);


        // $results = DB::select(
        //     DB::raw("WITH karma_score_values AS ( SELECT *,RANK() OVER (PARTITION BY karma_score 
        //     ORDER BY karma_score DESC) 'position'
        //     -- ORDER BY position 
        //     FROM users)
        //     SELECT * FROM karma_score_values WHERE id = $id;")
        // );

        // $users_rank = ViewUserRank::query()->orderBy('id')->get()->all();

        // dd($users_rank);

        // ###########################################################################

        // fetch id,position list
        $users_positions = ViewUserRank::query()->pluck('position', 'id')->toArray();

        // check if id exits
        if (!Arr::exists($users_positions, $id)) {
            return response()->json([
                'message' => 'id not exist'
            ], 404);
        }

        $user_position = $users_positions[$id];

        // get first item depends rank
        $first_position = $users_positions[array_key_first($users_positions)];

        // get last item depends rank
        $last_position = $users_positions[array_key_last($users_positions)];

        // if this item is first 
        if ($user_position == $first_position) {
            $result_arr = array_slice($users_positions, $users_positions[$id] - 1, $num, true);
        }

        // if this item is last
        elseif ($user_position == $last_position) {
            $result_arr = array_slice($users_positions, $users_positions[$id] - $num, $num, true);
        }

        // Third
        else {
            if ($num % 2 == 0)
                $shift = $num / 2;
            else
                $shift = ($num - 1) / 2;

            $before_slice = abs($users_positions[$id] - $first_position);
            $after_slice = abs($users_positions[$id] - $last_position);

            // dd($before_slice);
            $before_amount = $before_slice > $shift ? $shift : $before_slice;
            $after_amount = $after_slice > $shift ? $shift : $after_slice;

            // complete number of users
            if ($before_amount < $shift && $after_slice > $shift) {
                $after_amount += ($shift - $before_amount);
            } elseif ($before_slice > $shift && $after_amount < $shift) {
                $before_amount += ($shift - $after_amount);
            }

            // store the lowest items
            $before_arr = array_slice($users_positions, $users_positions[$id] - 1 - $before_amount, $before_amount + 1, true);

            // store the highest items
            $after_arr = array_slice($users_positions, $users_positions[$id], $after_amount, true);

            $result_arr = $before_arr + $after_arr;
        }

        // get ids of items
        $id_arr = array_keys($result_arr);

        // fetch data for the selected items
        $items = ViewUserRank::whereIn('id', $id_arr)->orderBy('position')->get()->all();

        //  #####################################################################################



        // $users_rank = User::query()->selectRaw('id,karma_score,image_id,RANK() OVER (ORDER BY karma_score DESC) position')
        //     // ->where('id', $id)
        //     ->orderBy('position')
        //     ->get()->all();

        // $users_rank = collect($users_rank);
        // $user_position = $users_rank->contains(function ($user, $id) {
        //     return $user->id == $id;
        // });

        // dd($results);


        // $user_position = $users_rank.

        // dd($users_rank);

        // $users_rank = User::query()->orderBy('karma_score', 'DESC')->pluck('id')->toArray();

        // $users_positions = array_flip($users_rank);

        // $user_position = $users_positions[$id] + 1;

        // $first_position = $users_positions[array_key_first($users_positions)];
        // $last_position = $users_positions[array_key_last($users_positions)];

        // // first 
        // if ($users_positions[$id] == $first_position) {
        //     $result_arr = array_slice($users_positions, $users_positions[$id], $num, true);
        // }

        // // Second
        // elseif ($users_positions[$id] == $last_position) {
        //     $result_arr = array_slice($users_positions, $users_positions[$id] - $num + 1, $num, true);
        // }

        // // Third
        // else {
        //     if ($num % 2 == 0)
        //         $shift = $num / 2;
        //     else
        //         $shift = ($num - 1) / 2;

        //     $before_slice = abs($users_positions[$id] - $first_position);
        //     $after_slice = abs($users_positions[$id] - $last_position);

        //     $before_amount = $before_slice > $shift ? $shift : $before_slice;
        //     $after_amount = $after_slice > $shift ? $shift : $after_slice;

        //     if ($before_amount < $shift && $after_slice > $shift) {
        //         $after_amount += ($shift - $before_amount);
        //     } elseif ($before_slice > $shift && $after_amount < $shift) {
        //         $before_amount += ($shift - $after_amount);
        //     }

        //     $before_arr = array_slice($users_positions, $users_positions[$id] - $before_amount, $before_amount, true);

        //     $after_arr = array_slice($users_positions, $users_positions[$id], $after_amount + 1, true);

        //     $result_arr = $before_arr + $after_arr;
        // }

        // $id_arr = array_keys($result_arr);

        // $collection_01 = collect();
        // foreach ($result_arr as $k => $v) {
        //     $collection_01->push(['position' => $v + 1, 'id' => $k]);
        // }

        // // $items = User::query(['id', 'karma_score'])->with('image:id,url')->whereIn('id', $id_arr)->get();

        // $items = User::whereIn('users.id', $id_arr)->join('images', function ($join) {
        //     $join->on('images.id', '=', 'users.image_id');
        // })->select('users.id', 'users.karma_score', 'images.url')->get();

        // $collection = $items->map(function ($item) use ($collection_01) {
        //     $position = $collection_01->where('id', $item->id)->pluck('position');
        //     $item->position = $position[0];
        //     return $item;
        // });

        // $collection = $collection->sortBy('position')->values();

        return response()->json([

            'data' => $items,
        ], 200);
    }
}
