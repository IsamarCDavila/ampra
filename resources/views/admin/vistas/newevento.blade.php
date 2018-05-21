@extends('app.appadmin')
@section('style')
<script>
  var portafolios = {!! $portafolios !!};
</script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/accionevento.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="newevento">
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
                                 <h3 class="headline mb-0">Crear Evento</h3>
                              </div>
                           </v-card-title>
                           <v-container grid-list-lg>
                              <v-form method="POST" id="formnewEvento" :action="url_store" @submit.prevent="validateBeforeSubmit" accept-charset="UTF-8" novalidate="novalidate" enctype="multipart/form-data">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <v-layout column wrap>
                                   <v-layout row wrap>
                                     <v-flex xs5>
                                       <v-select
                                                :items="portafolios"
                                                v-model="detalle_portafolio_id"
                                                label="Portafolio"
                                                class="input-group--focused"
                                                item-value="value"
                                       ></v-select>
                                       <v-text-field style="display: none" v-model="detalle_portafolio_id" name="detalle_portafolio_id"
                                          ></v-text-field>
                                     </v-flex>
                                      <v-flex xs5>
                                        <v-select
                                                 :items="estados"
                                                 v-model="estado"
                                                 label="Estado"
                                                 class="input-group--focused"
                                                 item-value="value"
                                        ></v-select>
                                        <v-text-field style="display: none" v-model="estado" name="estado"
                                           ></v-text-field>
                                      </v-flex>

                                   </v-layout>
                                    <v-layout row wrap>

                                      <v-flex xs5>
                                        <v-text-field
                                           label="Lugar" :value="lugar" name="lugar"
                                           ></v-text-field>
                                      </v-flex>
                                       <v-flex xs5>
                                         <v-menu
                                                 ref="menu_date"
                                                 lazy
                                                 :close-on-content-click="false"
                                                 v-model="menu_date"
                                                 transition="scale-transition"
                                                 offset-y
                                                 full-width
                                                 :nudge-right="40"
                                                 min-width="290px"
                                                 :return-value.sync="date"
                                               >
                                                 <v-text-field
                                                   slot="activator"
                                                   label="Fecha"
                                                   v-model="date"
                                                   prepend-icon="event"
                                                   readonly
                                                   name = "fecha"
                                                 ></v-text-field>
                                                 <v-date-picker v-model="date" no-title scrollable>
                                                   <v-spacer></v-spacer>
                                                   <v-btn flat color="primary" @click="menu_date = false">Cancel</v-btn>
                                                   <v-btn flat color="primary" @click="$refs.menu_date.save(date)">OK</v-btn>
                                                 </v-date-picker>
                                               </v-menu>

                                       </v-flex>

                                    </v-layout>

                                    <v-layout row wrap>
                                       <v-flex xs5>
                                         <v-menu
                                                 ref="menu"
                                                 lazy
                                                 :close-on-content-click="false"
                                                 v-model="menu"
                                                 transition="scale-transition"
                                                 offset-y
                                                 full-width
                                                 :nudge-right="40"
                                                 max-width="290px"
                                                 min-width="290px"
                                                 :return-value.sync="time"
                                               >
                                                 <v-text-field
                                                   slot="activator"
                                                   label="Hora desde"
                                                   v-model="time"
                                                   prepend-icon="access_time"
                                                   readonly
                                                   name="hora_inicial"
                                                 ></v-text-field>
                                                 <v-time-picker v-model="time" @change="$refs.menu.save(time)"></v-time-picker>
                                         </v-menu>
                                       </v-flex>
                                       <v-flex xs5>
                                         <v-menu
                                                 ref="menu_"
                                                 lazy
                                                 :close-on-content-click="false"
                                                 v-model="menu_"
                                                 transition="scale-transition"
                                                 offset-y
                                                 full-width
                                                 :nudge-right="40"
                                                 max-width="290px"
                                                 min-width="290px"
                                                 :return-value.sync="time_dos"
                                               >
                                                 <v-text-field
                                                   slot="activator"
                                                   label="Hora hasta"
                                                   v-model="time_dos"
                                                   prepend-icon="access_time"
                                                   readonly
                                                   name="hora_final"
                                                 ></v-text-field>
                                                 <v-time-picker v-model="time_dos" @change="$refs.menu_.save(time_dos)"></v-time-picker>
                                         </v-menu>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout row wrap>
                                      <v-flex xs10>
                                        <v-text-field
                                           label="Título" :value="titulo" name="titulo"
                                           ></v-text-field>
                                      </v-flex>
                                       <v-flex xs10>
                                         <v-text-field
                                            label="Descripción" :value="descripcion" multi-line name="descripcion"
                                            ></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout row wrap>
                                      <v-flex xs5>
                                        <v-flex xs10 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
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
                                              <img class="sizeImage" v-if="imageUrl" :src="imageUrl"/>
                                           </div>
                                        </v-flex>
                                      </v-flex>
                                    </v-layout>
                                    <v-flex xs12 class="alinear-izq padding6">
                                       <v-btn class="btn indigo btnText" @click="submit">Guardar</v-btn>
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
