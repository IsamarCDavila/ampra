<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pagina;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;

class PaginasController extends Controller
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
    public function paginas()
    {
      return view('admin.vistas.paginas');
    }
    public function getpaginas(Request $request)
    {
      $paginas = Pagina::paginate(5)->toArray();
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
      $pagina = Pagina::where('id', '=', $id)
        ->first();

      return view('admin.vistas.editpaginas')
      ->with('pagina', $pagina);
    }
    public function update($id, Request $request)
    {
      $edit = Pagina::find($id);
      $edit->update($request->all());

      $directory = 'upload/images/';

       if (Input::hasFile('imagen_img'))
       {
          $fullName = Input::file('imagen_img')->getClientOriginalName();
          $filename = uniqid().'-'.$fullName;
          $f = Input::file('imagen_img')->move($directory, $directory.$filename);
          File::delete($edit->imagen_path);
          $edit->imagen=$filename;
          $edit->imagen_path=$directory.$filename;
       }
       $edit->save();
      return redirect('/admin/paginas');
    }
}
