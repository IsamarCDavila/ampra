@extends('app.app')
@section('style')
@endsection
@section('script')
<script src="<?php echo URL::asset('js/bladeMensaje1.js'); ?>"></script>

@endsection
<!-- /.heading-->

@section('content')
<div class="mensaje_carga" id="mensaje_carga">
    <v-app id="inspire">
        <div class="seccion_hero">
            <div id="hero">
                <div class="contenedor_hero">
                    <div class="mensaje">
                        <h1>Gracias por descargar el brochure y enviar tus datos</h1>
                        <div class="descripcion_hero">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex in repudiandae temporibus dicta nostrum aliquam dolorum.</p>
                        </div>
                    </div>
                    <a class="download-link" href="{{url('/'.$archivo->link)}}" download="centenario" style="display:none;">Descargar</a>
                </div>
            </div>
        </div>

    </v-app>
</div>
@endsection
