<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Centenario</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Centenario" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="fb:app_id" content="452842801834883" />
        <meta property="og:url" content="{{url('/')}}" >
        <meta property="og:type" content="article" >
        <meta property="og:title" content="Centenario" >
        <meta property="og:description" content="Centenario" >
        <meta property="og:image" content="{{url('images/logo_menu.png')}}" >
        <meta property="og:image:width" content="1200" >
        <meta property="og:image:height" content="630" >
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
        <link href="<?php echo URL::asset('librerias/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <script src={{url('librerias/jquery.min.js')}}></script>
        <script src={{url('js/vue.js')}}></script>
        <script src={{url('js/vuetify.js')}}></script>




        <link href="<?php echo URL::asset('css/vuetify.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL::asset('css/main.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL::asset('css/media-queries.css'); ?>" rel="stylesheet" type="text/css" />
        <script src={{url('librerias/vue-resource.js')}}></script>
        <script src={{url('librerias/slick/slick.js')}}></script>
        <link href="<?php echo URL::asset('librerias/slick/slick.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL::asset('librerias/slick/slick-theme.css'); ?>" rel="stylesheet" type="text/css" />


        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpYCBfO_GoMUiIMF7QeDybKP-9czglOgI"></script>
        <script src="<?php echo URL::asset('js/mapa.js'); ?>"></script>

        <script>
        var ruta_principal = '{{url('/')}}';

        window.fbAsyncInit = function() {
        	FB.init({
        	  appId            : '452842801834883',
        	  autoLogAppEvents : true,
        	  xfbml            : true,
        	  version          : 'v2.10'
        	});
        	FB.AppEvents.logPageView();
          };

          (function(d, s, id){
        	 var js, fjs = d.getElementsByTagName(s)[0];
        	 if (d.getElementById(id)) {return;}
        	 js = d.createElement(s); js.id = id;
        	 js.src = "//connect.facebook.net/en_US/sdk.js";
        	 fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));

           function shareOverrideOGMeta(overrideLink, overrideTitle, overrideDescription, overrideImage)
            {
            	FB.ui({
            		method: 'share_open_graph',
            		action_type: 'og.shares',
            		action_properties: JSON.stringify({
            			object: {
            				'og:url': overrideLink,
            				'og:title': overrideTitle,
            				'og:description': overrideDescription,
            				'og:image': overrideImage
            			}
            		})
            	},
            	function (response) {
            	// Action after response
            	});
            }

        </script>
      </head>
    <!-- END HEAD -->
    <body>

        @yield('style')

        <div class="container_load">
            <div id="overlayer"></div>
            <div class="container">
              <span class="loader">
                <span class="loader-inner"></span>
              </span>
            </div>


        <div id="header">
              <v-container fluid>
                <v-layout >
                    <div class="trapecio">
                      <div class="avatar avatar_menu" >
                        <a href="{{ url("/") }}"><img src="{{ url("/images/logo_menu.png") }}" ></a>
                      </div>

                      <div class="btn_hamburguesa list_btn" @click.stop="drawer = !drawer">
                        <v-icon>list</v-icon>
                      </div>
                    </div>
                    @if ($pagina != 'home' && $pagina != 'portafolio' && $pagina != 'nosotros' && $pagina != 'mensaje')
                    <div class="franja_suscribir">
                    <v-form method="POST" id="formsendSuscribete"   :action="url_sendSuscribete" @submit="checkForm" accept-charset="UTF-8" novalidate="true" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <v-layout row wrap>

                        <v-flex xs3 offset-xs5>
                          <span class="suscribirse_header">Suscribete a nuestras Publicaciones, para mantenrte informado de lo que ocurre en centenario, de manera gratuita</span>
                        </v-flex>
                        <v-flex xs4 >
                          <span>
                              {{-- <input type="text" class="input_suscribete" placeholder="SUSCRIBETE">
                              <button class="btn_suscribete" @click='gracias'>ENVIAR</button>&nbsp;&nbsp;&nbsp; --}}
                            <input type="email" class="input_suscribete" v-model="email" id="email" name="email" placeholder="SUSCRIBETE">
                            <input class="btn_suscribete" type="submit" value="Enviar"></input>

                          </span>
                          <v-avatar class="avatar_close">
                            <v-icon v-on:click="eliminar">close</v-icon>
                          </v-avatar>
                          {{-- <v-flex offset-sm8 sm4> --}}
                                      <p v-if="errors.length">
                                          <ul class="casillaerrores">
                                              <li v-for="error in errors">
                                                      <span class="error--text" icon="warning" :value="true">
                                              *  @{{ error }}
                                      </span></li>
                                          </ul>
                                      </p>
                          {{-- </v-flex> --}}
                        </v-flex>
                      </v-layout>
                    </v-form>
                    </div>
                    @endif
                </v-layout>

              </v-container>

              <v-navigation-drawer
                temporary
                v-model="drawer"
                absolute
                hide-overlay
              >
                <div class="trapecio">
                  <div class="btn_hamburguesa" @click.stop="drawer = !drawer">
                    <v-icon>clear</v-icon>
                  </div>
                </div>

                <div class="contenedor_header">
                  @include('front.includes.header')
                </div>

              </v-navigation-drawer>
        </div>
         @if ($pagina != 'evento' && $pagina != 'galeria' && $pagina != 'mensaje')
        <div id="hero_contenedor">
          <div>
             <v-container fluid>
                  @include('front.includes.hero')
              </v-container>
          </div>
        </div>
         @endif
          <v-layout wrap>
            <v-container fluid>
                @yield('content')
            </v-container>
          </v-layout>

        <div id="footer">
          <v-app id="inspire">
            <v-layout wrap>
              <v-container fluid>
                  @include('front.includes.footer')
              </v-container>
            </v-layout>
          </v-app>
        </div>

<!-- load -->
      </div>





      @yield('script')
      <script>
        var hero = {!!$hero!!};
        var pagina = '{!!$pagina!!}';
      </script>
      <script src="<?php echo URL::asset('js/main.js'); ?>"></script>
      <script src="<?php echo URL::asset('js/media-queries.js'); ?>"></script>
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!--<script src="https://unpkg.com/vue-material@beta"></script> -->
    </body>
</html>
