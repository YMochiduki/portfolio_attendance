<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplanationController extends Controller
{
    public function explanation()
    {
        return view('user.explanation');
    }
}
