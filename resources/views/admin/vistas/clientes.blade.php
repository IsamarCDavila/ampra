@extends('app.appadmin')
@section('style')
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/clientes.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div id="table-clientes">
  <v-app id="inspire">
     <v-content>
        <v-container sinpaddingleft fluid fill-height>
           <v-layout justify-center align-center>
          <v-flex text-xs-center>
            <v-flex xs12 sm12>
               <v-card class="spaceLR cardSize">
                  <v-card-title primary-title>
                     <div>
                        <h3 class="headline mb-0">Clientes</h3>
                     </div>
                     <div class="btn-right">
                       <v-btn class="btn-xs indigo btnText" @click.prevent="showcrear()">+ Nuevo cliente</v-btn>
                     </div>
                  </v-card-title>
                  <br>
                  <v-spacer>  </v-spacer>
                  <table class="table table-style">
            			<tr>
            				<th>Nombre</th>
                    <th>Logo</th>
            				<th width="200px">Acciones</th>
            			</tr>
            			<tr v-for="item in items">
            				<td>@{{ item.nombre }}</td>
                    <td class="text-xs-right"><img v-if="item.logo_path!=null" v-bind:src="url + '/'+item.logo_path" style="height:50px"/></td>
            				<td>
                      <v-btn fab dark small color="cyan" @click.prevent="showmodal(item)"> <v-icon >edit</v-icon>
                      </v-btn>
                      <v-btn fab dark small color="error" @click.prevent="showConfirmation(item)"> <v-icon >delete_forever</v-icon>
                      </v-btn>
            				</td>
            			</tr>
            		</table>


            		<!-- Pagination -->
            		<paginacion is="paginacion" :pagination="pagination" @paginate="getClientes()" :offset="4"></paginacion>
                </v-flex>
              </v-layout>
            </v-flex>
          </v-layout>
          <v-dialog v-model="dialogedit" max-width="500px">
            <v-card>
              <v-card-title class="title-modal">
                Editar cliente
              </v-card-title>
              <v-card-text>
                  <v-layout row wrap>
                     <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                       <v-text-field
                         label="Ingrese nombre" name="nombre" v-model="cliente_update.nombre" :value="cliente_update.nombre"></v-text-field>
                        <input type="file" @change="onFileChange" name="imagen_img" id="editImagen" img-name="#img-editarimg">
                        <br>
                        <br>
                        <img :src="url +'/'+ cliente_update.logo_path" width="100px" height="100px" id="img-editarimg"/>
                      </v-flex>
                   </v-layout>
              </v-card-text>

              <v-card-actions>
                <v-btn class="btn indigo btnText" @click.stop="editItem(cliente_update)">Actualizar</v-btn>
                <v-btn class="btn"  @click.stop="dialogedit=false">Cerrar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <v-dialog v-model="dialognew" max-width="500px">
            <v-card>
              <v-card-title class="title-modal">
                Nuevo cliente
              </v-card-title>
              <v-card-text>
                <v-layout row wrap>
                   <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                <v-text-field
                  label="Ingrese nombre" name="titulo" v-model="new_nombre_cliente"></v-text-field>
                  <input type="file" @change="onFileChange" name="imagen_img" id="newImagen" img-name="#img-crearimg">
                  <br>
                  <br>
                  <img width="100px" height="100px" id="img-crearimg"/>
                    </v-flex>
              </v-card-text>
              <v-card-actions class="">
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
                <v-btn class="btn indigo btnText" @click.stop="deleteItem(cliente_delete)">Sí, Eliminar</v-btn>
                <v-btn class="btn" @click.stop="dialogconfirmation=false">Cancelar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <dialog-error is="dialog-error" :dialogerror="dialogerror" @closedialogerror="closeDialogError()"></dialog-error>
        </v-container>
    </v-content>
  </v-app>
</div>

@endsection
