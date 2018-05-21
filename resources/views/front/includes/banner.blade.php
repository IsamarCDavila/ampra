<div class="section_banner backcolor_gris">
    <div class="sm12">
        <h1>@{{json_banner.title}}</h1>
        <p>@{{json_banner.descripcion}}</p>
        <a v-if="json_banner.tipo_button==0" :href="json_banner.href_btn"><span class="btn_banner">@{{json_banner.text_btn}}</span></a>
        <span v-if="json_banner.tipo_button==1" class="btn_banner" @click.stop="dialog2 = true">@{{json_banner.text_btn}}</span>

         <v-dialog v-model="dialog2"  max-width="500px">
          <v-card>
              <v-card-actions>
              <v-btn color="primary" flat @click.stop="dialog2=false"><v-icon>clear</v-icon></v-btn>
            </v-card-actions>

            <v-form method="POST" id="formDownloadFile"   :action="url + '/mensaje-brochure'" @submit="checkFormDowload" accept-charset="UTF-8" >
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <v-card-title class="title_form">
                Formulario
              </v-card-title>
              <v-card-text class="modal_brochure">
                  <p>Por favor llena tus datos para descargar nuestro brochure corporativo</p>
                  <v-layout  row warp class="marginb20">
                      <v-flex xs12 sm6>
                          <label for="">Nombre</label><br>
                          <input type="text" name="nombre" required v-model="datosformulario.nombre"><br>
                          <span class="input-group__messages input-group__error error--text ">@{{errors.nombre}}</span>
                          <input type="text" name="id_archivo" style="display:none;" :value="json_banner.id">
                      </v-flex>
                      <v-flex xs12 sm6>
                          <label for="">Apellido</label><br>
                          <input type="text" name="apellido" v-model="datosformulario.apellido"><br>
                          <span class="input-group__messages input-group__error error--text ">@{{errors.apellido}}</span>
                      </v-flex>
                  </v-layout>

                  <v-layout  row warp class="marginb20">
                      <v-flex xs12 sm12>
                          <label for="">Empresa</label><br>
                          <input type="text" name="empresa" v-model="datosformulario.empresa"><br>
                          <span class="input-group__messages input-group__error error--text ">@{{errors.empresa}}</span>
                      </v-flex>
                  </v-layout>

                  <v-layout  row warp class="marginb20">
                      <v-flex xs12 sm6>
                          <label for="">Email</label><br>
                          <input type="text" name="email" v-model="datosformulario.email"><br>
                          <label class="input-group__messages input-group__error error--text ">@{{errors.email}}</label>
                      </v-flex>
                      <v-flex xs12 sm6>
                          <label for="">Teléfono</label><br>
                          <input type="text" name="telefono" v-model="datosformulario.telefono"><br>
                          <span class="input-group__messages input-group__error error--text ">@{{errors.telefono}}</span>
                      </v-flex>
                  </v-layout>
                  <v-layout  row warp class="marginb20">
                      <v-flex xs12 sm12>
                          <label for="">Mensaje</label><br>
                          <textarea id="" cols="30" rows="10" name="mensaje" v-model="datosformulario.mensaje"></textarea><br>
                          <span class="input-group__messages input-group__error error--text ">@{{errors.mensaje}}</span>
                      </v-flex>
                  </v-layout>
                  <v-layout  row warp>
                      <v-flex xs12 sm12>
                          <button type="submit"><span class="btn_banner">Enviar</span></button>
                      </v-flex>

                  </v-layout>


              </v-card-text>
            </v-form>

          </v-card>
        </v-dialog>



    </div>
</div>
