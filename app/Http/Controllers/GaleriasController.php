<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleComunidad;
use App\DetallePortafolio;
use App\GaleriaImagen;
use DB;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Funciones;

class GaleriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function galerias()
    {
      return view('admin.vistas.galerias');
    }
    public function create()
    {
      return view('admin.vistas.newgaleria');
    }
    public function edit($id, Request $request)
    {
      $galeria = DetalleComunidad::where('id', '=', $id)->first();

      return view('admin.vistas.editgaleria')
        ->with('galeria', $galeria);
    }
    /**
   * Display a listing of galerias con paginacion
   *
   * @return \Illuminate\Http\Response
   */
    public function getgalerias(Request $request)
    {
      $galeria = DetalleComunidad::leftjoin('detalle_portafolio', 'detalle_portafolio.id', '=', 'detalle_comunidad.detalle_portafolio_id')
        ->where('tipo', '=', 2)
        ->select('detalle_comunidad.id'
          , 'detalle_comunidad.titulo'
          , 'detalle_comunidad.fecha'
          , 'detalle_comunidad.lugar'
          , 'detalle_comunidad.imagen_path'
          ,'detalle_portafolio.titulo as portafolio'
          )
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
   * Eliminar una galeria y todo su contenido relacionado.
   *
   * @return \Illuminate\Http\Response
   */
    public function deletegaleria($id, Request $request)
    {

      $galeria = DetalleComunidad::find($id);

      try{
        $imagenes = GaleriaImagen::where('detalle_comunidad_id', '=', $id)->get();

        foreach ($imagenes as $img) {
          File::delete($img->imagen_path);
        }
        $imagenes = GaleriaImagen::where('detalle_comunidad_id', '=', $id)->delete();

        File::delete($galeria->imagen_path);

        $galeria->delete();
        return array('success'=>true);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Almacenar nueva galeria
   *
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    {
      $data = $request->all();

      $directory = 'upload/galeria/';
      if (Input::hasFile('imagen_img'))
      {
         $fullName = Input::file('imagen_img')->getClientOriginalName();
         $filename = uniqid().'-'.$fullName;
         $f = Input::file('imagen_img')->move($directory, $directory.$filename);
         $data['imagen']=$filename;
         $data['imagen_path']=$directory.$filename;

      }
      if($data['titulo']!=null && $data['titulo']!=""){
        $data['slug'] = Funciones::clean_string($data['titulo']);
      }
      else{
        $data['slug'] = "galeria";
      }
      $data['tipo'] = 2;

      $item = DetalleComunidad::create($data);

      return redirect('admin/galeria');
    }
    /**
   * Actualizar una galeria
   *
   * @return \Illuminate\Http\Response
   */
    public function update($id, Request $request)
    {
      $data = $request->all();

      $directory = 'upload/galeria/';

      $item = DetalleComunidad::find($id);
      $item->estado = $data['estado'];
      $item->link_button = $data['link_button'];
      $item->fecha = $data['fecha'];
      $item->hora_inicial = $data['hora_inicial'];
      $item->hora_final = $data['hora_final'];
      $item->titulo = $data['titulo'];
      if($data['titulo']!=null && $data['titulo']!=""){
        $item->slug = Funciones::clean_string($data['titulo']);
      }
      else{
        $item->slug = "galeria";
      }

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


      return redirect('admin/galeria');
    }

    /**
 * Muestra vista de imagenes galeria
 *
 * @return \Illuminate\Http\Response
 */
  public function imagenesgaleria($id)
  {
    $galeria = DetalleComunidad::where('id', '=', $id)
      ->select('id', 'titulo')
      ->first();

    return view('admin.vistas.imagenesgaleria')
      ->with('galeria', $galeria);
  }
  /**
 * Display a listing of imagenes galeria con paginacion
 *
 * @return \Illuminate\Http\Response
 */
  public function getimagenesgaleria(Request $request)
  {
    $id_galeria = $request->input('id_galeria');
    $imagenes = GaleriaImagen::where('detalle_comunidad_id', '=', $id_galeria)
      ->paginate(25)->toArray();


    $response = array('data'=> $imagenes['data'],
        'pagination' => ['current_page'=>$imagenes['current_page']
        , 'total'=>$imagenes['total']
        , 'per_page'=>$imagenes['per_page']
        , 'from'=>$imagenes['from']
        , 'to'=>$imagenes['to']
        , 'last_page'=>$imagenes['last_page']
        ]
      );

    return response()->json($response);
  }
  /**
 * crea una nueva imagen galeria
 *
 * @return \Illuminate\Http\Response
 */
  public function createimagen( Request $request)
  {

    try{

        $directory = 'upload/galeria/';
       if (Input::hasFile('imagen_img'))
       {
          $imagen = new GaleriaImagen();
          $imagen->titulo = $request->input('titulo');
          $imagen->detalle_comunidad_id = $request->input('id_galeria');

          $fullName = Input::file('imagen_img')->getClientOriginalName();
          $filename = uniqid().'-'.$fullName;
          $f = Input::file('imagen_img')->move($directory, $directory.$filename);
          $imagen->imagen=$filename;
          $imagen->imagen_path=$directory.$filename;

           $imagen->save();

           return array('success'=>true, 'item' => $imagen);
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
 * Actualiza información de una imagen de galeria
 *
 * @return \Illuminate\Http\Response
 */
  public function updateimagen($id, Request $request)
  {

    try{
      $imagen = GaleriaImagen::find($id);
      $imagen->titulo = $request->input('titulo');

      $directory = 'upload/galeria/';
       if (Input::hasFile('imagen_img'))
       {
          $fullName = Input::file('imagen_img')->getClientOriginalName();
          $filename = uniqid().'-'.$fullName;
          $f = Input::file('imagen_img')->move($directory, $directory.$filename);
          File::delete($imagen->imagen_path);
          $imagen->imagen=$filename;
          $imagen->imagen_path=$directory.$filename;
       }

       $imagen->save();

       return array('success'=>true, 'item' => $imagen);
    }
    catch(\Exception $e){
      return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
    }


  }
  /**
 * Elimina una imagen de galeria
 *
 * @return \Illuminate\Http\Response
 */
  public function deleteimagen($id, Request $request)
  {
    $imagen = GaleriaImagen::find($id);

    try{
      File::delete($imagen->imagen_path);
      $imagen->delete();
      return array('success'=>true);
    }
    catch(\Exception $e){
      return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
    }


  }
}
