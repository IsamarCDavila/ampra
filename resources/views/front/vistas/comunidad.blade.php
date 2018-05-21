@extends('app.app')
@section('style')
@endsection
@section('script')
<script>
    var banner = {!!$banner!!};
    var galeria = {!!$galeria!!};
    var eventos = {!!$eventos!!};
</script>
<script src="<?php echo URL::asset('js/bladeComunidad.js'); ?>"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpYCBfO_GoMUiIMF7QeDybKP-9czglOgI"></script>
<script src="<?php echo URL::asset('js/mapa.js'); ?>"></script> -->
@endsection
<!-- /.heading-->

@section('content')
<div class="comunidad" id="comunidad">
    <v-app id="inspire">
        <A name="eventos" id="eventos"> </A>
        <div class="container_2 text-center section_eventos">
            <div class="contenedor_eventos">
                <h1>Eventos</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>

            <v-layout  row warp v-for="(item, i) in eventos" v-if="i==0">
                <v-flex xs12 sm9>
                    <a :href="item.link">
                        <div class="contenedor_eventoL centrar_imgaen_background" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }">
                            <div class="contenido">
                                <v-layout  row warp>
                                    <v-flex xs12 sm3>
                                        <span>Evento de Fin de año</span>
                                        <h2>@{{item.titulo}}</h2>
                                    </v-flex>
                                </v-layout>
                                <v-layout  row warp class="contenedor_fecha">
                                    <v-flex xs12 sm5>
                                        <span class="mes">@{{item.mes}}</span>
                                        <h1 class="fecha">@{{item.dia}}</h1>
                                        <span class="hora">@{{item.hora}}</span>
                                    </v-flex>
                                </v-layout>
                                <v-layout  row warp>
                                    <v-flex xs12 sm12>
                                        <hr>
                                        <p>@{{item.portafolio}}</p>
                                    </v-flex>
                                </v-layout>
                            </div>

                        </div>
                    </a>
                </v-flex>
                <v-flex xs12 sm3>
                    <v-layout  row warp v-for="(item, i) in eventos" v-if="i>0 && i<3">
                        <a :href="item.link">
                            <div class="conten conten_1 centrar_imgaen_background" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }">
                                <h2>@{{item.titulo}}</h2>
                                <div class="contenedor_fecha">
                                    <span class="mes">@{{item.mes}}</span>
                                    <h1 class="fecha">@{{item.dia}}</h1>
                                    <span class="hora">@{{item.hora}}</span>
                                </div>
                                <hr>
                                <p>@{{item.portafolio}}</p>
                            </div>
                        </a>

                    </v-layout>

                </v-flex>
            </v-layout>
            <v-layout  row warp class="segunda_galeria">
                <v-layout xs12 sm3 v-for="(item, i) in eventos" v-if="i>2">
                    <a :href="item.link">
                        <div class="conten conten_2 content_inicial centrar_imgaen_background bloque_1" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }">
                            <h2>@{{item.titulo}}</h2>
                            <div class="contenedor_fecha">
                                <span class="mes">@{{item.mes}}</span>
                                <h1 class="fecha">@{{item.dia}}</h1>
                                <span class="hora">@{{item.hora}}</span>
                            </div>
                            <hr>
                            <p>@{{item.portafolio}}</p>
                        </div>
                    </a>

                </v-layout>

            </v-layout>
        </div>

        <div class="container_2">
            <div class="section_eventos_responsive">
                <div class="slider slider-single">
                    <div v-for="(item, i) in eventos">
                        <a :href="item.link">
                            <div class="conten conten_2 content_inicial centrar_imgaen_background bloque_1 background_image" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }">
                                <h3>@{{item.titulo}}</h3>
                                <div class="contenedor_fecha">
                                    <span class="mes">@{{item.mes}}</span>
                                    <h1 class="fecha">@{{item.dia}}</h1>
                                    <span class="hora">@{{item.hora}}</span>
                                </div>
                                <hr>
                                <p>@{{item.portafolio}}</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="slider slider-nav">
                    <div v-for="(item, i) in eventos">
                            <div class="conten conten_2 content_inicial centrar_imgaen_background bloque_1 background_image" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }">
                                <h4>@{{item.titulo}}</h4>
                                <div class="contenedor_fecha">
                                    <span class="mes">@{{item.mes}}</span>
                                    <h1 class="fecha">@{{item.dia}}</h1>
                                    <span class="hora">@{{item.hora}}</span>
                                </div>
                                <hr>
                                <p>@{{item.portafolio}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section_banner backcolor_gris">
           <v-form method="POST" id="formsendSuscribete"   :action="url_sendSuscribete" @submit="checkForm" accept-charset="UTF-8" novalidate="true" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <p v-if="errors.length">

                        <ul class="casillaerrores">
                            <li v-for="error in errors2">
                                <span class="error--text"  :value="true">
                                *    @{{ error }}
                                </span>
                            </li>
                        </ul>
                    </p>

                <p class="banner_suscribete">Suscribete a nuestras Publicaciones, para mantenerte informado de lo que ocurre en centenario, de manera gratuita</p>
                <span>
                    <input type="email" class="input_suscribete" v-model="email" id="email" name="email" placeholder="SUSCRIBIRSE">

                    <input class="btn-send btn_suscribete" type="submit" value="Enviar"></input>
                </span>
            </div>
            </v-form>

        <A name="galeria" id="galeria"> </A>
        <div class="container_2 responsive_galeria_comunidad">
            <div class="text-center">
                <h2>Galería</h2>
                <p>Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <div  class="slick_galeria_comunidad">
                <div class="oficina_slider">
                    <div v-for="(item, i) in eventos">
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
        <div class="container_2 galeria_comunidad text-center">
            <div class="contenedor_eventos">
                <h1>Galería</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam aliquid quasi porro </p>
            </div>

            <v-layout  row warp>
                <v-flex xs12 sm4 v-for="(item, i) in galeria" v-if="i<3">
                    <a :href="item.link">
                        <div class="conten conten_1 centrar_imgaen_background" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }"></div>
                        <div class="contenido_galeria">
                            <h3>@{{item.titulo}}</h3>
                            <p>@{{item.fecha}}</p>
                        </div>
                    </a>
                </v-flex>
            </v-layout>
            <v-layout  row warp>
                <v-flex xs12  v-for="(item, i) in galeria" v-if="i>2 && i<5" v-bind:class="{'sm4' : (i==3),'sm8' : (i==4)}">
                    <a :href="item.link">
                        <div class="conten conten_1 centrar_imgaen_background" v-bind:class="{'' : (i==3),'contend_1' : (i==4)}"  v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }"></div>
                        <div class="contenido_galeria" v-bind:class="{'' : (i==3),'contenido_grande' : (i==4)}">
                          <h3>@{{item.titulo}}</h3>
                          <p>@{{item.fecha}}</p>
                        </div>
                    </a>
                </v-flex>
            </v-layout>

              <v-layout row wrap >
                  <v-flex xs12 sm4 v-for="(item, i) in galeria" v-if="i>4">
                      <a :href="item.link">
                          <div class="conten conten_1 centrar_imgaen_background" v-bind:style="{ 'background-image': 'url('+ item.imagen + ')' }"></div>
                          <div class="contenido_galeria">
                            <h3>@{{item.titulo}}</h3>
                            <p>@{{item.fecha}}</p>
                          </div>
                      </a>

                  </v-flex>
                </v-layout>
        </div>

        @include('front.includes.banner')
        <A name="mapa_ancla" id="mapa_ancla"></A>
        @include('front.includes.mapa_filtro')
    </v-app>
</div>
@endsection
