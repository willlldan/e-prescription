<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Racikan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRacikanController extends Controller
{
    public function show($id)
    {

        $data = [
            'racikan' => Racikan::findOrFail($id),
            'listObat' => Racikan::findOrFail($id)->obatalkes
        ];

        return response()->json($data, Response::HTTP_OK);
    }
}
