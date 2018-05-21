<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Banner;
use App\Pagina;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;
class BannersController extends Controller
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
    public function banners($id)
    {
      $pagina = Pagina::where('id', '=', $id)->select('menu')->first();

      return view('admin.vistas.banners')
      ->with('id_pagina', $id)
      ->with('pagina', $pagina);
    }
    public function getbanners(Request $request)
    {

      $banners = Banner::where('pagina_id','=',$request->input('id'))->paginate(5)->toArray();
      $response = array('data'=> $banners['data'],
          'pagination' => ['current_page'=>$banners['current_page']
          , 'total'=>$banners['total']
          , 'per_page'=>$banners['per_page']
          , 'from'=>$banners['from']
          , 'to'=>$banners['to']
          , 'last_page'=>$banners['last_page']
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
    public function edit($id_pagina,$id_banner)
    {
      $banner = Banner::where('id', '=', $id_banner)
      ->first();

      $pagina = Pagina::where('id', '=', $id_pagina)->select('menu')->first();

      return view('admin.vistas.editbanners')
      ->with('banner', $banner)
      ->with('id_pagina', $id_pagina)
      ->with('pagina', $pagina);
    }
    public function update($id_pagina, $id, Request $request)
    {

      $edit = Banner::find($id);
      $edit->update($request->all());

      $directory = 'upload/banners/';

       if (Input::hasFile('imagen_img'))
       {
          $fullName = Input::file('imagen_img')->getClientOriginalName();
          $filename = uniqid().'-'.$fullName;
          $f = Input::file('imagen_img')->move($directory, $directory.$filename);
          File::delete($edit->imagen_path);
          $edit->imagen=$filename;
          $edit->imagen_path=$directory.$filename;
       }
       if (Input::hasFile('archivo'))
       {
          $fullName = Input::file('archivo')->getClientOriginalName();
          $filename = uniqid().'-'.$fullName;
          $f = Input::file('archivo')->move($directory, $directory.$filename);
          if($edit->tipo_button==1){
            File::delete($edit->link);
          }

          $edit->link=$directory.$filename;
          $edit->tipo_button=1;
       }
       $edit->save();

      return redirect('/admin/paginas/'.$id_pagina.'/banner');
    }
    /**
   * Eliminar un archivo relacionado a un banner
   *
   * @return \Illuminate\Http\Response
   */
    public function removearchivo($id_banner)
    {
      $banner = Banner::find($id_banner);

      try{
        if($banner->tipo_button==1){
          File::delete($banner->link);
        }
        $banner->link=null;
        $banner->tipo_button=0;
        $banner->save();

        return array('success'=>true);
      }
      catch(\Exception $e){
          return array('success'=>false, 'msg'=>'Hubo un error.', 'e'=> $e->getMessage());
      }
    }
}
