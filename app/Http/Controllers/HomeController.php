<?php

namespace App\Http\Controllers;

use App\Models\Navigation;

class HomeController extends Controller
{
    public function index()
    {
        $navigations = Navigation::with('children')
            ->where('parent_id', 0)    
            ->where('is_active', 1)
            ->orderBy('position')
            ->get();

        return view('/home', compact('navigations'));
    }
}
