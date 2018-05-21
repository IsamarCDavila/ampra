@extends('app.appadmin')
@section('style')
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/suscriptores.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="table-suscriptores">
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
                                 <h3 class="headline mb-0">Suscriptores</h3>
                              </div>
                           </v-card-title>
                           <v-spacer></v-spacer>
                           <table class="table table-style">
                             <tbody>
                              <tr>
                                 <th>Id</th>
                                 <th>Email</th>
                                 <th>Fecha</th>
                              </tr>
                              <tr v-for="item in items">
                                 {{-- <td class="text-xs-right"><img v-if="item.icono_path!=null" v-bind:src="url +'/'+ item.icono_path"/></td> --}}
                                 <td>@{{ item.id }}</td>
                                 <td>@{{ item.email }}</td>
                                 <td>@{{ item.created_at }}</td>
                              </tr>
                            </tbody>
                           </table>
                            <div class="text-xs-center ulPagination">
                              <paginacion is="paginacion" :pagination="pagination" @paginate="getSuscriptores()" :offset="4"></paginacion>
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
