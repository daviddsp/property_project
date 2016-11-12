<?php

namespace App\Http\Controllers;

use App\State;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $state = State::all();
        return response()->json([
            'data' => $state
        ]);

    }
}
