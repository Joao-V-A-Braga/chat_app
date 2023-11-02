<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function select2(Request $request)
    {
        if ($request->ajax()) {
            $term = trim($request->term);
            $users = User::query()
                ->select('id', 'name', 'profile_photo_path')
                ->where('name', 'LIKE', '%' . $term . '%')
                ->where('id', '!=', auth()->user()->id)
                ->orderBy('name', 'asc')->simplePaginate(10);

            $morePages = true;
            $pagination_obj = json_encode($users);
            if (empty($users->nextPageUrl())) {
                $morePages = false;
            }

            $results = array(
                "results" => $users->items(),
                "pagination" => array(
                    "more" => $morePages
                )
            );

            return \Response::json($results);
        }
    }
}
