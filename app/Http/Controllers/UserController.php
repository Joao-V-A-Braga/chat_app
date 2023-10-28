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
            $posts = User::query()
                ->select('id', 'name as text')
                ->where('name', 'LIKE', '%' . $term . '%')
                ->where('id', '!=', auth()->user()->id)
                ->orderBy('name', 'asc')->simplePaginate(10);

            $morePages = true;
            $pagination_obj = json_encode($posts);
            if (empty($posts->nextPageUrl())) {
                $morePages = false;
            }

            $results = array(
                "results" => $posts->items(),
                "pagination" => array(
                    "more" => $morePages
                )
            );

            return \Response::json($results);
        }
    }
}
