<div class="hero_detalle secccion_nosotros section_alquiler">
    <v-layout  row wrap>
        <v-flex xs12 sm12>
            <h1 class="text-center">@{{titulo}}</h1><br>
            <a href="#footer" class="ancla_contactanos" data-ancla="footer"><span class="btn_contacto">CONTACTÁNOS</span></a>
        </v-flex>
    </v-layout>
    <v-layout  row  wrap>
        <v-flex xs12 sm3>
            <p class="intro"> <strong>@{{descripcion_corta}} </strong> </p>

        </v-flex>
        <v-flex xs12 sm9 class="contenido_detalle">
            <div class="contenido_nosotros">
                <span>@{{descripcion_larga}}</span>
            </div>
        </v-flex>
    </v-layout>
</div>
