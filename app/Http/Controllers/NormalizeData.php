<?php

namespace App\Http\Controllers;

class NormalizeData extends Controller
{
    public function index()
    {
        return view('pages.normalize.index');
    }

    public function update()
    {
        return redirect(route('normalize.index'));
    }
}
