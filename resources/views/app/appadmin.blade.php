<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Centenario</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons"> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
        <link href="<?php echo URL::asset('librerias/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <script src={{url('librerias/jquery.min.js')}}></script>
        <script src={{url('js/vue.js')}}></script>
        <script src={{url('js/vuetify.js')}}></script>


        <link href="<?php echo URL::asset('css/vuetify.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL::asset('css/admin.css'); ?>" rel="stylesheet" type="text/css" />
        <script src={{url('librerias/vue-resource.js')}}></script>
        <script src={{url('librerias/slick/slick.js')}}></script>
        <script src="https://unpkg.com/vee-validate/dist/vee-validate.js"></script>
        {{-- <script src="https://unpkg.com/vee-validate@2.0.0-rc.7"></script> --}}

          <!-- Optional theme -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}

        <script>
        var ruta_principal = '{{url('/')}}';
        var ruta_admin = '{{url('/admin')}}';
        </script>
      </head>
    <!-- END HEAD -->
    <body>
        @yield('style')
  <div class="container_load">
      <div id="appadmin">
            <v-navigation-drawer
              fixed
              v-model="drawer"
              app
            >
        @include('admin.includes.header')
            </v-navigation-drawer>
            <v-toolbar color="indigo" dark fixed app>
              <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
              <div class="text-xs-center">
              <v-menu offset-y id="menu-v">
                @guest

                @else
                <span slot="activator" color="" class="pull-right menu-user"> Bienvenido, {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></span>
                <v-list>
                  <v-list-tile @click="">
                    <v-list-tile-title><a href="{{url('/salir')}}" style="color:white">Cerrar sesión</a></v-list-tile-title>
                  </v-list-tile>
                </v-list>
                @endif
              </v-menu>
            </div>
            </v-toolbar>
      </div>
        @yield('content')
      <div id="footer">
            <v-footer color="indigo" app inset>
              <span class="white--text padding-left15"> Powered by: Studio Tigres &copy; 2018</span>
      </v-footer>
      </div>
 </div>

      <script src="<?php echo URL::asset('js/admin.js'); ?>"></script>
      @yield('script')
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </body>
</html>
