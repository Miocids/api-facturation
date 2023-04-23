<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use Illuminate\Http\Request;
use App\Http\Resources\V1\FactureResource;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FactureResource::collection(Facture::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Facture $facture)
    {
        return new FactureResource($facture);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture)
    {
        if($facture->delete()){
            return response()->json([
                'message' => 'Success'
            ],204);
        }
        return response()->json([
            'message' => 'Not Found'
        ]);
    }
}
