
        <v-list class="pa-1">
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <a href="{{ url("/") }}"><img src="{{ url("/images/logo_menu.png") }}" ></a>
            </v-list-tile-avatar>
          </v-list-tile>
        </v-list>
        <v-list class="pt-0" dense>
          <v-divider></v-divider>
          <v-list-tile>
            <v-list-tile-content>
              <a href="{{ url("/") }}">
                <v-list-tile-title>INICIO</v-list-tile-title>
              </a>
            </v-list-tile-content>
          </v-list-tile>


          <v-list-tile @click="hrefPortafolio()" id="itemportafolio">
            <v-list-tile-content>
                <v-list-tile-title>PORTAFOLIO</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-group
            class="portafolio_btn"
            sub-group
            no-action
            ref="fileInput"
            id="btn-portafolio"
          >
            <v-list-tile
              v-for="crud in portafolio"
              :key="crud.id"
              @click="vista(crud)"
            >
              <v-list-tile-title v-text="crud.menu"></v-list-tile-title>

            </v-list-tile>
          </v-list-group>



          <v-list-group
            sub-group
            no-action
            class="header_comunidad"
            id="itemcomunidad"
          >
            <v-list-tile slot="activator"
              >
                <v-list-tile-title>COMUNIDAD</v-list-tile-title>
            </v-list-tile>
            <v-list-tile
              v-for="(crud, i) in comunidad"
              :key="i"
              @click="vista(crud[0])"
            >
              <v-list-tile-title v-text="crud[0]"></v-list-tile-title>

            </v-list-tile>
          </v-list-group>

          <v-list-tile  @click="vista('NOSOTROS')">
            <v-list-tile-content>
              <a href="{{ url("/nosotros") }}">
                <v-list-tile-title>NOSOTROS</v-list-tile-title>
              </a>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>



        <div class="pt-0 redes" dense>
          <a :href="red.url" v-for="red in redes" class="red-social" target="_blank">
            <v-btn icon >
                <v-icon>@{{red.icono}}</v-icon>
            </v-btn>
          </a>
          <v-list-tile  class="btn_list" @click="">
            <v-list-tile-content class="btn_idioma">
              <v-list-tile-title>ES</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider class="divider_line"></v-divider>
          <v-list-tile class="btn_list" @click="">
            <v-list-tile-content class="btn_idioma">
              <v-list-tile-title>EN</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

        </div>
