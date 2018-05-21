<?php
namespace App\Funciones;

use Auth;
use App;

class Funciones
{

    function formatTime($time)
    {
      if($time!=null)
      {
        $hora = strtotime($time );
        return date("g:i a", $hora);
      }
      return '';
    }
    /**
   * Formato de fecha : Sábado 23 de Marzo, 2018
   *
   * @return \Illuminate\Http\Response
   */
    function DateFormatString($fecha)
    {
       if($fecha)
       {
         $date = strtotime($fecha);
         $ano = date('Y', $date);
         $mes = date('n',$date);
         $dia = date('d',$date);
         $nombre_dia = date('w', $date);

         $dias=array(0=>"Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
         $meses=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                   "Agosto","Septiembre","Octubre","Noviembre","Diciembre");

         return $dias[$nombre_dia] ." ".$dia." de ". $meses[$mes]. ", ".$ano;
       }
       else{
         return '';
       }
     }
     /**
    * Nombre del día : Lunes..
    *
    * @return \Illuminate\Http\Response
    */
    function getNameDay($day)
    {
      if($day!=null)
      {
        $dias=array(0=>"Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

        return $dias[$day];
      }
      return '';
    }
    /**
   * Nombre del mes: Marzo
   *
   * @return \Illuminate\Http\Response
   */
    function getNameMonth($month)
    {
      if($month>0)
      {
        $meses = array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                  "Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        return $meses[$month];
      }
      else{
        return '';
      }

    }
    /**
   * Quita tildes y caracteres raros de un string
   *
   * @return \Illuminate\Http\Response
   */
    function sanear_string($cadena) {

       $string = $cadena;

       $string = str_replace(
           array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
           array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
           $string
       );

       $string = str_replace(
           array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
           array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
           $string
       );

       $string = str_replace(
           array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
           array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
           $string
       );

       $string = str_replace(
           array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
           array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
           $string
       );

       $string = str_replace(
           array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
           array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
           $string
       );

       $string = str_replace(
           array('ñ', 'Ñ', 'ç', 'Ç'),
           array('n', 'N', 'c', 'C'),
           $string
       );

       $string = str_replace(
           array(','),
           array(''),
           $string
       );

       $string = str_replace(
           array( "º", "-", "~",
                "#", "@", "|", "!", '"',
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "<", ";", ",", ":",
                "."),
           '',
           $string
       );


       $textoLimpio = $string;
       // ***************************

       $textoLimpio =strtolower($textoLimpio);
       return trim($textoLimpio);
     }
     /**
    * Quita string y caracteres raros de un string, reemplaza espacios por guiones
    *
    * @return \Illuminate\Http\Response
    */
     function clean_string($cadena)
     {
       $texto_cambiado = '';
       if($cadena && $cadena!="")
       {
         $texto = $this->sanear_string($cadena);
         $texto_cambiado = str_replace(" ", "-", $texto);
       }

       return $texto_cambiado;
     }





}
