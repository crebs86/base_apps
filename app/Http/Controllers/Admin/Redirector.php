<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Redirector extends Controller
{
    public function redirect(Request $request)
    {
        dd($request);
    }
}
