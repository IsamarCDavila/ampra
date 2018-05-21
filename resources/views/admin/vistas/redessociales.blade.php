@extends('app.appadmin')
@section('style')
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/redessociales.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div id="table-redessociales">
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
                                <h3 class="headline mb-0">Redes Sociales</h3>
                             </div>
                             <div class="btn-right">
                               <v-btn class="btn-xs indigo btnText" @click.prevent="showcrear()">+ Nueva red social</v-btn>
                             </div>
                          </v-card-title>
                          <br>
                          <v-spacer>  </v-spacer>
                          <table class="table table-style">
                             <tr>
                               <th class="tamId">Id</th>
                               <th>Nombre</th>
                               <th>Icono</th>
                               <th>Url</th>
                               <th class="tamAcciones">Acciones</th>
                             </tr>
                             <tr v-for="item in items">
                                <td>@{{ item.id }}</td>
                        				<td>@{{ item.nombre }}</td>
                                <td><i v-if="item.icono!=null" v-bind:class="item.icono"></td>
                                <td>@{{ item.url }}</td>
                                <td>
                                   <v-btn fab dark small color="cyan" @click.prevent="showmodal(item)"> <v-icon >edit</v-icon>
                                   </v-btn>
                                   <v-btn fab dark small color="error" @click.prevent="showConfirmation(item)"> <v-icon >delete_forever</v-icon>
                                   </v-btn>
                                </td>
                             </tr>
                          </table>
                          <div class="text-xs-center ulPagination">
                             <paginacion is="paginacion" :pagination="pagination" @paginate="getRedes()" :offset="4"></paginacion>
                          </div>
                       </v-card>
                    </v-flex>
                 </v-layout>
                 <v-dialog v-model="dialogedit" max-width="500px">
                   <v-card>
                     <v-card-title class="title-modal">
                       Editar red social
                     </v-card-title>
                     <v-card-text>
                       <v-text-field
                         label="Ingrese nombre" name="nombre" id="nombrered" :value="red_update.nombre"></v-text-field>
                       <v-text-field
                         label="Ingrese icono" name="icono" id="iconored" :value="red_update.icono"></v-text-field>
                       <v-text-field
                         label="Ingrese url" name="url" id="urlred" :value="red_update.url"></v-text-field>
                     </v-card-text>
                     <v-card-actions class="row-actions">
                       <v-btn class="btn indigo btnText"  @click.stop="editItem(red_update)">Actualizar</v-btn>
                       <v-btn class="btn" @click.stop="dialogedit=false">Cerrar</v-btn>
                     </v-card-actions>
                   </v-card>
                 </v-dialog>

                 <v-dialog v-model="dialogconfirmation" max-width="500px">
                   <v-card>
                     <v-card-title class="title-modal">
                       Eliminar item
                     </v-card-title>
                     <v-card-text>
                       ¿Está seguro eliminar el item?
                     </v-card-text>
                     <br>
                     <v-card-actions class="row-actions">
                       <v-btn class="btn indigo btnText"  @click.stop="deleteItem(red_delete)">Sí, Eliminar</v-btn>
                       <v-btn class="btn" @click.stop="dialogconfirmation=false">Cancelar</v-btn>
                     </v-card-actions>
                   </v-card>
                 </v-dialog>
                 <v-dialog v-model="dialognew" max-width="500px">
                   <v-card>
                     <v-card-title class="title-modal">
                       Nueva red social
                     </v-card-title>
                     <v-card-text>
                       <v-text-field
                         label="Ingrese nombre" name="nombre" id="newrednombre" ref="t_name" v-model="newrednombre"></v-text-field>
                       <v-text-field
                         label="Ingrese icono" name="icono" id="newredicono" ref="t_icono" v-model="newredicono"></v-text-field>
                       <v-text-field
                         label="Ingrese url" name="url" id="newredurl" ref="t_url" :value="newredurl"></v-text-field>
                     </v-card-text>
                     <v-card-actions class="row-actions">
                       <v-btn class="btn indigo btnText" @click.stop="createItem()">Crear</v-btn>
                       <v-btn class="btn" @click.stop="dialognew=false">Cerrar</v-btn>
                     </v-card-actions>
                   </v-card>
                 </v-dialog>
                 <dialog-error is="dialog-error" :dialogerror="dialogerror" @closedialogerror="closeDialogError()"></dialog-error>

              </v-flex>
           </v-layout>
        </v-container>
     </v-content>
  </v-app>
</div>

@endsection
