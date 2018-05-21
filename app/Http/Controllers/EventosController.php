<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleComunidad;
use App\DetallePortafolio;
use DB;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Funciones;

class EventosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function eventos()
    {
      return view('admin.vistas.eventos');
    }
    public function create()
    {
      $portafolios = DetallePortafolio::select(DB::raw('nombre as text'), DB::raw('id as value'))->get();

      return view('admin.vistas.newevento')
        ->with('portafolios', $portafolios);
    }
    public function edit($id, Request $request)
    {
      $portafolios = DetallePortafolio::select(DB::raw('nombre as text'), DB::raw('id as value'))->get();

      $evento = DetalleComunidad::where('id', '=', $id)->first();

      return view('admin.vistas.editevento')
        ->with('evento', $evento)
        ->with('portafolios', $portafolios);
    }
    /**
   * Display a listing of eventos con paginacion
   *
   * @return \Illuminate\Http\Response
   */
    public function geteventos(Request $request)
    {
      $eventos = DetalleComunidad::leftjoin('detalle_portafolio', 'detalle_portafolio.id', '=', 'detalle_comunidad.detalle_portafolio_id')
        ->where('tipo', '=', 1)
        ->select('detalle_comunidad.id'
          , 'detalle_comunidad.titulo'
          , 'detalle_comunidad.fecha'
          , 'detalle_comunidad.lugar'
          , 'detalle_comunidad.imagen_path'
          ,'detalle_portafolio.titulo as portafolio'
          )
        ->paginate(25)
        ->toArray();

      $response = array('data'=> $eventos['data'],
          'pagination' => ['current_page'=>$eventos['current_page']
          , 'total'=>$eventos['total']
          , 'per_page'=>$eventos['per_page']
          , 'from'=>$eventos['from']
          , 'to'=>$eventos['to']
          , 'last_page'=>$eventos['last_page']
          ]
        );

      return response()->json($response);
    }
    /**
   * Eliminar un evento
   *
   * @return \Illuminate\Http\Response
   */
    public function deleteevento($id, Request $request)
    {

      $evento = DetalleComunidad::find($id);

      try{
        File::delete($evento->imagen_path);
        $evento->delete();
        return array('success'=>true);
      }
      catch(\Exception $e){
        return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
      }


    }
    /**
   * Almacenar nuevo evento
   *
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    {
      $data = $request->all();

      $directory = 'upload/eventos/';
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
        $data['slug'] = "evento";
      }
      $data['tipo'] = 1;

      $item = DetalleComunidad::create($data);

      return redirect('admin/eventos');
    }
    /**
   * Actualizar un  evento
   *
   * @return \Illuminate\Http\Response
   */
    public function update($id, Request $request)
    {
      $data = $request->all();

      $directory = 'upload/eventos/';

      $item = DetalleComunidad::find($id);
      $item->estado = $data['estado'];
      $item->fecha = $data['fecha'];
      $item->lugar = $data['lugar'];
      $item->detalle_portafolio_id = $data['detalle_portafolio_id'];
      $item->hora_inicial = $data['hora_inicial'];
      $item->hora_final = $data['hora_final'];
      $item->titulo = $data['titulo'];
      if($data['titulo']!=null && $data['titulo']!=""){
        $item->slug = Funciones::clean_string($data['titulo']);
      }
      else{
        $item->slug = "evento";
      }
      $item->descripcion = $data['descripcion'];

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


      return redirect('admin/eventos');
    }
}
