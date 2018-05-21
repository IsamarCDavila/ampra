@extends('app.app')
@section('style')
@endsection
@section('script')
<script>
    var portafolio = {!!$portafolio!!};
    var banner = {!!$banner!!};
    var beneficios = {!!$beneficios!!};
    var multimedia = {!!$multimedia!!};
    var slider = {!!$slider!!};
    var clientes = {!!$clientes!!};
    var equipo = {!!$equipo!!};
    var equipo_responsive = {!!$equipo_responsive!!};
    var multimedia_responsive = {!!$multimedia_responsive!!};
</script>
    <script src="<?php echo URL::asset('js/bladePortafolio.js'); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpYCBfO_GoMUiIMF7QeDybKP-9czglOgI"></script>
    <script src="<?php echo URL::asset('js/mapa.js'); ?>"></script>

@endsection
<!-- /.heading-->

@section('content')
<div class="seccion_portafolio portafoliodetalle" id="portafolio">
    <v-app id="inspire">
    <div class="galeria_multimedia">
        <v-layout  row warp v-for="multi in multimedia">
            <v-flex xs12 sm4 v-for="item in multi.items">
                <div class="bloque_portafolio">
                    <div class="descripcion_galeria" v-bind:class="{'galeria_black' : (item.titulo!=null), 'bloque_posicion': (item.titulo==null)}">
                        <p class="text-center margin-center">@{{item.descripcion}}</p>
                        <h1 class="text-center" v-if="item.titulo!=null">@{{item.titulo}}</h1>
                    </div>
                </div>
            </v-flex>
        </v-layout>
    </div>




    <div class="section_slider_portafolio">
        <div class="slider_portafolio_responsive">
            <div v-for="item in multimedia_responsive">
                <a href="#" v-if="item.imagen_path!=null"><img :src="url+'/'+item.imagen_path" class="img-responsive" :alt="item.imagen"></a>
            </div>
        </div>
    </div>

    @include('front.includes.alquiler')
    <div class="hero_detalle text-center section_beneficios">
        <v-layout  row warp>
            <v-flex xs12 sm12>
                <h1 class="text-center">Beneficios</h1><br>
                <p class="descripcion">Lorem ipsum, dolor sit amet consectetur</p>
                <ul class="columns_li">
                    <li v-for="item in beneficios"><span>@{{item.cifra}}</span>
                      <p class="text-left">@{{item.detalle}}</p>
                    </li>
                </ul>
            </v-flex>
        </v-layout>
    </div>



    
    @include('front.includes.slider')
    <div class="container_2 section_escribenos">
        <img src="{{ url("/images/plano_centenario.png") }}" class="img_responsive img-responsive" alt="plano">
        <div class="text-center div_escribenos">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
            <a href="#footer" class="ancla_contactanos" data-ancla="footer"><span class="btn_escribenos">ESCRIBENOS</span></a>
        </div>
    </div>
    <div class="avatar_contenedor">
      <v-layout row warp v-for="section in equipo">
          <div class="layout warp" v-for="item in section.items">
            <v-flex xs12 sm6 v-if="item.position==0">
                <img :src="url + '/' + item.imagen_path" class="img-responsive" alt="item.imagen">
            </v-flex>
            <v-flex xs12 sm6>
                <div class="contendor_info text-center">
                    <div class="contendio">
                        <h3>@{{item.nombre}}</h3>
                        <hr class="hr_name">
                        <p>@{{item.descripcion}}</p>
                    </div>

                </div>
            </v-flex>
            <v-flex xs12 sm6 v-if="item.position==1">
                <img :src="url + '/' + item.imagen_path" class="img-responsive" alt="item.imagen">
            </v-flex>
        </div>
      </v-layout>
    </div>




    <div class="avatar_contenedor_section">
        <div class="avatar_contenedor_responsive">
            <div v-for="item in equipo_responsive">
                <a href="#"><img :src="url + '/' + item.imagen_path" class="img-responsive" :alt="item.imagen"></a>
                <div class="contendor_info text-center">
                    <div class="contendio">
                        <h3>@{{item.nombre}}</h3>
                        <hr class="hr_name">
                        <p> @{{item.descripcion}} </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('front.includes.banner')
    @include('front.includes.clientes')
    @include('front.includes.mapa_filtro')

    </v-app>
</div>




@endsection
