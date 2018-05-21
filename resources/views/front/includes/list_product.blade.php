<div class="hero_detalle lista_producto">
    <v-layout  row wrap >
        <v-flex xs6 sm3 v-for="item in servicios">
            <v-layout  row wrap >
                <v-flex xs4 sm3>
                    <img :src="url + '/' + item.imagen_path" class="img-responsive" alt="">
                    <!-- <v-card-media :src="url + '/' + item.imagen_path" height="35%"></v-card-media> -->
                </v-flex>
                <v-flex xs8 sm9>
                    <div class="descripcion_producto">
                        <h3>@{{item.titulo}}</h3>
                        <p>@{{item.descripcion}}</p>
                    </div>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</div>
