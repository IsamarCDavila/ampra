<v-navigation-drawer
    stateless
    value="true"
    id="menuadmin"
  >
    <v-list>
      <v-list-tile>
        {{-- <v-list-tile-action>
          <v-icon>home</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>Home</v-list-tile-title> --}}
        <v-list class="pa-0">
          <v-list-tile avatar>
            <img src={{url('images/logo.png')}} class="img-responsive" alt="img-responsive">
            <v-list-tile-content>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-list-tile>
      <br>
      <br>
      <v-list-group
        prepend-icon="home"
        value="true"
      >
        <v-list-tile slot="activator">
          <v-list-tile-title>Contenido</v-list-tile-title>
        </v-list-tile>
        <a class="list__tile list__tile--link" :href="ruta_admin+'/paginas'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">pages</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Páginas</div>
          </div>
        </a>

        <a class="list__tile list__tile--link" :href="ruta_admin+'/portafolio'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">folder_open</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Portafolio</div>
          </div>
        </a>

        <v-list-group
          sub-group
          no-action
          value="true"
        >
          <v-list-tile slot="activator">
            <v-list-tile-title>Comunidad</v-list-tile-title>
          </v-list-tile>

          <v-list-tile
            v-for="(comunidad, i) in comunidades"
            :key="i"
            @click=""
          >
          <v-list-tile-action>
            <v-icon v-text="comunidad[1]"></v-icon>
          </v-list-tile-action>
            <a :href="ruta_admin+comunidad[2]"><v-list-tile-title v-text="comunidad[0]"></v-list-tile-title></a>

          </v-list-tile>
        </v-list-group>

        <a class="list__tile list__tile--link" :href="ruta_admin+'/contacto'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">contact_phone</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Contacto</div>
          </div>
        </a>
        <a class="list__tile list__tile--link" :href="ruta_admin+'/suscriptores'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">notifications</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Suscriptores</div>
          </div>
        </a>
        <a class="list__tile list__tile--link" :href="ruta_admin+'/clientes'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">group</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Clientes</div>
          </div>
        </a>
        <a class="list__tile list__tile--link" :href="ruta_admin+'/certificaciones'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">note</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Certificaciones</div>
          </div>
        </a>
        <a class="list__tile list__tile--link" :href="ruta_admin+'/servicios'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">queue</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Servicios</div>
          </div>
        </a>
        <a class="list__tile list__tile--link" :href="ruta_admin+'/redessociales'">
          <div class="list__tile__action">
            <i aria-hidden="true" class="icon material-icons">public</i>
          </div>
          <div class="list__tile__content">
            <div class="list__tile__title">Redes Sociales</div>
          </div>
        </a>

      </v-list-group>
    </v-list>
  </v-navigation-drawer>
