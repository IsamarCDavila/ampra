<div class="container_2">
    <div class="galeria">
        <div  class="slick_responsive">
            <div class="oficina_slider">
                <div v-for="value in oficina">
                    <a :href="value.link">
                        <img :src="value.imagen"  class="img_slider img-responsive-slider" alt="img-oficina">
                    </a>	
                    <v-layout  row wrap >
                        <v-flex xs10> 
                            <span>
                                <h4>@{{value.title}}</h4>
                                <p>@{{value.descripcion}}</p>
                            </span>
                        </v-flex>
                        <v-flex xs2> 
                            <a :href="value.link" >
                                <div class="ico-inicio">
                                    <v-btn icon >
                                        <v-icon>arrow_forward</v-icon>
                                    </v-btn>
                                </div>
                            </a>
                        </v-flex>
                    </v-layout>   
                    
                </div>
            </div>
        </div>
        <v-layout  row wrap class=row_galeria>
            <v-flex xs12 sm6 class="column_grande">
                <div class="bloque_grande  centrar_imgaen_background" v-for="(value, i) in oficina" v-if="value.orden == 0" v-bind:style="{ 'background-image': 'url('+ value.imagen + ')' }" >
                    <v-layout  row wrap >
                        <v-flex xs12 sm10>
                            <div class="descripcion_galeria">
                                <h2>@{{value.title}}</h2>
                                <p>@{{value.descripcion}}</p>
                            </div>
                        </v-flex>
                        <v-flex xs12 sm2>
                            <a :href="value.link" >
                                <div class="ico-inicio">
                                    <v-btn icon >
                                        <v-icon>arrow_forward</v-icon>
                                    </v-btn>
                                </div>
                            </a>
                        </v-flex>
                    </v-layout>
                </div>
            </v-flex>
            <v-flex xs12 sm6 class="column_mediano">
                <v-layout  row class="row_mediano" v-for="(value, i) in oficina"  v-if="i>0 && i<3"  >
                    <div class="bloque_mediano centrar_imgaen_background" v-bind:style="{ 'background-image': 'url('+ value.imagen + ')' }">
                        <v-layout  row wrap  class="row_contenedor">
                            <v-flex xs12 sm10 >
                                <div class="descripcion_galeria">
                                    <h2>@{{value.title}}</h2>
                                    <p>@{{value.descripcion}}</p>
                                </div>
                            </v-flex>
                            <v-flex xs12 sm2 >
                                <a :href="value.link">
                                    <div class="ico-inicio">
                                        <v-btn icon>
                                            <v-icon>arrow_forward</v-icon>
                                        </v-btn>
                                    </div>
                                </a>
                            </v-flex>
                        </v-layout>

                    </div>
                </v-layout>
            </v-flex>
        </v-layout>



        <v-layout row wrap class="mas_portafolio">
                <v-flex xs12 sm6 v-for="(value, i) in oficina" v-if="i>2" class="column_mediano">
                    <div class="bloque_mediano centrar_imgaen_background row_mediano"   v-bind:style="{ 'background-image': 'url('+ value.imagen + ')' }">
                        <v-layout  row wrap  class="galeria_row">
                            <v-flex xs12 sm10>
                                <div class="descripcion_galeria">
                                    <h2>@{{value.title}}</h2>
                                    <p>@{{value.descripcion}}</p>
                                </div>
                            </v-flex>
                            <v-flex xs12 sm2>
                                <a :href="value.link" >
                                    <div class="ico-inicio">
                                        <v-btn icon >
                                            <v-icon>arrow_forward</v-icon>
                                        </v-btn>
                                    </div>
                                </a>
                            </v-flex>
                        </v-layout>
                    </div>
                </v-flex>
        </v-layout>
        
    </div>
</div>
