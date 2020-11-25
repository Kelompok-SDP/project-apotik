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

    public function show()
    {
        $info = Info::first();

        $info->nomor1 = "0" . substr($info->nomor1, 2, strlen($info->nomor1));
        $info->nomor2 = "0" . substr($info->nomor2, 2, strlen($info->nomor2));
        return $info;
    }

    public function create(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'max:50'],
            'nomor1' => ['required', 'max:15', 'min:13'],
            'nomor2' => ['max:15', 'min:13'],
        ]);

        $data = $request->all();
        $data['nomor1'] = "62" . substr($data['nomor1'], 1, strlen($data['nomor1']));
        if ($request->nomor2) {
            $data['nomor2'] = "62" . substr($data['nomor2'], 1, strlen($data['nomor2']));
        }
        return Info::create($data);
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'max:50'],
            'nomor1' => ['required', 'max:15', 'min:12'],
        ]);
        $info = Info::first();
        $data = $request->all();
        $data['nomor1'] = "62" . substr($data['nomor1'], 1, strlen($data['nomor1']));
        if ($request->nomor2) {
            $data['nomor2'] = "62" . substr($data['nomor2'], 1, strlen($data['nomor2']));
        }

        return $info->update($data);
    }
}
