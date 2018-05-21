<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Suscriptores;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class SuscriptoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function suscriptores()
    {
      return view('admin.vistas.suscriptores');
    }
    public function getsuscriptores(Request $request)
    {
      $suscribete = Suscriptores::paginate(8)
        ->toArray();

      $response = array('data'=> $suscribete['data'],
          'pagination' => ['current_page'=>$suscribete['current_page']
          , 'total'=>$suscribete['total']
          , 'per_page'=>$suscribete['per_page']
          , 'from'=>$suscribete['from']
          , 'to'=>$suscribete['to']
          , 'last_page'=>$suscribete['last_page']
          ]
        );
      return response()->json($response);
    }
    // public function suscriptoresviewnew()
    // {
    //   return view('admin.vistas.suscriptoresviewnew');
    // }
    // public function suscriptoresviewedit($id)
    // {
    //     return view('admin.vistas.suscriptoresviewedit');
    // }
}
