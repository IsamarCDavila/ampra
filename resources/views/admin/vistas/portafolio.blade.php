@extends('app.appadmin')
@section('style')
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/portafolio.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="table-portafolio">
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
                                 <h3 class="headline mb-0">Portafolio</h3>
                              </div>
                              <div class="btn-right">
                                 <v-btn class="btn-xs indigo btnText" v-bind:href="url +'/admin/portafolio/crear'">Nuevo portafolio</v-btn>
                              </div>
                           </v-card-title>
                           <v-spacer></v-spacer>
                           <table class="table table-style">
                              <tr>
                                 <th>Nombre</th>
                                 <th>Introducción</th>
                                 {{-- <th>Descripción Detalle</th> --}}
                                 <th width= "20%">Imagen Principal</th>
                                 <th>Secciones</th>
                                 <th class="tamAcciones">Editar</th>
                              </tr>
                              <tr v-for="item in items">
                                 <td>@{{ item.nombre }}</td>
                                 <td>@{{ item.introduccion }}</td>
                                 <td class=""><img width="100%" v-if="item.imagen_path!=null" v-bind:src="url +'/'+ item.imagen_path"/></td>
                                 <td><v-btn fab dark small color="primary"
                                  v-bind:href="url_getbanner + item.id+url_detalle"> <v-icon >visibility</v-icon>
                                 </v-btn></td>

                                 <td>
                                    <v-btn fab dark small color="cyan"
                                     v-bind:href="url_edit + item.id"> <v-icon >edit</v-icon>
                                    </v-btn>
                                    <v-btn fab dark small color="error" @click.prevent="showConfirmationPortafolio(item)"> <v-icon >delete_forever</v-icon>
                                    </v-btn>
                                 </td>
                              </tr>
                           </table>
                           <div class="text-xs-center ulPagination">
                              <paginacion is="paginacion" :pagination="pagination" @paginate="getPortafolio()" :offset="4"></paginacion>
                           </div>
                        </v-card>
                     </v-flex>
                  </v-layout>
               </v-flex>
            </v-layout>
            <v-dialog v-model="dialogconfirmation" max-width="500px">
              <v-card>
                <v-card-title class="title-modal">
                  Eliminar item
                </v-card-title>
                <v-card-text>
                  ¿Está seguro eliminar el item?
                </v-card-text>
                <v-card-actions>
                  <v-btn class="btn indigo btnText"  @click.stop="deletePortafolio(portafolio_delete)">Sí, Eliminar</v-btn>
                  <v-btn class="btn"   @click.stop="dialogconfirmation=false">Cancelar</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <dialog-error is="dialog-error" :dialogerror="dialogerror" @closedialogerror="closeDialogError()"></dialog-error>
         </v-container>
      </v-content>
   </v-app>
</div>
@endsection
