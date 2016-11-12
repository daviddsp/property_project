<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyFacilities;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $property = Property::all();
        return response()->json([
            'data' => $property
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = $this->vadationStore($request->input());

        if($validator instanceof JsonResponse)
            return $validator;

        $property = new Property(); //intance model Property
        $property->title = $request->input('title');
        $property->description = $request->input('description');
        $property->address = $request->input('address');
        $property->town = $request->input('town');
        $property->country = $request->input('country');
        $property->state_id = $request->input('state_id');
        $property->user_id = 1; //Auth::id();
        $property->created_at = Carbon::now();
        $property->updated_at = Carbon::now();

        $property->save(); //save property

        //relationship save property_facilities
        $propertyFacilities = $property->property_facilities()->create([
            'id_property' => $property->id,
            'id_facility' => $request->input('id_facility')
        ]);

        return Response::json([
            'data' => 'save'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $property = Property::find($id);
        $test = $property->property_facilities()->where('id_property', $property->id)->first();
        //$property->property_facilities()->property_facilities;
        //$property->property_facilities()->id_facility;
        //$property->property_facilities()->id_property;
        //$propertyFacilities = $property->property_facilities;

        dd($test);
        //$propertyFacilities = $property->property_facilities()->where('id_property', $property->id)->get();






        //$property->property_facilities()->where('id_property', $property->id)->get();

        dd($property);
        return Response::json([
            'data' => $property
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $property = Property::findOrFail($id);
        $input = $request->all();
        $property->fill($input)->save();
        return Response::json([
            'data' => $property
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $property = Property::find($id);
        $property->delete();

        return Response::json([
            'data' => $property
        ], 200);

    }

    private function vadationStore($input)
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'address' => 'required',
            'town' => 'required',
            'country' => 'required',
            'state_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails())
            return response()->json([
                'errors' => [
                    'status'    => '422',
                    'source'    => [
                        'url' => request()->url(),
                        'method' => request()->getMethod()
                    ],
                    'title'     => 'Unprocessable Entity',
                    'detail'    => $validator->messages()
                ]
            ], 422);
    }
}
