<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaginaGaleria;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Pagina;

class GaleriaPaginaController extends Controller
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
    public function galeria($id)
    {
      $pagina = Pagina::where('id', '=', $id)
        ->select('menu', 'id')
        ->first();

      return view('admin.vistas.galeriapaginas')
        ->with('pagina', $pagina);
    }
    /**
   * Display a listing of paginasgaleria con paginacion
   *
   * @return \Illuminate\Http\Response
   */
    public function getpaginasgaleria($id, Request $request)
    {
      $galeria = PaginaGaleria::where('pagina_id', '=', $id)
        ->paginate(25)
        ->toArray();


      $response = array('data'=> $galeria['data'],
          'pagination' => ['current_page'=>$galeria['current_page']
          , 'total'=>$galeria['total']
          , 'per_page'=>$galeria['per_page']
          , 'from'=>$galeria['from']
          , 'to'=>$galeria['to']
          , 'last_page'=>$galeria['last_page']
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
          $directory = 'upload/paginas/';
         if (Input::hasFile('imagen_img'))
         {
            $galeria = new PaginaGaleria();
            $galeria->pagina_id = $request->input('pagina_id');

            $fullName = Input::file('imagen_img')->getClientOriginalName();
            $filename = uniqid().'-'.$fullName;
            $f = Input::file('imagen_img')->move($directory, $directory.$filename);
            $galeria->imagen=$filename;
            $galeria->imagen_path=$directory.$filename;
            $galeria->save();

             return array('success'=>true, 'item' => $galeria);
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
   * Actualiza información de una imagen
   *
   * @return \Illuminate\Http\Response
   */
    public function update($id, Request $request)
    {

      try{
        $galeria = PaginaGaleria::find($id);
        $galeria->pagina_id = $request->input('pagina_id');

        $directory = 'upload/paginas/';
         if (Input::hasFile('imagen_img'))
         {
            $fullName = Input::file('imagen_img')->getClientOriginalName();
            $filename = uniqid().'-'.$fullName;
            $f = Input::file('imagen_img')->move($directory, $directory.$filename);
            File::delete($galeria->imagen_path);
            $galeria->imagen=$filename;
            $galeria->imagen_path=$directory.$filename;
         }

         $galeria->save();

         return array('success'=>true, 'item' => $galeria);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Elimina una galeria
   *
   * @return \Illuminate\Http\Response
   */
    public function delete($id, Request $request)
    {
      $galeria = PaginaGaleria::find($id);

      try{
        File::delete($galeria->imagen_path);
        $galeria->delete();
        return array('success'=>true);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }


}
