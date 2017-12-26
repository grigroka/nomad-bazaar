<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;
use Session;
use Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listing = Listing::orderBy('id', 'desc')->paginate(10);
        return view('listings.index')->withListings($listing);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
//        Validate data.
        $this->validate($request, [
            'title' => 'required|max:255',
            'company_name' => 'required|max:255',
            'body' => 'required'
        ]);
//        Store in the DB.
        $user = Auth::user()->id;
        $listing = new Listing;

        $listing->title = $request->title;
        $listing->company_name = $request->company_name;
        $listing->body = $request->body;
        $listing->user()->associate($user);

        $listing->save();

        Session::flash('success', 'The listing was successfully saved!');

//        Redirect.
        return redirect()->route('listings.show', $listing->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing = Listing::find($id);
        return view('listings.show')->withListing($listing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return view('listings.edit')->withListing($listing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        // Validate data.
        $this->validate($request, [
            'title' => 'required|max:255',
            'company_name' => 'required|max:255',
            'body' => 'required'
        ]);

        $listing->title = $request->title;
        $listing->company_name = $request->company_name;
        $listing->body = $request->body;
        $listing->save();

        Session::flash('success', 'Listing updated');

        return redirect()->route('listings.show', $listing->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        Session::flash('success', 'Listing has been deleted.');
        return redirect()->route('home');

    }
}
