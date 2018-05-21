@extends('app.app')
@section('style')
@endsection
@section('script')
    <script>
        var banner = {!!$banner!!};
        var oficina = {!!$oficina!!};
        var clientes = {!!$clientes!!};
        var servicios = {!!$servicios!!};
        var slider = {!!$slider!!};
        var certificaciones = {!!$certificaciones!!};
        var seccion_alquiler = {!!$seccion_alquiler!!};
        var seccion_certificados = {!!$seccion_certificados!!};
    </script>
    <script src="<?php echo URL::asset('js/bladeNosotros.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div class="nosotros" id="nosotros">
    <v-app id="inspire">
    @include('front.includes.alquiler')
    @include('front.includes.slider')
    @include('front.includes.clientes')
    <div class="hero_detalle secccion_nosotros certificados">
        <v-layout  row warp>
            <v-flex xs12 sm12>
                <h1 class="text-center">@{{seccion_certificados.titulo}}</h1><br>
                <p>@{{seccion_certificados.descripcion}}
                </p>
            </v-flex>
        </v-layout>
        <v-layout  row  class="section_certificaciones">
            <v-flex xs12 sm3 v-for="item in certificaciones">
                <div class="container_card">
                    <v-card>
                        <v-card-media :src="item.imagen" height="150px"></v-card-media>
                        <v-card-title primary-title>
                            <div>
                            <h3 class="headline mb-0">@{{item.title}}</h3>
                            <div>@{{item.descripcion}}</div>
                            </div>
                        </v-card-title>
                    </v-card>
                </div>
            </v-flex>
            <!-- <v-flex xs12 sm3>
                <div class="container_card">
                    <v-card>
                        <v-card-media src="images/real.png" height="150px"></v-card-media>
                        <v-card-title primary-title>
                            <div>
                            <h3 class="headline mb-0">Real 1</h3>
                            <div>LEED Silver</div>
                            </div>
                        </v-card-title>
                    </v-card>
                </div>
            </v-flex>
            <v-flex xs12 sm3>
                <div class="container_card">
                    <v-card>
                        <v-card-media src="images/real.png" height="150px"></v-card-media>
                        <v-card-title primary-title>
                            <div>
                            <h3 class="headline mb-0">Real 1</h3>
                            <div>LEED Silver</div>
                            </div>
                        </v-card-title>
                    </v-card>
                </div>
            </v-flex>
            <v-flex xs12 sm3>
                <div class="container_card">
                    <v-card>
                        <v-card-media src="images/real.png" height="150px"></v-card-media>
                        <v-card-title primary-title>
                            <div>
                            <h3 class="headline mb-0">Real 1</h3>
                            <div>LEED Silver</div>
                            </div>
                        </v-card-title>
                    </v-card>
                </div>
            </v-flex> -->
        </v-layout>

        <!-- <v-layout  row >
            <v-flex xs12 sm3>
                <div class="container_card">
                    <v-card>
                        <v-card-media src="images/real.png" height="150px"></v-card-media>
                        <v-card-title primary-title>
                            <div>
                            <h3 class="headline mb-0">Real 1</h3>
                            <div>LEED Silver</div>
                            </div>
                        </v-card-title>
                    </v-card>
                </div>
            </v-flex>
            <v-flex xs12 sm3>
                <div class="container_card">
                    <v-card>
                        <v-card-media src="images/real.png" height="150px"></v-card-media>
                        <v-card-title primary-title>
                            <div>
                            <h3 class="headline mb-0">Real 1</h3>
                            <div>LEED Silver</div>
                            </div>
                        </v-card-title>
                    </v-card>
                </div>
            </v-flex>
        </v-layout> -->

        <div  class="section_certificaciones_responsive">
            <v-layout  row wrap v-for="item in certificaciones">
                <v-flex xs4 ><img :src="url + '/' + item.imagen_path" class="img-responsive" :alt="item.imagen"></v-flex>
                <v-flex xs8 class="descripcion"><span>@{{item.title}}<br>@{{item.descripcion}}</span></v-flex>
            </v-layout>
        </div>


    </div>

    @include('front.includes.list_product')
    @include('front.includes.banner')
    <br>
    <br>
    <h1 class="text-center oficinas_nosotros">Conoce Nuestras Oficinas</h1>
    <br>
    <br>
    @include('front.includes.galeria')
</div>
</v-app>
@endsection
