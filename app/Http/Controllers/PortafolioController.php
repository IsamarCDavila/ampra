<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pagina;
use App\DetallePortafolio;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;
use Funciones;

class PortafolioController extends Controller
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
    public function portafolio()
    {
      return view('admin.vistas.portafolio');
    }
    public function getPortafolio(Request $request)
    {
      $paginas = DetallePortafolio::paginate(25)->toArray();
      $response = array('data'=> $paginas['data'],
          'pagination' => ['current_page'=>$paginas['current_page']
          , 'total'=>$paginas['total']
          , 'per_page'=>$paginas['per_page']
          , 'from'=>$paginas['from']
          , 'to'=>$paginas['to']
          , 'last_page'=>$paginas['last_page']
          ]
        );

        // $response = Pagina::get();

      return response()->json($response);
    }
    /**
   * Display view to edit.
   *
   * @return \Illuminate\Http\Response
   */
    public function edit($id)
    {
      $portafolio = DetallePortafolio::where('id', '=', $id)
        ->first();

      return view('admin.vistas.editportafolio')
      ->with('portafolio', $portafolio);
    }
    /**
   * Display view to create.
   *
   * @return \Illuminate\Http\Response
   */
    public function create()
    {
      return view('admin.vistas.newportafolio');
    }
    public function store(Request $request)
    {
      $data = $request->all();

      $directory = 'upload/portafolio/';
      $data['pagina_id'] = 2;

       if (Input::hasFile('imagen_img'))
       {
          $fullName = Input::file('imagen_img')->getClientOriginalName();
          $filename = uniqid().'-'.$fullName;
          $f = Input::file('imagen_img')->move($directory, $directory.$filename);
          $data['imagen']=$filename;
          $data['imagen_path']=$directory.$filename;
       }
       if($request->input('menu') && $request->input('menu')!=""){
         $data['slug'] = Funciones::clean_string($request->input('menu'));
       }
       else{
         $data['slug'] = "detalle";
       }

       $item = DetallePortafolio::create($data);

      return redirect('/admin/portafolio');
    }
    public function update($id, Request $request)
    {
      $edit = DetallePortafolio::find($id);
      $edit->update($request->all());

      $directory = 'upload/portafolio/';

       if (Input::hasFile('imagen_img'))
       {
          $fullName = Input::file('imagen_img')->getClientOriginalName();
          $filename = uniqid().'-'.$fullName;
          $f = Input::file('imagen_img')->move($directory, $directory.$filename);
          File::delete($edit->imagen_path);
          $edit->imagen=$filename;
          $edit->imagen_path=$directory.$filename;
       }
       if($request->input('menu') && $request->input('menu')!=""){
         $edit->slug = Funciones::clean_string($request->input('menu'));
       }
       else{
         $edit->slug = "detalle";
       }

       $edit->save();
      return redirect('/admin/portafolio');
    }
    /**
   * Elimina un portafolio
   *
   * @return \Illuminate\Http\Response
   */
    public function delete($id, Request $request)
    {
      $relaciones = DetallePortafolio::where(function($query) use ($id) {
      $query->whereHas('beneficios')
        ->orwhereHas('multimedia')
        ->orwhereHas('imagenes');
      })
      ->where('id', '=', $id)
      ->get();


      if($relaciones!=null)
      {
        if(count($relaciones)>0)
        {
          return array('success'=>false, 'msg' => 'No se puede eliminar. El portafolio tiene elementos relacionados.');
        }
        else{

          $item = DetallePortafolio::find($id);
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
      else{

        $item = DetallePortafolio::find($id);
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
}
