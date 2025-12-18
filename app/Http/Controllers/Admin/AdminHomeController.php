<?php

namespace App\Http\Controllers\Admin; // ← THIS MUST MATCH THE IMPORT

use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index()
    {
        return view('admin.home'); // your dashboard view
    }
}
