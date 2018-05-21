<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacto;
use DB;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ContactoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function contacto()
    {
      return view('admin.vistas.contacto');
    }
    public function contactoviewnew()
    {
      return view('admin.vistas.contactoviewnew');
    }
    // public function contactoviewedit($id)
    // {
    //     return view('admin.vistas.contactoviewedit');
    // }
    /**
   * Display a listing of contacto con paginacion
   *
   * @return \Illuminate\Http\Response
   */
    public function getcontacto(Request $request)
    {
      $contacto = Contacto::paginate(10)
        ->toArray();

      $response = array('data'=> $contacto['data'],
          'pagination' => ['current_page'=>$contacto['current_page']
          , 'total'=>$contacto['total']
          , 'per_page'=>$contacto['per_page']
          , 'from'=>$contacto['from']
          , 'to'=>$contacto['to']
          , 'last_page'=>$contacto['last_page']
          ]
        );
      return response()->json($response);
    }

    public function contactoviewedit($id, Request $request)
    {
      $contacto = Contacto::where('id', '=', $id)->first();
      return view('admin.vistas.contactoviewedit')
        ->with('contacto', $contacto);
    }
    /**
   * Almacenar nuevo contacto
   *
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    {

      $data = $request->all();

      $directory = 'upload/contacto/';
      if (Input::hasFile('imagen_img'))
      {
         $fullName = Input::file('imagen_img')->getClientOriginalName();
         $filename = uniqid().'-'.$fullName;
         $f = Input::file('imagen_img')->move($directory, $directory.$filename);
         $data['imagen']=$filename;
         $data['imagen_path']=$directory.$filename;

      }

      $item = Contacto::create($data);

      return redirect('admin/contacto');
    }
    public function updatecontacto($id, Request $request)
    {
        $contacto = Contacto::find($id);
        $contacto->titulo = $request->input('titulo');
        $contacto->descripcion = $request->input('descripcion');
        $contacto->email = $request->input('email');
        $contacto->telefono = $request->input('telefono');
        $directory = 'upload/eventos/';
        if (Input::hasFile('imagen_img'))
        {
           $fullName = Input::file('imagen_img')->getClientOriginalName();
           $filename = uniqid().'-'.$fullName;
           $f = Input::file('imagen_img')->move($directory, $directory.$filename);
           $contacto->imagen=$filename;
           $contacto->imagen_path=$directory.$filename;

        }
        $contacto->save();
      return redirect('admin/contacto');

    }
}
