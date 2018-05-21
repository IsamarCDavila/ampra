<div class=" lista_producto seccion_cliente">
    <br><h1 class="text-center">Nuestros Clientes</h1><br>
    <v-layout  row wrap >
        <!-- <v-flex xs12 sm1></v-flex> -->
        <v-flex xs4 sm2 v-for="item in clientes">
            <img :src="url +'/'+ item.logo_path" class="img-responsive" alt="">
        </v-flex>
     </v-layout>
</div>
