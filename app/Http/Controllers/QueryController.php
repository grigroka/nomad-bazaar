<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;
use DB;

class QueryController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|max:255'
        ]);
        $query = $request->search;
        $results = DB::table('listings')->where('title', 'LIKE', '%' . $query . '%')->orWhere('company_name', 'LIKE', '%' . $query .'%')->orWhere('body', 'LIKE', '%' . $query . '%')->get();
        return view('pages.search')->withResults($results);
    }
}
