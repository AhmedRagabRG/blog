<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DarkModeController extends Controller
{
    public function switch()
    {
        session([
            'dark_mode' => session()->has('dark_mode') ? !session()->get('dark_mode') : true
        ]);

        dd(session()->get('dark_mode'));
        return back();
    }
}
