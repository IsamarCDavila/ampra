@extends('app.appadmin')
@section('style')
<script>
 var portafolio = {!!$portafolio!!};
</script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/portafolio.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="editarportafolio">
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
                                 <h3 class="headline mb-0">Editar Detalle Portafolio</h3>
                              </div>
                           </v-card-title>
                           <v-container grid-list-lg>
                              <v-form method="POST" id="formu" :action="url_update+portafolio.id" @submit.prevent="validateBeforeSubmit" accept-charset="UTF-8" novalidate="novalidate" enctype="multipart/form-data">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <v-layout column wrap>
                                    <v-layout row wrap>
                                      <v-flex xs12>
                                         {{-- <v-text-field label="Menú" v-model="portafolio.menu" :value="portafolio.menu" name="menu" required></v-text-field> --}}
                                         <v-text-field
                                             v-model="portafolio.menu"
                                             :value="portafolio.menu"
                                             label="Menú"
                                             :error-messages="errors.collect('menu')"
                                             v-validate="'required|alpha_spaces'"
                                             data-vv-name="menu"
                                             name="menu"
                                             required
                                          ></v-text-field>

                                      </v-flex>
                                      <v-flex xs12>
                                         {{-- <v-text-field label="Nombre" name="nombre" v-model="portafolio.nombre" :value="portafolio.nombre"></v-text-field> --}}
                                         <v-text-field
                                             v-model="portafolio.nombre" 
                                             :value="portafolio.nombre"
                                             label="Nombre"
                                             :error-messages="errors.collect('nombre')"
                                             v-validate="'required'"
                                             data-vv-name="nombre"
                                             name="nombre"
                                             required
                                          ></v-text-field>
                                      </v-flex>
                                      <v-flex xs12>
                                         <v-text-field label="Introducción" name="introduccion" v-model="portafolio.introduccion" :value="portafolio.introduccion"></v-text-field>
                                      </v-flex>
                                       <v-flex xs12>
                                          <v-text-field label="Título" v-model="portafolio.titulo" :value="portafolio.titulo" name="titulo"></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout>
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Descripción Corta"
                                             :rules="[(v) => v.length <= 500 || 'Max 500 characters']"
                                             :counter="500"
                                             v-model="portafolio.descripcion_corta" :value="portafolio.descripcion_corta"
                                             name="descripcion_corta"
                                             multi-line
                                             ></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout>
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Descripción Larga"
                                             :rules="[(v) => v.length <= 1500 || 'Max 500 characters']"
                                             :counter="1500"
                                             v-model="portafolio.descripcion_larga" :value="portafolio.descripcion_larga"
                                             name="descripcion_larga"
                                             multi-line
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
                                               <img class="sizeImage hiddenImage" :src="url + '/' + portafolio.imagen_path" v-if="portafolio.imagen_path"/>
                                               <img class="sizeImage" v-if="imageUrl" :src="imageUrl"/>
                                            </div>
                                         </v-flex>
                                       </v-flex>
                                    </v-layout>
                                    <v-flex xs12 class="alinear-izq padding6">
                                       <v-btn class="btn indigo btnText" @click="submit">Guardar</v-btn>
                                       {{-- <v-btn class="btn" @click="clear">Limpiar</v-btn> --}}
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
