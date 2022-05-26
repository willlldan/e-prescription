<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ObatAlkes;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiObatAlkesController extends Controller
{
    public function show($id)
    {
        return response()->json(ObatAlkes::findOrFail($id), Response::HTTP_OK);
    }
}
