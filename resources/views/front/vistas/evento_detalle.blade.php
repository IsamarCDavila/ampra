@extends('app.app')
@section('style')
  <script>
    var evento = {!! $evento !!};
    var otros_eventos = {!! $otros_eventos !!};
  </script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/bladeEvento.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div class="evento" id="evento">
    <v-app id="inspire">
        <div class="hero_detalle">
            <v-layout  row wrap class="title">
                <v-flex xs12 sm2>
                    <div>
                        <span class="mes">@{{evento.mes}}</span><br>
                        <span class="fecha">@{{evento.dia}}</span>
                    </div>
                </v-flex>
                <v-flex xs12 sm7>
                    <h1>@{{evento.titulo}}</h1>
                </v-flex>
            </v-layout>

            <v-layout  row wrap>
                <v-flex xs12 sm6>
                    <img :src="evento.imagen" class="img-responsive" alt="evento.imagen_alt">
                </v-flex>
                <v-flex xs12 sm6>
                    <v-layout  row>
                        <ul class="info_evento">
                            <li><i class="fa fa-calendar icono"></i>Fecha: <span>@{{evento.fecha}}</span></li>
                            <li><i class="fa fa-clock-o icono"></i>Hora: <span>Desde las @{{evento.hora_inicial}} hasta las @{{evento.hora_final}}</span></li>
                            <li><i class="fa fa-map-marker icono"></i>Lugar: <span>@{{evento.lugar}}</span></li>
                        </ul>
                    </v-layout>
                    <v-layout  row class="contenido_header">
                        <p>@{{evento.descripcion}}</p>
                    </v-layout>
                    <v-layout  row>
                        <div class="redes_compartir">
                            <span>Compartir evento:</span> <br>
                            <ul class="ul_redes">
                                <li>
                                  <a @click="shareFacebook(evento);">
                                    <i class="fa fa-facebook"></i><span class="span_face">24</span>
                                  </a>
                                </li>
                                <li>
                                  <a :href="'http://twitter.com/share?text='+evento.titulo+'&url='+evento.link" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                    <i class="fa fa-twitter"></i><span>133</span>
                                  </a>
                                </li>
                            </ul>
                        </div>
                    </v-layout>
                </v-flex>
            </v-layout>
        </div>
        <div class="container_2">
            <div>
                <img src="{{ url("/images/plano_zoom.png") }}" class="img-responsive" alt="imagen">
            </div>
        </div>

        <div class="container_2">
            <div class="otro_eventos">
                <h1 class="text-center">Otros Eventos</h1>
                <v-layout  row warp class="segunda_galeria">
                    <v-flex xs12 sm3 v-for="item in otros_eventos">
                      <a :href="item.link">
                        <div class="conten conten_2 content_inicial centrar_imgaen_background bloque_1" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }">
                            <h2>@{{item.titulo}}</h2>
                            <div class="contenedor_fecha">
                                <span class="mes">@{{item.mes}}</span>
                                <h1 class="fecha">@{{item.dia}}</h1>
                                <p class="hora">@{{item.hora_inicial}}</p>
                            </div>
                            <hr>
                            <p>@{{item.portafolio}}</p>
                        </div>
                      </a>
                    </v-flex>

                </v-layout>

                <div class="main responsive_slider">
                    <div class="slider">
                        <div v-for="item in otros_eventos">
                            <a :href="item.link">
                                <div class="conten conten_2 content_inicial centrar_imgaen_background bloque_1" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }">
                                    <h2>@{{item.titulo}}</h2>
                                    <div class="contenedor_fecha">
                                        <span class="mes">@{{item.mes}}</span>
                                        <h1 class="fecha">@{{item.dia}}</h1>
                                        <span class="hora">@{{item.hora_inicial}}</span>
                                    </div>
                                    <hr>
                                    <p>@{{item.portafolio}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </v-app>
</div>
@endsection
