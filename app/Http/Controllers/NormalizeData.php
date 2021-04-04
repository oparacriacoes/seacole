<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NormalizeData extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.normalize.index');
    }
}
