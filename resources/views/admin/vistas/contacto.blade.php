@extends('app.appadmin')
@section('style')
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/contacto.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div id="table-contacto">
  <v-app id="inspire">
     <v-content>
        <v-container sinpaddingleft fluid fill-height>
           <v-layout justify-center align-center>
              <v-flex text-xs-center>
                 <v-layout row>
                    <v-flex xs12 sm12>
                       <v-card class="spaceLR cardSize">
                          <v-card-title primary-title>
                             <div>
                                <h3 class="headline mb-0">Contacto</h3>
                             </div>
                             <div class="btn-right">
                               {{-- <v-btn class="btn-xs indigo btnText" v-bind:href="url_new">+ Nuevo Contacto</v-btn> --}}
                             </div>
                          </v-card-title>
                          <br>
                          <v-spacer>  </v-spacer>
                          <table class="table table-style">
                            <tr>
                              <th>N°</th>
                              {{-- <th>Página</th> --}}
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Empresa</th>
                              <th>Email</th>
                              <th>Teléfono</th>
                              <th>Mensaje</th>
                              <th>Distrito</th>
                              <th>Metros<br> cuadrados</th>
                              <th>Descargó<br> archivo</th>
                              {{-- <th width="200px">Acciones</th> --}}
                            </tr>
                            <tr v-for="item in items">
                              <td>@{{ item.id }}</td>
                              {{-- <td>@{{ item.id_pagina }}</td> --}}
                              <td>@{{ item.nombre }}</td>
                              <td>@{{ item.apellido }}</td>
                              <td>@{{ item.empresa}}</td>
                              <td>@{{ item.email }}</td>
                              <td>@{{ item.telefono }}</td>
                              <td>@{{ item.mensaje }}</td>
                              <td>@{{ item.distrito }}</td>
                              <td>@{{ item.metros }}</td>
                              <td v-if="item.descarga==1">Sí</td>
                              <td v-else>No</td>

                              {{-- <td class="text-xs-right"><img v-if="item.imagen_path!=null" v-bind:src="url + '/'+item.imagen_path"/></td>
                              <td>
                                <v-btn fab dark small color="cyan" v-bind:href="url_edit+'/'+item.id"> <v-icon >edit</v-icon>
                                </v-btn>
                              </td> --}}
                            </tr>
                          </table>
                           <div class="text-xs-center ulPagination">
                            	<paginacion is="paginacion" :pagination="pagination" @paginate="getContacto()" :offset="4"></paginacion>
                          </div>
                       </v-card>
                    </v-flex>
                 </v-layout>
              </v-flex>
           </v-layout>
        </v-container>
     </v-content>
  </v-app>
</div>

@endsection
