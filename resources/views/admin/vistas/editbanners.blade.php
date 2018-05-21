@extends('app.appadmin')
@section('style')
<script>
 var banner = {!!$banner!!};
  var id_pagina = {!!$id_pagina!!};
</script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/banners.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="editarbanner">
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
                                 <h3 class="headline mb-0">{{$pagina->menu}} - Editar Sección</h3>
                              </div>
                           </v-card-title>
                           <v-container grid-list-lg>
                              <v-form method="POST" id="formu" :action="url_update+id_pagina +'/'+banner.id" @submit.prevent="validateBeforeSubmit" accept-charset="UTF-8" novalidate="novalidate" enctype="multipart/form-data">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <v-layout column wrap>
                                    <v-layout row wrap v-if="banner.id!=2 && banner.id!=3">
                                       <v-flex xs12>
                                          <v-text-field label="Título" v-model="banner.titulo" :value="banner.titulo" name="titulo"></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout v-if="banner.id!=1 && banner.id!=2 && banner.id!=3 && banner.id!=4 && banner.id!=6 && banner.id!=7">
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Introducción"
                                             :rules="[(v) => v.length <= 500 || 'Max 500 characters']"
                                             :counter="500"
                                             v-model="banner.introduccion" :value="banner.introduccion"
                                             name="descripcion"
                                             multi-line
                                             ></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout>
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Descripción"
                                             :rules="[(v) => v.length <= 500 || 'Max 500 characters']"
                                             :counter="500"
                                             v-model="banner.descripcion" :value="banner.descripcion"
                                             name="descripcion"
                                             multi-line
                                             ></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout v-if="banner.id!=2 && banner.id!=3 && banner.id!=5 && banner.id!=6">
                                       <v-flex xs4>
                                          <v-text-field
                                             label="Título Botón" v-model="banner.button" :value="banner.button" name="button"
                                             ></v-text-field>
                                       </v-flex>
                                       <v-flex xs8>
                                          <v-text-field
                                             label="Link Botón" v-model="banner.link" :value="banner.link" name="link"
                                             ></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout row wrap v-if="banner.id!=5 && banner.id!=6">
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
                                               <img class="sizeImage hiddenImage" :src="url + '/' + banner.imagen_path" v-if="banner.imagen_path"/>
                                               <img class="sizeImage" v-if="imageUrl" :src="imageUrl"/>
                                            </div>
                                         </v-flex>
                                       </v-flex>
                                      <v-flex xs6 v-if="banner.id!=2 && banner.id!=3">
                                          <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
                                             <v-text-field  label="Archivo para descargar" @click='pickFile_' v-model='documentName_' prepend-icon='attach_file'></v-text-field>
                                             <input
                                                type="file"
                                                style="display: none"
                                                ref="archivo_"
                                                accept="archivo_/*"
                                                name="archivo"
                                                @change="onFilePicked_"
                                                >
                                                <v-btn v-if="banner.tipo_button==1 && banner.link!=null && banner.link!=''" @click="dialogconfirmation_archivo=true">Quitar archivo</v-btn>

                                          </v-flex>
                                       </v-flex>
                                    </v-layout>
                                    <v-flex xs12 class="alinear-izq padding6">
                                       <v-btn class="btn indigo btnText" @click="submit">Guardar</v-btn>
                                       {{-- <v-btn class="btn" @click="clear">Limpiar</v-btn> --}}
                                    </v-flex>
                                 </v-layout>
                              </v-form>
                              <v-dialog v-model="dialogconfirmation_archivo" max-width="500px">
                                <v-card>
                                  <v-card-title class="title-modal">
                                    Quitar archivo
                                  </v-card-title>
                                  <v-card-text>
                                    ¿Está seguro que desea quitar el archivo?
                                  </v-card-text>
                                  <v-card-actions class="row-actions">
                                  <v-btn class="btn indigo btnText" @click.stop="quitarArchivo()">Sí, Quitar</v-btn>
                                  <v-btn class="btn" flat @click.stop="dialogconfirmation_archivo=false">Cancelar</v-btn>
                                  </v-card-actions>
                                </v-card>
                              </v-dialog>
                              <dialog-error is="dialog-error" :dialogerror="dialogerror" @closedialogerror="closeDialogError()"></dialog-error>
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
