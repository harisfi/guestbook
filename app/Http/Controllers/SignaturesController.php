<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignaturesController extends Controller
{
    /**
     * Display the Guestbook homepage.
     * 
     * @return view
     */
    public function index()
    {
        return view('signatures.index');
    }

    /**
     * Display the Guestbook form page.
     * 
     * @return view
     */
    public function create()
    {
        return view('signatures.sign');
    }
}
