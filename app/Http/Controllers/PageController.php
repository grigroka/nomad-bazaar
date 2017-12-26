<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;
use Mail;
use Session;
use DB;

class PageController extends Controller
{
    public function getIndex() {
        $listings = Listing::orderBy('created_at', 'desc')->whereDate('created_at', DB::raw('CURDATE()'))->get();
        return view('pages.welcome')->withListings($listings);
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this -> validate($request, [
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'min:10'
        ]);

        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        ];

        Mail::send('emails.contact', $data, function($message) use($data) {
            $message->from($data['email']);
            $message->to('example@gmail.com'); // Contact us destination address.
            $message->subject($data['subject']);
        });

        Session::flash('success', 'Your Email was Sent!');

        return redirect('/');
    }
}
