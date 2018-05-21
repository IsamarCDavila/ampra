<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
   * Muestra vista de certificaciones
   *
   * @return \Illuminate\Http\Response
   */
    public function certificaciones()
    {
      return view('admin.vistas.certificaciones');
    }
    /**
   * Muestra vista de servicios
   *
   * @return \Illuminate\Http\Response
   */
    public function servicios()
    {
      return view('admin.vistas.servicios');
    }
    /**
   * Display a listing of certificaciones con paginacion
   *
   * @return \Illuminate\Http\Response
   */
    public function getitems(Request $request)
    {
      $tipo = $request->input('tipo');

      $certificaciones = Item::where('tipo', '=', $tipo)
        ->paginate(25)
        ->toArray();

      $response = array('data'=> $certificaciones['data'],
          'pagination' => ['current_page'=>$certificaciones['current_page']
          , 'total'=>$certificaciones['total']
          , 'per_page'=>$certificaciones['per_page']
          , 'from'=>$certificaciones['from']
          , 'to'=>$certificaciones['to']
          , 'last_page'=>$certificaciones['last_page']
          ]
        );

      return response()->json($response);
    }
    /**
   * crea un item
   *
   * @return \Illuminate\Http\Response
   */
    public function store( Request $request)
    {

      try{
          $directory = 'upload/items/';
         if (Input::hasFile('imagen_img'))
         {
            $item = new Item();
            $item->titulo = $request->input('titulo');
            $item->descripcion = $request->input('descripcion');
            $item->tipo = $request->input('tipo');

            $fullName = Input::file('imagen_img')->getClientOriginalName();
            $filename = uniqid().'-'.$fullName;
            $f = Input::file('imagen_img')->move($directory, $directory.$filename);
            $item->imagen=$filename;
            $item->imagen_path=$directory.$filename;
            $item->save();

             return array('success'=>true, 'item' => $item);
         }
         else {
           return array('success'=>false, 'msg' => 'La imagen es obligatoria.');
         }

      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.', 'e'=>$e->getMessage());
      }


    }
    /**
   * Actualiza información de un item
   *
   * @return \Illuminate\Http\Response
   */
    public function update($id, Request $request)
    {

      try{
        $item = Item::find($id);
        $item->titulo = $request->input('titulo');
        $item->descripcion = $request->input('descripcion');

        $directory = 'upload/items/';
         if (Input::hasFile('imagen_img'))
         {
            $fullName = Input::file('imagen_img')->getClientOriginalName();
            $filename = uniqid().'-'.$fullName;
            $f = Input::file('imagen_img')->move($directory, $directory.$filename);
            File::delete($item->imagen_path);
            $item->imagen=$filename;
            $item->imagen_path=$directory.$filename;
         }

         $item->save();

         return array('success'=>true, 'item' => $item);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Elimina un item
   *
   * @return \Illuminate\Http\Response
   */
    public function delete($id, Request $request)
    {
      $item = Item::find($id);

      try{
        File::delete($item->imagen_path);
        $item->delete();
        return array('success'=>true);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.','e'=>$e->getMessage());
      }


    }


}
