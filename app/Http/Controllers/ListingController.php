<?php

namespace App\Http\Controllers;

use App\Listing;
use App\Tag;
use Illuminate\Http\Request;
use Session;
use Auth;
use Image;
use File;

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
        $tags = Tag::all();
        return view('listings.create')->withTags($tags);
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
            'body' => 'required',
            'logo' => 'sometimes|image'
        ]);
//        Store in the DB.
        $user = Auth::user()->id;
        $listing = new Listing;

        $listing->title = $request->title;
        $listing->company_name = $request->company_name;
        $listing->body = $request->body;
        $listing->user()->associate($user);

//        Save logo image.
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(125, 125)->save($location);

            $listing->logo = $filename;
        }

        $listing->save();

        $listing->tags()->sync($request->tags, false);

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
        $tags = Tag::all();
        return view('listings.edit')->withListing($listing)->withTags($tags);
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
            'body' => 'required',
            'logo' => 'image'
        ]);

        $listing->title = $request->title;
        $listing->company_name = $request->company_name;
        $listing->body = $request->body;

        if ($request->hasFile('logo')) {
//            Add new photo
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(125, 125)->save($location);
            $oldFilename = $listing->logo;
//            Update database
            $listing->logo = $filename;
//            Delete old photo
            File::delete(public_path('images/' . $oldFilename));
        }

        $listing->save();

        $listing->tags()->sync($request->tags);

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
        $listing->tags()->detach();
        File::delete(public_path('images/' . $listing->logo));
        $listing->delete();

        Session::flash('success', 'Listing has been deleted.');
        return redirect()->route('home');

    }
}
