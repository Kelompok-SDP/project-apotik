<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'max:50', 'alpha'],
            'nomor1' => ['required', 'max:15'],
            'nomor2' => ['required', 'max:15'],
        ]);

        return Info::create($request->all());
    }
}
