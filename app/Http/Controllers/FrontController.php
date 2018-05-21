<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pagina;
use App\Banner;
use App\DetallePortafolio;
use App\DetalleComunidad;
use App\GaleriaSlick;
use App\GaleriaMultimedia;
use App\GaleriaImagen;
use App\Beneficio;
use App\Cliente;
use App\Suscriptores;
use App\PaginaGaleria;
use App\Item;
use App\Equipo;
use App\Contacto;
use App\RedSocial;
use Funciones;

class FrontController extends Controller
{
    public function home()
    {
      $hero = Pagina::where('id', '=', 1)
        ->select('titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen')
        ->first();

      if($hero->imagen)
      {
        $hero->imagen = url('/'.$hero->imagen);
      }
      $slider = PaginaGaleria::inRandomOrder()
          ->where('pagina_id', '=',1)
          ->get();

      $banner = Banner::where('id', '=', 1)
        ->select('id', 'titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen','button as text_btn', 'link as href_btn', 'tipo_button')
        ->first();

      if($banner->imagen)
      {
        $banner->imagen = url('/'.$banner->imagen);
      }

      $banner_logo = Banner::where('id', '=', 2)
        ->select('titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen','button as text_btn', 'link as href_btn')
        ->first();

      if($banner_logo->imagen)
      {
        $banner_logo->imagen = url('/'.$banner_logo->imagen);
      }

      $portafolios = DetallePortafolio::select('nombre', 'introduccion'
        , 'imagen as imagen_alt','imagen_path', 'slug', 'id')
        ->get();

      $oficina = [];
      $i = 0;

      foreach ($portafolios as $key)
      {
        $item = [];
        $item['title'] = $key->nombre;
        $item['descripcion'] = $key->introduccion;
        $item['link'] = url('/portafolio/'.$key->id.'/'.$key->slug);
        $item['orden'] = $i;
        $item['imagen'] = "";

        if($key->imagen_path){
          $item['imagen'] = url('/'.$key->imagen_path);
          $item['imagen_alt'] = $key->imagen_alt;
        }
        $oficina[] = $item;
        $i++;
      }


      $servicios = Item::where('tipo', '=', 2)->get();

      return view('front.vistas.home')
      ->with('banner',json_encode($banner))
      ->with('banner_logo',json_encode($banner_logo))
      ->with('oficina',json_encode($oficina))
      ->with('slider',json_encode($slider))
      ->with('hero',json_encode($hero))
      ->with('servicios',json_encode($servicios))
      ->with('pagina','home');
    }
    public function nosotros()
    {
      $hero = Pagina::where('id', '=', 4)
        ->select('titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen')
        ->first();

      if($hero->imagen)
      {
        $hero->imagen = url('/'.$hero->imagen);
      }

      $banner = Banner::where('id', '=', 7)
        ->select('id','titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen','button as text_btn', 'link as href_btn', 'tipo_button')
        ->first();

      if($banner->imagen)
      {
        $banner->imagen = url('/'.$banner->imagen);
      }

      $portafolios = DetallePortafolio::select('nombre', 'introduccion'
        , 'imagen as imagen_alt','imagen_path', 'slug', 'id')
        ->get();

      $oficina = [];
      $i = 0;

      foreach ($portafolios as $key)
      {
        $item = [];
        $item['title'] = $key->nombre;
        $item['descripcion'] = $key->introduccion;
        $item['link'] = url('/portafolio/'.$key->id.'/'.$key->slug);
        $item['orden'] = $i;
        $item['imagen'] = "";

        if($key->imagen_path){
          $item['imagen'] = url('/'.$key->imagen_path);
          $item['imagen_alt'] = $key->imagen;
        }
        $oficina[] = $item;
        $i++;
      }

      $clientes = Cliente::get();

      $servicios = Item::where('tipo', '=', 2)->get();

      $slider = PaginaGaleria::inRandomOrder()
        ->where('pagina_id', '=',4)
        ->get();


      $certificaciones = Item::where('tipo', '=', 1)->get();

      $seccion_alquiler = Banner::where('id', '=', 5)
        ->select('titulo', 'descripcion', 'introduccion')
        ->first();

      $seccion_certificados = Banner::where('id', '=', 6)
        ->select('titulo', 'descripcion', 'introduccion')
        ->first();

      return view('front.vistas.nosotros')
      ->with('oficina',json_encode($oficina))
      ->with('certificaciones',json_encode($certificaciones))
      ->with('servicios',json_encode($servicios))
      ->with('slider',json_encode($slider))
      ->with('clientes',json_encode($clientes))
      ->with('banner',json_encode($banner))
      ->with('hero',json_encode($hero))
      ->with('seccion_alquiler',json_encode($seccion_alquiler))
      ->with('seccion_certificados',json_encode($seccion_certificados))
      ->with('pagina','nosotros');
    }
    public function portafolio()
    {
      $hero = Pagina::where('id', '=', 2)
        ->select('titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen')
        ->first();

      if($hero->imagen)
      {
        $hero->imagen = url('/'.$hero->imagen);
      }

      $banner_logo = Banner::where('id', '=', 3)
        ->select('titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen','button as text_btn', 'link as href_btn')
        ->first();

      if($banner_logo->imagen)
      {
        $banner_logo->imagen = url('/'.$banner_logo->imagen);
      }

      $portafolios = DetallePortafolio::select('nombre', 'introduccion'
        , 'imagen as imagen_alt','imagen_path', 'slug', 'id')
        ->get();

      $oficina = [];
      $i = 0;

      foreach ($portafolios as $key)
      {
        $item = [];
        $item['title'] = $key->nombre;
        $item['descripcion'] = $key->introduccion;
        $item['link'] = url('/portafolio/'.$key->id.'/'.$key->slug);
        $item['orden'] = $i;
        $item['imagen'] = "";

        if($key->imagen_path){
          $item['imagen'] = url('/'.$key->imagen_path);
          $item['imagen_alt'] = $key->imagen_alt;
        }
        $oficina[] = $item;
        $i++;
      }

      $servicios = Item::where('tipo', '=', 2)->get();

      return view('front.vistas.portafolio_landing')
      ->with('hero',json_encode($hero))
      ->with('banner_logo',json_encode($banner_logo))
      ->with('oficina',json_encode($oficina))
      ->with('servicios',json_encode($servicios))
      ->with('pagina','portafolio');
    }
    public function portafoliodetalle($id, $slug)
    {
      $portafolio = DetallePortafolio::where('id', '=', $id)->first();

      $hero = array(
        'imagen' =>'',
        'title' => $portafolio->nombre,
        'descripcion' => ''
      );
      if($portafolio->imagen_path)
      {
        $hero['imagen'] = url('/'.$portafolio->imagen_path);
      }


      $banner = Banner::where('id', '=', 1)
        ->select('id', 'titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen','button as text_btn', 'link as href_btn', 'tipo_button')
        ->first();

      if($banner->imagen)
      {
        $banner->imagen = url('/'.$banner->imagen);
      }

      $beneficios = Beneficio::where('detalle_portafolio_id', '=', $id)->get();
      $multimedia_sql = GaleriaMultimedia::where('detalle_portafolio_id', '=', $id)->get();
      $slick = GaleriaSlick::where('detalle_portafolio_id', '=', $id)->get();
      $clientes = Cliente::get();
      $equipo_sql = Equipo::where('detalle_portafolio_id', '=', $id)->get();

      $equipo = [];
      $section=[];
      $aux=0;
      $cant_items = 0;


      foreach ($equipo_sql as $key) {

        if($aux<2)
        {
          if ($cant_items%2==0){
            $key->{'position'} = 0;
          }
          else{
            $key->{'position'} = 1;
          }
          $section['items'][]=$key;
          $aux=$aux+1;
        }
        else{
          $equipo[]=$section;
          $cant_items++;
          $section=[];
          if ($cant_items%2==0){
            $key->{'position'} = 0;
          }
          else{
            $key->{'position'} = 1;
          }
          $section['items'][]=$key;
          $aux=0;
        }
      }
      if($section!=[])
      {
        $equipo[]=$section;
      }

      $multimedia= [];
      $section=[];
      $aux=0;
      $cant_items = 0;


      foreach ($multimedia_sql as $key) {

        if($aux<3)
        {
          $section['items'][]=$key;
          $aux=$aux+1;
        }
        else{
          $multimedia[]=$section;
          $cant_items++;
          $section=[];
          $section['items'][]=$key;
          $aux=0;
        }
      }
      if($section!=[])
      {
        $multimedia[]=$section;
      }

      return view('front.vistas.portafolio')
      ->with('banner',json_encode($banner))
      ->with('hero',json_encode($hero))
      ->with('clientes',json_encode($clientes))
      ->with('portafolio',json_encode($portafolio))
      ->with('beneficios',json_encode($beneficios))
      ->with('multimedia',json_encode($multimedia))
      ->with('multimedia_responsive',json_encode($multimedia_sql))
      ->with('equipo',json_encode($equipo))
      ->with('equipo_responsive',json_encode($equipo_sql))
      ->with('slider',json_encode($slick))
      ->with('pagina','portafoliodetalle');
    }

    public function comunidad()
    {

      $hero = Pagina::where('id', '=', 3)
        ->select('titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen', 'button')
        ->first();

      if($hero->imagen)
      {
        $hero->imagen = url('/'.$hero->imagen);
      }

      $banner = Banner::where('id', '=', 4)
        ->select('id','titulo as title', 'descripcion', 'imagen as imagen_alt','imagen_path as imagen','button as text_btn', 'link as href_btn', 'tipo_button')
        ->first();

      $eventos_sql = DetalleComunidad::leftjoin('detalle_portafolio', 'detalle_portafolio.id', '=', 'detalle_comunidad.detalle_portafolio_id')
        ->where('detalle_comunidad.tipo', '=', 1)
        ->select('detalle_comunidad.id', 'detalle_comunidad.fecha', 'detalle_comunidad.slug'
        , 'detalle_portafolio.nombre as portafolio', 'detalle_comunidad.hora_inicial'
        ,'detalle_comunidad.titulo', 'detalle_comunidad.imagen', 'detalle_comunidad.imagen_path')
        ->where('detalle_comunidad.estado', '=', 0)
        ->get();

      $eventos = [];

      foreach ($eventos_sql as $item)
      {
        $n_evento = [];
        $n_evento['dia'] = "";
        $n_evento['mes'] = "";
        $n_evento['imagen'] = "";
        $n_evento['imagen_alt'] = "";
        $n_evento['fecha'] = "";

        if($item->imagen_path)
        {
          $n_evento['imagen'] = url('/'.$item->imagen_path);
          $n_evento['imagen_alt'] =  $item->imagen;
        }

        if($item->fecha)
        {
          $date = strtotime($item->fecha);
          $n_evento['dia'] = date('d',$date);
          $n_evento['mes'] = Funciones::getNameMonth(date('n',$date));
          $n_evento['fecha'] = Funciones::DateFormatString($item->fecha);
        }

        $n_evento['hora'] = Funciones::formatTime($item->hora_inicial);
        $n_evento['portafolio'] = $item->portafolio;
        $n_evento['titulo'] = $item->titulo;
        $n_evento['link'] = url('/eventos/'.$item->id.'/'.$item->slug);

        $eventos[] = $n_evento;
      }

      $galeria_sql = DetalleComunidad::where('detalle_comunidad.tipo', '=', 2)
        ->select('id', 'fecha', 'slug','titulo', 'imagen', 'imagen_path')
        ->where('estado', '=', 0)
        ->get();

      $galeria = [];

      foreach ($galeria_sql as $item)
      {
        $n_galeria = [];
        $n_galeria['fecha'] = "";
        $n_galeria['imagen'] = "";
        $n_galeria['imagen_alt'] = "";

        if($item->imagen_path)
        {
          $n_galeria['imagen'] = url('/'.$item->imagen_path);
          $n_galeria['imagen_alt'] =  $item->imagen;
        }
        if($item->fecha)
        {
          $date = strtotime($item->fecha);
          $n_galeria['fecha'] = Funciones::DateFormatString($item->fecha);
        }

        $n_galeria['titulo'] = $item->titulo;
        $n_galeria['link'] = url('/galeria/'.$item->id.'/'.$item->slug);

        $galeria[] = $n_galeria;
      }
      
      return view('front.vistas.comunidad')
      ->with('banner',json_encode($banner))
      ->with('hero',json_encode($hero))
      ->with('galeria',json_encode($galeria))
      ->with('eventos',json_encode($eventos))
      ->with('pagina','comunidad');
    }
    public function evento($id, $slug)
    {
      $hero = array(
        'imagen' =>'',
        'title' =>'',
        'descripcion' => ''
      );

      $evento_sql = DetalleComunidad::where('id', '=', $id)
        ->first();

      $evento = [];
      if($evento_sql)
      {
        $evento['dia'] = "";
        $evento['mes'] = "";
        $evento['imagen'] = "";
        $evento['imagen_alt'] = "";
        $evento['fecha'] = "";

        if($evento_sql->imagen_path)
        {
          $evento['imagen'] = url('/'.$evento_sql->imagen_path);
          $evento['imagen_alt'] =  $evento_sql->imagen;
        }

        if($evento_sql->fecha)
        {
          $date = strtotime($evento_sql->fecha);
          $evento['dia'] = date('d',$date);
          $evento['mes'] = Funciones::getNameMonth(date('n',$date));
          $evento['fecha'] = Funciones::DateFormatString($evento_sql->fecha);
        }

        $evento['hora_inicial'] = Funciones::formatTime($evento_sql->hora_inicial);
        $evento['hora_final'] = Funciones::formatTime($evento_sql->hora_final);
        $evento['lugar'] = $evento_sql->lugar;
        $evento['titulo'] = $evento_sql->titulo;
        $evento['descripcion'] = $evento_sql->descripcion;
        $evento['link'] = url('/eventos/'.$evento_sql->id.'/'.$evento_sql->slug);

      }
      else{
        return redirect('/');
      }

      $otros_eventos_sql = DetalleComunidad::leftjoin('detalle_portafolio', 'detalle_portafolio.id', '=', 'detalle_comunidad.detalle_portafolio_id')
        ->where('detalle_comunidad.tipo', '=', 1)
        ->select('detalle_comunidad.id', 'detalle_comunidad.fecha', 'detalle_comunidad.slug'
        , 'detalle_portafolio.nombre as portafolio', 'detalle_comunidad.hora_inicial'
        ,'detalle_comunidad.titulo', 'detalle_comunidad.imagen', 'detalle_comunidad.imagen_path')
        ->where('detalle_comunidad.estado', '=', 0)
        ->inRandomOrder()
        ->take(4)
        ->get();

      $otros_eventos = [];

      foreach ($otros_eventos_sql as $item)
      {
        $n_evento = [];
        $n_evento['dia'] = "";
        $n_evento['mes'] = "";
        $n_evento['imagen'] = "";
        $n_evento['imagen_alt'] = "";
        $n_evento['fecha'] = "";

        if($item->imagen_path)
        {
          $n_evento['imagen'] = url('/'.$item->imagen_path);
          $n_evento['imagen_alt'] =  $item->imagen;
        }

        if($item->fecha)
        {
          $date = strtotime($item->fecha);
          $n_evento['dia'] = date('d',$date);
          $n_evento['mes'] = Funciones::getNameMonth(date('n',$date));
          $n_evento['fecha'] = Funciones::DateFormatString($item->fecha);
        }

        $n_evento['hora'] = Funciones::formatTime($item->hora_inicial);
        $n_evento['portafolio'] = $item->portafolio;
        $n_evento['titulo'] = $item->titulo;
        $n_evento['link'] = url('/eventos/'.$item->id.'/'.$item->slug);

        $otros_eventos[] = $n_evento;
      }

      return view('front.vistas.evento_detalle')
      ->with('hero',json_encode($hero))
      ->with('evento',json_encode($evento))
      ->with('otros_eventos',json_encode($otros_eventos))
      ->with('pagina','evento');
    }
    public function galeria($id, $slug)
    {
      $hero = array(
        'imagen' =>'',
        'title' =>'',
        'descripcion' => ''
      );

      $galeria_sql = DetalleComunidad::where('id', '=', $id)
        ->first();

      $galeria = [];
      if($galeria_sql)
      {
        $galeria['dia'] = "";
        $galeria['mes'] = "";
        $galeria['fecha'] = "";

        if($galeria_sql->fecha)
        {
          $date = strtotime($galeria_sql->fecha);
          $galeria['dia'] = date('d',$date);
          $galeria['mes'] = Funciones::getNameMonth(date('n',$date));
          $galeria['fecha'] = Funciones::DateFormatString($galeria_sql->fecha);
        }

        $galeria['hora_inicial'] = Funciones::formatTime($galeria_sql->hora_inicial);
        $galeria['hora_final'] = Funciones::formatTime($galeria_sql->hora_final);
        $galeria['titulo'] = $galeria_sql->titulo;
        $galeria['link_button'] = $galeria_sql->link_button;
        $galeria['link'] = url('/galeria/'.$galeria_sql->id.'/'.$galeria_sql->slug);

      }
      else{
        return redirect('/');
      }

      $imagenes_galeria = GaleriaImagen::where('detalle_comunidad_id', '=', $id)->get();

      $mas_galerias_sql = DetalleComunidad::where('detalle_comunidad.tipo', '=', 2)
        ->select('detalle_comunidad.id', 'detalle_comunidad.fecha', 'detalle_comunidad.slug','detalle_comunidad.hora_inicial'
        ,'detalle_comunidad.titulo', 'detalle_comunidad.imagen', 'detalle_comunidad.imagen_path')
        ->where('detalle_comunidad.estado', '=', 0)
        ->inRandomOrder()
        ->take(4)
        ->get();

      $mas_galerias = [];

      foreach ($mas_galerias_sql as $item)
      {
        $n_galeria = [];
        $n_galeria['imagen'] = "";
        $n_galeria['imagen_alt'] = "";
        $n_galeria['fecha'] = "";

        if($item->imagen_path)
        {
          $n_galeria['imagen'] = url('/'.$item->imagen_path);
          $n_galeria['imagen_alt'] =  $item->imagen;
        }

        if($item->fecha)
        {
          $n_galeria['fecha'] = Funciones::DateFormatString($item->fecha);
        }

        $n_galeria['titulo'] = $item->titulo;
        $n_galeria['link'] = url('/galeria/'.$item->id.'/'.$item->slug);

        $mas_galerias[] = $n_galeria;
      }

      return view('front.vistas.galeria_detalle')
      ->with('hero',json_encode($hero))
      ->with('galeria',json_encode($galeria))
      ->with('mas_galerias',json_encode($mas_galerias))
      ->with('imagenes_galeria',json_encode($imagenes_galeria))
      ->with('pagina','galeria');
    }
    public function datos()
    {
      $hero = array();
      return view('front.vistas.mensaje_envio')
      ->with('hero',json_encode($hero))
      ->with('pagina','mensaje');
    }
    public function descargararchivo(Request $request)
    {
      $id = $request->input('id_archivo');
      $data = $request->all();
      $data['descarga'] = 1;

      $item = Contacto::create($data);
      $hero = array();
      $archivo = Banner::where('id', '=', $id)->select('link')->first();

      return view('front.vistas.mensaje_carga')
      ->with('hero',json_encode($hero))
      ->with('archivo',$archivo)
      ->with('pagina','mensaje');
    }

    public function getmenuportafolio()
    {
      $menu = DetallePortafolio::select('id', 'menu', 'slug')
        ->get();

      $redes_sociales = RedSocial::where('url', '!=', '')->whereRaw('url is not null')->get();

        return array('menu'=>$menu, 'redes_sociales'=>$redes_sociales);
    }
    public function sendEmail(Request $request)
    {
      $data = $request->all();
      $item = Suscriptores::create($data);
      return redirect('/mensaje-datos');
    }
    public function sendContacto(Request $request)
    {
      $data = $request->all();
      // return $data;
      $item = Contacto::create($data);
      return redirect('/mensaje-datos');
    }


}
