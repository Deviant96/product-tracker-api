<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site = Site::all();
        return response()->json($site);
    }

    public function show($id)
    {
        $site = Site::with('products')
                ->findOrFail($id);
        return response()->json($site);
    }
}
