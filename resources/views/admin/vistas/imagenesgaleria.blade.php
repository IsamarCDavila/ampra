@extends('app.appadmin')
@section('style')
  <script>
    var galeria = {!! $galeria!!};
  </script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/imagenesgaleria.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div id="table-imagenesgaleria">
  <v-app id="inspire">
  <v-content>
    <v-container sinpaddingleft fluid fill-height>
       <v-layout >
        <v-flex text-xs-center>
          <v-layout row>
            <v-flex xs12 sm12>
              <v-card-title primary-title>
                 <div>
                    <h3 class="headline mb-0">
                      <a v-bind:href="url+'/admin/galeria'"><span class="fa fa-caret-left"><span></a>
                      @{{galeria.titulo}}</h3>
                 </div>
                 <div class="btn-right">
                    <v-btn class="btn-xs indigo btnText"@click.stop="nuevaImagen()">Nueva imagen</v-btn>
                 </div>
              </v-card-title>
              <table class="table table-style">
          			<tr>
                	<th>Id</th>
          				<th>Título</th>
                  <th>Imagen</th>
          				<th width="200px">Acciones</th>
          			</tr>
          			<tr v-for="item in items">
                  <td>@{{ item.id }}</td>
          				<td>@{{ item.titulo }}</td>
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
          		<paginacion is="paginacion" :pagination="pagination" @paginate="getImagenesGaleria(id_galeria)" :offset="4"></paginacion>
              </v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
        <v-dialog v-model="dialogedit" max-width="500px">
          <v-card>
            <v-card-title class="title-modal">
              Editar imagen galeria
            </v-card-title>
            <v-card-text>
              <v-text-field
                label="Ingrese título" name="titulo" id="tituloimagen" :value="imagen_update.titulo"></v-text-field>
                <input type="file" @change="onFileChange" name="imagen_img" id="editImagen" img-name="#img-editarimg">
                <br>
                <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                <img :src="url +'/'+ imagen_update.imagen_path" width="100px" height="100px" id="img-editarimg"/>
              </v-flex>
            </v-card-text>

            <v-card-actions class="row-actions">
              <v-btn class="btn indigo btnText" @click.stop="editItem(imagen_update)">Guardar</v-btn>
              <v-btn class="btn" @click.stop="dialogedit=false">Cancelar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <v-dialog v-model="dialognew" max-width="500px">
          <v-card>
            <v-card-title class="title-modal">
              Nueva imagen galeria
            </v-card-title>
            <v-card-text>
              <v-text-field
                label="Ingrese título" name="titulo" id="newtituloimagen" v-model="newtituloimagen"></v-text-field>
                <input type="file" @change="onFileChange" name="imagen_img" id="newImagen" img-name="#img-crearimg">
                <br>
                  <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                    <img width="100px" height="100px" id="img-crearimg"/>
                  </v-flex>
            </v-card-text>
            <v-card-actions class="row-actions">
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
            <v-card-actions class="row-actions">
              <v-btn class="btn indigo btnText" @click.stop="deleteItem(imagen_delete)">Sí, Eliminar</v-btn>
              <v-btn class="btn"  @click.stop="dialogconfirmation=false">Cancelar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <dialog-error is="dialog-error" :dialogerror="dialogerror" @closedialogerror="closeDialogError()"></dialog-error>
      </v-container>
  </v-content>
  </v-app>
</div>

@endsection
