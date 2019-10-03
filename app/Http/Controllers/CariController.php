<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Crud;

class CariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $mbojo = $request->get('q');
        $hasil = posts::where('post_title', 'LIKE', '%' . $mbojo . '%')->paginate(10);

        return view('result', compact('hasil', 'mbojo'));
    }
}
