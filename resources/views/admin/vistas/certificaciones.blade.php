@extends('app.appadmin')
@section('style')
<script>
  var tipo = 1;
</script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/items.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div id="table-items">
  <v-app id="inspire">
     <v-content>
        <v-container sinpaddingleft fluid fill-height>
           <v-layout justify-center align-center>
          <v-flex text-xs-center>
            <v-flex xs12 sm12>
               <v-card class="spaceLR cardSize">
                  <v-card-title primary-title>
                     <div>
                        <h3 class="headline mb-0">
                          Certificaciones
                        </h3>
                     </div>
                     <div class="btn-right">
                       <v-btn class="btn-xs indigo btnText" @click.prevent="showcrear()">+ Nueva certificación</v-btn>
                     </div>
                  </v-card-title>
                  <br>
                  <v-spacer>  </v-spacer>
                  <table class="table table-style">
            			<tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
            				<th width="200px">Acciones</th>
            			</tr>
            			<tr v-for="item in items">
                    <td>@{{ item.titulo }}</td>
                    <td>@{{ item.descripcion }}</td>
                    <td class="text-xs-right"><img v-if="item.imagen_path!=null" v-bind:src="url + '/'+item.imagen_path" style="height:50px"/></td>
            				<td>
                      <v-btn fab dark small color="cyan" @click.prevent="showmodal(item)"> <v-icon >edit</v-icon>
                      </v-btn>
                      <v-btn fab dark small color="error" @click.prevent="showConfirmation(item)"> <v-icon >delete_forever</v-icon>
                      </v-btn>
            				</td>
            			</tr>
            		</table>


            		<!-- Pagination -->
            		<paginacion is="paginacion" :pagination="pagination" @paginate="getItems()" :offset="4"></paginacion>
                </v-flex>
              </v-layout>
            </v-flex>
          </v-layout>
          <v-dialog v-model="dialogedit" max-width="500px">
            <v-card>
              <v-card-title class="title-modal">
                Editar imagen
              </v-card-title>
              <v-card-text>
                  <v-layout row wrap>
                     <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                       <v-text-field
                           label="Ingrese título" name="titulo" :value="item_update.titulo" id="tituloedit">
                       </v-text-field>
                       <v-text-field
                           label="Ingrese descripción" name="descripcion" :value="item_update.descripcion" id="descripcionedit">
                       </v-text-field>
                        <input type="file" @change="onFileChange" name="imagen_img" id="editImagen" img-name="#img-editarimg">
                        <br>
                        <br>
                        <img :src="url +'/'+ item_update.imagen_path" width="100px" height="100px" id="img-editarimg"/>
                      </v-flex>
                   </v-layout>
              </v-card-text>

              <v-card-actions>
                <v-btn class="btn indigo btnText" @click.stop="editItem(item_update)">Actualizar</v-btn>
                <v-btn class="btn" flat @click.stop="dialogedit=false">Cerrar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <v-dialog v-model="dialognew" max-width="500px">
            <v-card>
              <v-card-title class="title-modal">
                Nueva imagen
              </v-card-title>
              <v-card-text>
                <v-layout row wrap>
                   <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                       <v-text-field
                           label="Ingrese título" name="titulo" v-model="new_titulo_item">
                       </v-text-field>
                       <v-text-field
                           label="Ingrese descripción" name="descripcion" v-model="new_descripcion_item">
                       </v-text-field>
                      <input type="file" @change="onFileChange" name="imagen_img" id="newImagen" img-name="#img-crearimg">
                      <br>
                      <br>
                      <img width="100px" height="100px" id="img-crearimg"/>
                    </v-flex>
              </v-card-text>
              <v-card-actions>
                <v-btn class="btn indigo btnText" @click.stop="createItem()">Crear</v-btn>
                <v-btn class="btn" @click.stop="dialognew=false">Cerrar</v-btn>
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
              <v-card-actions>
                <v-btn class="btn indigo btnText" @click.stop="deleteItem(item_delete)">Sí, Eliminar</v-btn>
                <v-btn class="btn" flat @click.stop="dialogconfirmation=false">Cancelar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <dialog-error is="dialog-error" :dialogerror="dialogerror" @closedialogerror="closeDialogError()"></dialog-error>
        </v-container>
    </v-content>
  </v-app>
</div>

@endsection
