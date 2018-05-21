@extends('app.appadmin')
@section('style')
<script>
    var id_detalleportafolio= {!!$id_detalleportafolio!!};
    var beneficio = {!!$beneficio!!};

</script>
@endsection
@section('script')
<script src="<?php echo URL::asset('js/beneficioedit.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="editarbeneficio">
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
                                 <h3 class="headline mb-0">Editar Beneficio</h3>
                              </div>

                           </v-card-title>
                           <v-container grid-list-lg>
                              <v-form method="POST" id="formBeneficio" :action="url_update+'/'+beneficio.id" @submit.prevent="validateBeforeSubmit" accept-charset="UTF-8" novalidate="novalidate" enctype="multipart/form-data">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <v-layout column wrap>
                                    <v-layout row wrap>
                                       <v-flex xs12>
                                          <v-text-field label="Cifra" v-model="beneficio.cifra" :value="beneficio.cifra" name="cifra"></v-text-field>
                                       </v-flex>
                                    </v-layout>
                                    <v-layout>
                                       <v-flex xs12>
                                          <v-text-field
                                             label="Detalle"
                                             :rules="[(v) => v.length <= 500 || 'Max 500 characters']"
                                             :counter="500"
                                             v-model="beneficio.detalle" :value="beneficio.detalle"
                                             name="detalle"
                                             multi-line
                                             ></v-text-field>
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
