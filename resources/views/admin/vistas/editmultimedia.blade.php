@extends('app.appadmin')
@section('style')
<script>
    var id_detalleportafolio= {!!$id_detalleportafolio!!};
    var multimedia = {!!$multimedia!!};

</script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/multimediaedit.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="editarmultimedia">
   <v-app id="inspire">
      <v-content>
         <v-container sinpaddingleft fluid fill-height>
            <v-layout justify-center align-center>
               <v-flex text-xs-center>
                  <v-layout row>
                     <v-flex xs12 sm12>
                        <v-card class="spaceLR">
                           <v-card-title primary-title>
                              <div>
                                 <h3 class="headline mb-0">Editar Galería Multimedia</h3>
                              </div>
                           </v-card-title>
                           <v-container grid-list-lg>
                              <v-form method="POST" id="formMultimedia" :action="url_update+'/'+multimedia.id+'/'+id_detalleportafolio" @submit.prevent="validateBeforeSubmit" accept-charset="UTF-8" novalidate="novalidate" enctype="multipart/form-data">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <v-layout column wrap>
                                    <v-layout row wrap>
                                       <v-flex xs12>
                                          <v-text-field label="Título" v-model="multimedia.titulo" :value="multimedia.titulo" name="titulo"></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout>
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Descripción"
                                             :rules="[(v) => v.length <= 500 || 'Max 500 characters']"
                                             :counter="500"
                                             v-model="multimedia.descripcion" :value="multimedia.descripcion"
                                             name="descripcion"
                                             multi-line
                                             ></v-text-field>
                                       </v-flex>
                                    </v-layout>

                                    <v-layout>
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Link video"
                                             v-model="multimedia.video" :value="multimedia.video"
                                             name="video"
                                             ></v-text-field>
                                       </v-flex>
                                    </v-layout>

                                    <v-layout row wrap>
                                       <v-flex xs6>
                                         <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
                                            <v-text-field   class="contenidoImagen"  label="Imagen" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
                                            <input
                                               type="file"
                                               style="display: none"
                                               ref="image"
                                               name="imagen_img"
                                               accept="image/*"
                                               @change="onFilePicked"
                                               >
                                            <div>
                                               <img class="sizeImage hiddenImage" :src="url + '/' + multimedia.imagen_path" v-if="multimedia.imagen_path"/>
                                               <img class="sizeImage" v-if="imageUrl" :src="imageUrl"/>
                                            </div>
                                         </v-flex>
                                       </v-flex>
                                    </v-layout>
                                    <v-flex xs12 class="alinear-izq padding6">
                                       <v-btn class="btn indigo btnText" @click="submit">Guardar</v-btn>
                                       <v-btn class="btn indigo btnText" v-bind:href="url+'/admin/portafolio/'+id_detalleportafolio+'/detalleportafolio'">Cancelar</v-btn>
                                    </v-flex>
                                 </v-layout>
                              </v-form>
                           </v-container>
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
