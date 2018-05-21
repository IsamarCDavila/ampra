<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DetallePortafolio;
use App\Beneficio;
use App\GaleriaSlick;
use App\GaleriaMultimedia;
use App\Equipo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;
use Funciones;
class DetallePortafolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function detalleportafolio($id)
    {
      $portafolio = DetallePortafolio::where('id', '=', $id)->select('nombre')->first();

      return view('admin.vistas.detalleportafolio')
      ->with('id_detalleportafolio', $id)
      ->with('portafolio', $portafolio);
    }
    public function getbeneficios(Request $request)
    {
        $beneficios= Beneficio::where('detalle_portafolio_id','=',$request->input('id_detailportfolio'))->get();
        return response()->json($beneficios);
    }
    public function getslick(Request $request)
    {
        $slicks= GaleriaSlick::where('detalle_portafolio_id','=',$request->input('id_detailportfolio'))->get();
        return response()->json($slicks);
    }
    public function getmultimedia(Request $request)
    {
        $multimedia= GaleriaMultimedia::where('detalle_portafolio_id','=',$request->input('id_detailportfolio'))->get();
        return response()->json($multimedia);
    }
    public function getequipo(Request $request)
    {
        $equipo= Equipo::where('detalle_portafolio_id','=',$request->input('id_detailportfolio'))->get();
        return response()->json($equipo);
    }
    public function editBeneficio($id_detalleportafolio,$id_beneficio)
     {
       $beneficio = Beneficio::where('id', '=', $id_beneficio)
       ->first();
       return view('admin.vistas.editbeneficio')
       ->with('beneficio', $beneficio)
       ->with('id_detalleportafolio', $id_detalleportafolio);
     }
    public function editMultimedia($id_detalleportafolio,$id_multimedia)
     {
       $multimedia = GaleriaMultimedia::where('id', '=', $id_multimedia)
       ->first();
       return view('admin.vistas.editmultimedia')
       ->with('multimedia', $multimedia)
       ->with('id_detalleportafolio', $id_detalleportafolio);
     }
    public function editSlick($id_detalleportafolio,$id_slick)
     {
       $slick = GaleriaSlick::where('id', '=', $id_slick)
       ->first();
       return view('admin.vistas.editslick')
       ->with('slick', $slick)
       ->with('id_detalleportafolio', $id_detalleportafolio);
     }
     public function createbeneficio(Request $request)
     {
         try{
           $beneficio = new Beneficio();
           $beneficio->detalle_portafolio_id = $request->input('iddetalleportafolio');
           $beneficio->cifra = $request->input('cifra');
           $beneficio->detalle = $request->input('detalle');
           $beneficio->save();
           return array('success'=>true, 'item' => $beneficio);
         }
         catch(\Exception $e){
           return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
         }
     }
     public function createimagen(Request $request)
     {
         try{
           $directory = 'upload/slick/';
          if (Input::hasFile('imagen_img'))
          {
             $imagen = new GaleriaSlick();
             $imagen->detalle_portafolio_id = $request->input('iddetalleportafolio');

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
     public function createmultimedia(Request $request)
     {
     try{
       $directory = 'upload/multimedia/';
      if (Input::hasFile('imagen_img_multimedia'))
      {
         $multimedia = new GaleriaMultimedia();
         $multimedia->detalle_portafolio_id = $request->input('iddetalleportafolio');
         $multimedia->titulo = $request->input('titulo');
         $multimedia->descripcion = $request->input('descripcion');
         $multimedia->video = $request->input('video');

         $fullName = Input::file('imagen_img_multimedia')->getClientOriginalName();
         $filename = uniqid().'-'.$fullName;
         $f = Input::file('imagen_img_multimedia')->move($directory, $directory.$filename);
        $multimedia->imagen=$filename;
        $multimedia->imagen_path=$directory.$filename;

         $multimedia->save();

          return array('success'=>true, 'item' =>$multimedia);
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
    * Crea un nuevo item de equipo
    *
    * @return \Illuminate\Http\Response
    */
     public function createequipo(Request $request)
     {
         try{
           $equipo = new Equipo();
           $equipo->detalle_portafolio_id = $request->input('iddetalleportafolio');
           $equipo->nombre = $request->input('nombre');
           $equipo->descripcion = $request->input('descripcion');

           $directory = 'upload/portafolio/';
            if (Input::hasFile('imagen_img'))
            {
               $fullName = Input::file('imagen_img')->getClientOriginalName();
               $filename = uniqid().'-'.$fullName;
               $f = Input::file('imagen_img')->move($directory, $directory.$filename);
               $equipo->imagen=$filename;
               $equipo->imagen_path=$directory.$filename;
            }

           $equipo->save();
           return array('success'=>true, 'item' => $equipo);
         }
         catch(\Exception $e){
           return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
         }
     }
     /**
    * Actualiza un beneficio de un determinado portafolio
    *
    * @return \Illuminate\Http\Response
    */
     public function updatebeneficio($id,Request $request)
     {
         try{
           $beneficio = Beneficio::find($id);
           $beneficio->cifra = $request->input('cifra');
           $beneficio->detalle = $request->input('detalle');
           $beneficio->save();
         return array('success'=>true, 'item' => $beneficio);
       }
       catch(\Exception $e){
         return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
       }
     }
     /**
    * Actualiza información de una imagen de slick
    *
    * @return \Illuminate\Http\Response
    */
     public function updateslick($id, Request $request)
     {

       try{
         $imagen = GaleriaSlick::find($id);

         $directory = 'upload/portafolio/';
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
    * Actualiza información de galeria multimedia
    *
    * @return \Illuminate\Http\Response
    */
     public function updatemultimedia($id, Request $request)
     {
         try{
           $multimedia = GaleriaMultimedia::find($id);
           $multimedia->titulo = $request->input('titulo');
           $multimedia->descripcion = $request->input('descripcion');
           $multimedia->video = $request->input('video');


           if (Input::hasFile('imagen_img'))
           {
              $directory = 'upload/portafolio/';
              $fullName = Input::file('imagen_img')->getClientOriginalName();
              $filename = uniqid().'-'.$fullName;
              $f = Input::file('imagen_img')->move($directory, $directory.$filename);
              File::delete($multimedia->imagen_path);
              $multimedia->imagen=$filename;
              $multimedia->imagen_path=$directory.$filename;

           }

           $multimedia->save();

           return array('success'=>true, 'item'=>$multimedia);
         }
         catch(\Exception $e){
           return array('success'=>false, 'msg'=> 'Hubo un error.', 'e'=>$e->getMessage());
         }

     }
     /**
    * actualiza item de equipo
    *
    * @return \Illuminate\Http\Response
    */
     public function updateequipo($id,Request $request)
     {
         try{
           $equipo = Equipo::find($id);
           $equipo->nombre = $request->input('nombre');
           $equipo->descripcion = $request->input('descripcion');

           $directory = 'upload/portafolio/';
            if (Input::hasFile('imagen_img'))
            {
               $fullName = Input::file('imagen_img')->getClientOriginalName();
               $filename = uniqid().'-'.$fullName;
               $f = Input::file('imagen_img')->move($directory, $directory.$filename);
               File::delete($equipo->imagen_path);
               $equipo->imagen=$filename;
               $equipo->imagen_path=$directory.$filename;
            }

           $equipo->save();
           return array('success'=>true, 'item' => $equipo);
         }
         catch(\Exception $e){
           return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
         }
     }
     /**
    * Elimina un beneficio
    *
    * @return \Illuminate\Http\Response
    */
     public function deletebeneficio($id, Request $request)
     {
       $item = Beneficio::find($id);

       try{
         $item->delete();
         return array('success'=>true);
       }
       catch(\Exception $e){
         return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
       }


     }
     /**
    * Elimina un multimedia
    *
    * @return \Illuminate\Http\Response
    */
     public function deletemultimedia($id, Request $request)
     {
       $item = GaleriaMultimedia::find($id);

       try{
         File::delete($item->imagen_path);
         $item->delete();
         return array('success'=>true);
       }
       catch(\Exception $e){
         return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
       }
     }
     /**
    * Elimina un slick
    *
    * @return \Illuminate\Http\Response
    */
     public function deleteslick($id, Request $request)
     {
       $item = GaleriaSlick::find($id);

       try{
         File::delete($item->imagen_path);
         $item->delete();
         return array('success'=>true);
       }
       catch(\Exception $e){
         return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
       }
     }
     /**
    * Elimina un equipo
    *
    * @return \Illuminate\Http\Response
    */
     public function deleteequipo($id, Request $request)
     {
       $item = Equipo::find($id);

       try{
         File::delete($item->imagen_path);
         $item->delete();
         return array('success'=>true);
       }
       catch(\Exception $e){
         return array('success'=>false, 'msg' => 'Lo sentimos. Ocurrió un error.');
       }
     }

}
