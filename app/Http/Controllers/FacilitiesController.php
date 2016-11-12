<?php

namespace App\Http\Controllers;

use App\Facilities;


class facilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $facilities = Facilities::all();
        return response()->json([
            'data' => $facilities
        ]);

    }
}
