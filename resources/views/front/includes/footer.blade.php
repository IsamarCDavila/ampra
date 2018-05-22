
    <!-- <div class="container_3 mapa_footer" v-if ="{{$pagina}} !=comunidad"> -->
      <div class="container_3 mapa_footer formulario_inicial">
      <v-layout row wrap>
      @if ($pagina != 'portafoliodetalle')
       <v-flex xs12 sm5>
      @else
      <v-flex xs12 sm8 offset-sm2>
      @endif
         <div class="contenedor_contacto">
           <p>Di, Holaaaa</p>
           <h1>Contacto</h1>
          {{-- <v-form v-model="valid" ref="form" class="form" lazy-validation> --}}
          @if ($pagina != 'portafoliodetalle')
            <v-form method="POST" id="formContacto"  class="form" :action="url_sendContacto" @submit="checkForm" accept-charset="UTF-8" novalidate="true" >
          @else
            <v-form method="POST" id="formContacto"  class="form form_portafolio" :action="url_sendContacto" @submit="checkForm" accept-charset="UTF-8" novalidate="true" >
          @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <v-layout row wrap>
               <v-flex xs12 sm6>
                 <v-text-field
                   class="input_form"
                   label="Nombre*"
                   name="nombre"
                   type="text"
                   v-model="nombre"
                   id="nombre"
                   >
                 </v-text-field>
                 {{-- <div class="input-group__details input-group__details_dos"><div class="input-group__messages input-group__error error--text ">  @{{ error_nombre }}</div></div> --}}
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                  class="input_form"
                  label="Apellido*"
                  name="apellido"
                  type="text"
                  v-model="apellido"
                  id="apellido"
                  {{-- :error-messages="error_apellido"
                  :error="showError" --}}
                  >
                </v-text-field>
                {{-- <div class="input-group__details input-group__details_dos"><div class="input-group__messages input-group__error error--text ">  @{{ error_apellido }}</div></div> --}}
              </v-flex>
            </v-layout>

            <v-layout row wrap>
              {{-- <v-flex xs12 sm6>
                <v-select
                  class="input_form"
                  label="Metros cuadrados"
                  :items="items"
                  id="metros"
                ></v-select>
                <v-text-field
                  class="input_form "
                  name="metros"
                  v-model="contacto.metros"
                  >
                </v-text-field>
              </v-flex> --}}
              <v-flex xs12 sm6>
                <v-select
                  class="input_form"
                  label="Metros cuadrados"
                  v-model="contacto.metros"
                  :items="items"
                  required
                  id="metros"
                ></v-select>
                <v-text-field
                  class="input_form hidden "
                  name="metros"
                  v-model="contacto.metros"
                  >
                </v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-select
                  class="input_form"
                  label="Distrito"
                  v-model="contacto.distrito"
                  :items="items"
                  required
                  id="distrito"
                ></v-select>
                <v-text-field
                  class="input_form hidden"
                  name="distrito"
                  v-model="contacto.distrito"
                  >
                </v-text-field>
              </v-flex>
            </v-layout>
            <v-layout row wrap>
              <v-text-field
                class="input_form"
                label="Empresa*"
                name="empresa"
                type="text"
                v-model="empresa"
                id="empresa"
                >
              </v-text-field>
              {{-- <div class="input-group__details input-group__details_dos"><div class="input-group__messages input-group__error error--text ">  @{{ error_empresa }}</div></div> --}}
            </v-layout>
            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-text-field
                  class="input_form"
                  label="E-mail*"
                  name="email"
                  type="email"
                  v-model="email"
                  id="email"
                  >
                </v-text-field>
                {{-- <div class="input-group__details"><div class="input-group__messages input-group__error error--text ">  @{{ error_mail }}</div></div> --}}
              </v-flex>


               <v-flex xs12 sm6>
                 <v-text-field
                   class="input_form"
                   label="Teléfono*"
                   name="telefono"
                   type="text"
                   v-model="telefono"
                   id="telefono"
                   >
                 </v-text-field>
                 {{-- <div class="input-group__details"><div class="input-group__messages input-group__error error--text ">  @{{ error_telefono }}</div></div> --}}
              </v-flex>
            </v-layout>
            <v-layout row wrap>
              <v-text-field
                class="input_form"
                label="Mensaje*"
                name="mensaje"
                type="text"
                v-model="mensaje"
                id="mensaje"
                >
              </v-text-field>
              {{-- <div class="input-group__details"><div class="input-group__messages input-group__error error--text ">  @{{ error_mensaje}}</div></div> --}}

            </v-layout>
            {{-- <input type="hidden" name="id_pagina" value="{{$pagina}}"> --}}
            <v-layout row wrap>

              {{-- <input type="email" class="input_suscribete" v-model="email" id="email" name="email" placeholder="SUSCRIBETE"> --}}
              <input class="btn btn_suscribete" type="submit" value="Enviar"></input>

            </v-layout>
          </v-form>


         </div>
       </v-flex>
       @if ($pagina != 'portafoliodetalle')
       <v-flex hidden-sm-and-down sm7>
         <!-- <img src="images/mapa.png" class="img-responsive" alt=""> -->
         <div class="contenedor_mapa">
            <div id="mapa"></div>
        </div>
       </v-flex>
       @endif
     </v-layout>
    </div>




{{-- <div class="container_3 mapa_footer formulario_portafolio">
      <v-layout row wrap>
        <v-flex xs12 sm2></v-flex>
       <v-flex xs12 sm8>


         <div class="contenedor_contacto portafolio">
           <p class="text-center">Di, Hola</p>
           <h1 class="text-center">Contacto</h1>
            <v-form v-model="valid" ref="form" class="form form_portafolio" lazy-validation>
              <v-layout row wrap>
                <v-flex xs12 sm6>
                  <v-text-field
                    class="input_form"
                    label="Nombre"
                    v-model="name"
                    :rules="inputRules"
                    :counter="10"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    label="Apellido"
                    v-model="apellido"
                    :rules="inputRules"
                    :counter="10"
                    required
                  ></v-text-field>
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-flex xs12 sm6>
                  <v-select
                    class="input_form"
                    label="Metros cuadrados"
                    v-model="metros"
                    :items="items"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-select
                    label="Distrito"
                    v-model="distrito"
                    :items="items"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-select>
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-text-field
                  label="Empresa"
                  v-model="empresa"
                  :rules="inputRules"
                  :counter="10"
                  required
                ></v-text-field>
              </v-layout>
              <v-layout row wrap>
                <v-flex xs12 sm6>
                  <v-text-field
                    class="input_form"
                    label="E-mail"
                    v-model="email"
                    :rules="emailRules"
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-text-field
                    label="Telefono"
                    v-model="telefono"
                    :rules="emailRules"
                    required
                  ></v-text-field>
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-text-field
                  label="Mensaje"
                  v-model="mensaje"
                  :rules="emailRules"
                  required
                ></v-text-field>
              </v-layout>
              <v-layout row wrap >
                <!-- <v-btn
                  @click="submit"
                  :disabled="!valid"
                > -->
                <v-btn
                @click="gracias"
                >
                  Enviar
                </v-btn>
                <!-- <v-btn @click="clear">clear</v-btn> -->
              </v-layout>
            </v-form>


         </div>


       </v-flex>
     </v-layout>
    </div> --}}




    <v-footer height="auto">
      <v-card flat tile class="flex">
        <v-card-text  class="grey darken-2">
          <v-layout>
            <v-flex
              class="col_footer"
              v-for="(col, i) in rows"
              :key="i"
              xs12 sm4
            >
                <div class="contenedor_footer">
                    <span class="body-2" v-text="col.title.toUpperCase()"></span>
                    <br>
                    <br>


                    <div
                        class="child"
                        v-for="(child, i) in col.children"
                        :key="i"
                    >
                    <v-icon
                    class="icon_footer"
                    v-text="child.icon"
                    ></v-icon>
                    <span
                      :class="child.href"
                      v-text="child.descripcion"
                      @click="href(child.href)"

                    ></span>

                    <br>
                    <br>
                </div>
                </div>
            </v-flex>

          </v-layout>
        </v-card-text>
        <v-card-actions class="grey darken-3 justify-center">
        <v-layout wrap class="footer_desktop">
            <v-flex xs12 sm6 >
            <span>Ampra Consultant, 2018. &copyAll rights reserved </span>
            </v-flex>
            <v-flex xs12 sm6>
                <span>Términos y Condiciones | Política de Privacidad y Protección de datos</span>
            </v-flex>
        </v-layout>

        <v-layout wrap class="footer_responsive">
            <v-flex xs12>
            <span>Privacidad | Términos y Condiciones </span>
            </v-flex>
            <v-flex xs12>
                <span>&copy Ampra Consultant, 2018. All rights reserved</span>
            </v-flex>
            <v-flex xs12  class="intranet_responsive">
                <span class="btn_intranet">INGRESAR A INTRANET</span>
            </v-flex>
        </v-layout>

        </v-card-actions>
      </v-card>
    </v-footer>
  <!-- </v-app> -->
</div>
