<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RedSocial;

class RedesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function redessociales()
    {
      return view('admin.vistas.redessociales');
    }
    /**
   * Display a listing of redes sociales con paginacion
   *
   * @return \Illuminate\Http\Response
   */
    public function getredessociales(Request $request)
    {
      $redes = RedSocial::paginate(25)->toArray();


      $response = array('data'=> $redes['data'],
          'pagination' => ['current_page'=>$redes['current_page']
          , 'total'=>$redes['total']
          , 'per_page'=>$redes['per_page']
          , 'from'=>$redes['from']
          , 'to'=>$redes['to']
          , 'last_page'=>$redes['last_page']
          ]
        );

      return response()->json($response);
    }
    /**
   * crea una nueva red social
   *
   * @return \Illuminate\Http\Response
   */
    public function createredsocial( Request $request)
    {

      try{
        $redsocial = new RedSocial();
        $redsocial->nombre = $request->input('nombre');
        $redsocial->icono = $request->input('icono');
        $redsocial->url = $request->input('url');
        $redsocial->save();
        return array('success'=>true, 'item' => $redsocial);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Actualiza información de una red social
   *
   * @return \Illuminate\Http\Response
   */
    public function updateredsocial($id, Request $request)
    {

      try{
        $redsocial = RedSocial::find($id);
        $redsocial->nombre = $request->input('nombre');
        $redsocial->icono = $request->input('icono');
        $redsocial->url = $request->input('url');
        $redsocial->save();
        return array('success'=>true, 'item' => $redsocial);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Elimina una redsocial
   *
   * @return \Illuminate\Http\Response
   */
    public function deleteredsocial($id, Request $request)
    {

      $redsocial = RedSocial::find($id);

      try{
        $redsocial->delete();
        return array('success'=>true);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }


}
