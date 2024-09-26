<?php

namespace App\Http\Controllers;

use App\Models\Wallmount;
use Illuminate\Http\Request;

class WallmountPerangkatController extends Controller
{
    public function show($id)
    {
        // Ambil data wallmount beserta perangkat yang berelasi
        $wallmount = Wallmount::with('perangkat')->findOrFail($id);

        // Return view ke halaman resources-view-landing
        return view('landing.wallmount-detail', compact('wallmount'));
    }
}
