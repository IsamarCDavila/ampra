
Vue.component('prod-list', {
    template: `
    <v-layout row wrap class="section_producto">
      <v-flex is="conector" v-for="list_product in productosList" :key="list_product.order">
          <v-card class="tarjetas_contacto" >
            <v-card-media class="hidden-sm-and-down" src="http://via.placeholder.com/350x150" height="200px"></v-card-media>
            <v-card-title primary-title>
              <div>
                <h4 class=" mb-0"><v-icon>store</v-icon>{{list_product.name}}</h4><br>
                <div class="color_gris">{{list_product.detalle}}</div><br>
                <p class="color_gris">{{list_product.email}}</p>
                <p class="color_gris">{{list_product.telefono}}</p>
              </div>
            </v-card-title>
          </v-card>
      </v-flex>
    </v-layout>
    `,
    props: ['productos'],
    data() {
        return {
            productosList: this.productos
        }
    }
});
Vue.component('conector', {
    template: `<v-flex xs12 sm4 class=parent><slot></slot></v-flex>`
});
