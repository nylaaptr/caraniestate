<?php

namespace App\Http\Controllers;

use App\Models\VisitorLog;

class VisitorController extends Controller
{
    public static function track($page)
    {
        VisitorLog::create([
            'ip_address' => request()->ip(),
            'page' => $page
        ]);
    }
}