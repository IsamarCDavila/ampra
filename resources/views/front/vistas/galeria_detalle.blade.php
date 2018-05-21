@extends('app.app')
@section('style')
  <script>
    var galeria = {!! $galeria !!};
    var mas_galerias = {!! $mas_galerias !!};
    var imagenes_galeria = {!! $imagenes_galeria !!};
  </script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/bladeGaleria.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div class="" id="galeria">
    <v-app id="inspire">
        <div class="hero_detalle">
            <v-layout  row wrap class="title">
                <v-flex xs12 sm2>
                    <div>
                        <span class="mes">@{{galeria.mes}}</span><br>
                        <span class="fecha">@{{galeria.dia}}</span>
                    </div>
                </v-flex>
                <v-flex xs12 sm7>
                    <h1>@{{galeria.titulo}}</h1>
                </v-flex>
            </v-layout>

            <v-layout  row wrap class="row_info">
                <v-flex xs12 sm8>
                    <v-layout  row>
                        <ul class="info_evento">
                            <li><i class="fa fa-calendar icono"></i>Fecha: <span>@{{galeria.fecha}}</span></li>
                            <li><i class="fa fa-clock-o icono"></i>Hora: <span>Desde las @{{galeria.hora_inicial}} hasta las @{{galeria.hora_final}}</span></li>
                        </ul>
                    </v-layout>
                </v-flex>
                <v-flex xs12 sm4 class="row_btn">
                    <a :href="galeria.link_button" v-if="galeria.link_button!=null && galeria.link_button!=''">
                     <span class="btn_face">VER ÁLBUM EN FACEBOOK</span>
                   </a>
                </v-flex>
            </v-layout>
        </div>

        <div class="container_2">
            <div class="otro_eventos">
                <v-layout  row wrap class="segunda_galeria">
                    <v-flex xs3 sm3 v-for="item in imagenes_galeria">
                        <div class="galeria_imagen" @click.stop="showDialog(item)">
                            <img :src="url + '/'+ item.imagen_path" class="img-responsive" :alt="item.imagen">
                        </div>
                    </v-flex>
                </v-layout>

            </div>
        </div>


        <div class="container_2">
            <div class="otra_galeria">
                <h1 class="text-center">Más Galería</h1>
                <v-layout  row warp class="segunda_galeria">
                    <v-flex xs12 sm4 v-for="item in mas_galerias">
                      <a :href="item.link">
                          <div class="conten conten_2 centrar_imgaen_background" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }"></div>
                          <div class="contenido_galeria">
                            <h3>@{{item.titulo}}</h3>
                            <p>@{{item.fecha}}</p>
                          </div>
                      </a>
                    </v-flex>
                </v-layout>
                <!-- <v-layout  row warp class="segunda_galeria responsive_galeria"></v-layout> -->
                <div class="main responsive_slider">
                    <div class="slider">
                        <div v-for="item in mas_galerias">
                            <a :href="item.link"><img :src="item.imagen"  class="img_slider img-responsive-slider" :alt="item.imagen_alt"></a>
                            <v-layout  row  >
                                <span>
                                    <h4>@{{item.titulo}}</h4>
                                    <p>@{{item.fecha}}</p>
                                </span>
                            </v-layout>

                        </div>

                    </div>
                </div>

            </div>
        </div>



        <v-dialog v-model="dialog2"  class="modal" max-width="500px">

          <v-card>

            <v-card-actions class="btn_modal">
               <v-avatar flat @click.stop="dialog2=false" style="z-index:1;cursor:pointer">
                    <v-icon>close</v-icon>
                </v-avatar>
            </v-card-actions>

            <v-card-text>
                <v-carousel v-model="carouselIndex">
                    <v-carousel-item v-for="(item,i) in imagenes_galeria" :src="url + '/' + item.imagen_path" :key="i" :value="actual_item"></v-carousel-item>
                </v-carousel>
            </v-card-text>
            <v-card-text>
              @{{galeria.titulo}}
            </v-card-text>
            <v-card-text>
                @{{galeria.fecha}}
            </v-card-text>

          </v-card>
        </v-dialog>


    </v-app>
</div>
@endsection
