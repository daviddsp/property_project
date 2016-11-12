<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$routeExcept = [
    'except' => [
        'create',
        'edit',
    ]
];
Route::group(['prefix' => 'v1'], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');

    Route::resource('facilities', 'FacilitiesController', [
        'except' => [
            'create',
            'edit',
            'destroy'
        ]
    ]);

    Route::resource('state', 'StateController', [
        'except' => [
            'create',
            'edit',
            'destroy'
        ]
    ]);

    Route::resource('property', 'PropertyController');

});
