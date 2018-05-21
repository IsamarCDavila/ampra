@extends('app.appadmin')
@section('style')
<script>
 var pagina = {!!$pagina!!};
</script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/paginas.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="editarpagina">
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
                                 <h3 class="headline mb-0">Editar Página</h3>
                              </div>
                           </v-card-title>
                           <v-container grid-list-lg>
                              <v-form method="POST" id="formu" :action="url_update+pagina.id" @submit.prevent="validateBeforeSubmit" accept-charset="UTF-8" novalidate="novalidate" enctype="multipart/form-data">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <v-layout column wrap>
                                    <v-layout row wrap>
                                       <v-flex xs12>
                                          <v-text-field label="Título" v-model="pagina.titulo" :value="pagina.titulo" name="titulo"></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout row wrap>
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Descripción"
                                             :rules="[(v) => v.length <= 500 || 'Max 500 characters']"
                                             :counter="500"
                                             v-model="pagina.descripcion" :value="pagina.descripcion"
                                             name="descripcion"
                                             multi-line
                                             ></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout row wrap>
                                       <v-flex xs4>
                                          <v-text-field
                                             label="Título Botón" v-model="pagina.button" :value="pagina.button" name="button"
                                             ></v-text-field>
                                       </v-flex>
                                       <v-flex xs8>
                                          <v-text-field
                                             label="Link Botón" v-model="pagina.link" :value="pagina.link" name="link"
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
                                               <img class="sizeImage hiddenImage" :src="url + '/' + pagina.imagen_path" v-if="pagina.imagen_path"/>
                                               <img class="sizeImage" v-if="imageUrl" :src="imageUrl"/>
                                            </div>
                                         </v-flex>
                                       </v-flex>
                                       {{-- <v-flex xs6>
                                          <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
                                             <v-text-field  label="Icono" @click='pickFile_' v-model='imageName_' prepend-icon='attach_file'></v-text-field>
                                             <input
                                                type="file"
                                                style="display: none"
                                                ref="image_"
                                                accept="image_/*"
                                                name="icono_img"
                                                @change="onFilePicked_"
                                                >
                                             <div >
                                                <img class="sizeImage hiddenIcono" :src="url + '/' + pagina.icono_path" v-if="pagina.icono_path"/>
                                                <img class="sizeImage" :src="imageUrl_" v-if="imageUrl_"/>
                                             </div>
                                          </v-flex>
                                       </v-flex> --}}
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
