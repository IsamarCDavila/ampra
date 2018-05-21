<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
   * Muestra vista de clientes
   *
   * @return \Illuminate\Http\Response
   */
    public function clientes()
    {
      return view('admin.vistas.clientes');
    }
    /**
   * Display a listing of clientes con paginacion
   *
   * @return \Illuminate\Http\Response
   */
    public function getclientes(Request $request)
    {
      $clientes = Cliente::paginate(25)->toArray();


      $response = array('data'=> $clientes['data'],
          'pagination' => ['current_page'=>$clientes['current_page']
          , 'total'=>$clientes['total']
          , 'per_page'=>$clientes['per_page']
          , 'from'=>$clientes['from']
          , 'to'=>$clientes['to']
          , 'last_page'=>$clientes['last_page']
          ]
        );

      return response()->json($response);
    }
    /**
   * crea uno cliente
   *
   * @return \Illuminate\Http\Response
   */
    public function store( Request $request)
    {
      try{
          $directory = 'upload/clientes/';
         if (Input::hasFile('imagen_img'))
         {
            $cliente = new Cliente();
            $cliente->nombre = $request->input('nombre');

            $fullName = Input::file('imagen_img')->getClientOriginalName();
            $filename = uniqid().'-'.$fullName;
            $f = Input::file('imagen_img')->move($directory, $directory.$filename);
            $cliente->logo=$filename;
            $cliente->logo_path=$directory.$filename;
            $cliente->save();

             return array('success'=>true, 'item' => $cliente);
         }
         else {
           return array('success'=>false, 'msg' => 'La imagen es obligatoria.');
         }

      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Actualiza información de un cliente
   *
   * @return \Illuminate\Http\Response
   */
    public function update($id, Request $request)
    {

      try{
        $cliente = Cliente::find($id);
        $cliente->nombre = $request->input('nombre');

        $directory = 'upload/clientes/';
         if (Input::hasFile('imagen_img'))
         {
            $fullName = Input::file('imagen_img')->getClientOriginalName();
            $filename = uniqid().'-'.$fullName;
            $f = Input::file('imagen_img')->move($directory, $directory.$filename);
            File::delete($cliente->logo_path);
            $cliente->logo=$filename;
            $cliente->logo_path=$directory.$filename;
         }

         $cliente->save();

         return array('success'=>true, 'item' => $cliente);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Elimina un cliente
   *
   * @return \Illuminate\Http\Response
   */
    public function delete($id, Request $request)
    {
      $cliente = Cliente::find($id);

      try{
        File::delete($cliente->logo_path);
        $cliente->delete();
        return array('success'=>true);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }


}
