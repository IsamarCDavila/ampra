@extends('app.appadmin')
@section('style')
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/paginas.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="table-paginas">
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
                                 <h3 class="headline mb-0">Páginas</h3>
                              </div>
                           </v-card-title>
                           <v-spacer></v-spacer>
                           <table class="table table-style">
                              <tr>
                                 <th>Menú</th>
                                 <th>Título</th>
                                 <th>Descripción</th>
                                 <th>Imagen principal</th>
                                 <th>Secciones</th>
                                 <th>Carousel</th>
                                 <th class="tamAcciones">Acción</th>
                              </tr>
                              <tr v-for="item in items">
                                 <td>@{{ item.menu }}</td>
                                 <td>@{{ item.titulo }}</td>
                                 <td>@{{ item.descripcion }}</td>
                                 <td class="text-xs-right"><img width="100%" v-if="item.imagen_path!=null" v-bind:src="url +'/'+ item.imagen_path"/></td>
                                 <td><v-btn fab dark small color="primary"
                                  v-bind:href="url_getbanner + item.id+url_banner"> <v-icon >visibility</v-icon>
                                 </v-btn></td>
                                 <td><v-btn fab dark small color="orange darken-2" v-if="item.id==4 || item.id==1"
                                  v-bind:href="url+'/admin/paginas/galeria/'+item.id"> <v-icon >widgets</v-icon>
                                 </v-btn></td>
                                 <td>
                                    <v-btn fab dark small color="cyan"
                                     v-bind:href="url_edit + item.id"> <v-icon >edit</v-icon>
                                    </v-btn>
                                 </td>
                              </tr>
                           </table>
                           <div class="text-xs-center ulPagination">
                              <paginacion is="paginacion" :pagination="pagination" @paginate="getPaginas()" :offset="4"></paginacion>
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
