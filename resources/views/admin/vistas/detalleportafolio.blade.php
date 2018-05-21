@extends('app.appadmin') @section('style')
<script>
   var id_detalleportafolio = {!!$id_detalleportafolio!!};
</script>
@endsection @section('script')
<script src="<?php echo URL::asset('js/Paginacion.js'); ?>"></script>
<script src="<?php echo URL::asset('js/dialog_components.js'); ?>"></script>
<script src="<?php echo URL::asset('js/detalleportafolio.js'); ?>"></script>
@endsection
<!-- /.heading-->
@section('content')
<div id="table-detalleportafolio">
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
                                 <h3 class="headline mb-0">{{$portafolio->nombre}} - Secciones</h3>
                              </div>
                           </v-card-title>
                           <v-spacer></v-spacer>
                           <v-tabs fixed-tabs>
                              <v-tab ripple>Beneficios</v-tab>
                              <v-tab ripple>Multimedia</v-tab>
                              <v-tab ripple>Carousel de Imágenes</v-tab>
                              <v-tab ripple>equipo</v-tab>
                              <v-tab-item>
                                 <v-card flat>
                                    <v-card-text></v-card-text>
                                    <v-layout  row wrap>
                                       <v-flex xs12 class="alignight">
                                          <v-btn class="btn-xs indigo btnText" @click.prevent="showcrear()">+ Nuevo Beneficio</v-btn>
                                       </v-flex>
                                    </v-layout>
                                    <table class="table table-style">
                                       <tr>
                                          <th>Cifra</th>
                                          <th>Detalle</th>
                                          <th class="tamAcciones">Acción</th>
                                       </tr>
                                       <tr v-for="item in beneficios">
                                          <td>@{{ item.cifra }}</td>
                                          <td>@{{ item.detalle }}</td>
                                          <td>
																						 <v-btn fab dark small color="cyan" @click.prevent="showeditar_beneficio(item)"> <v-icon >edit</v-icon>
																						 </v-btn>
                                             <v-btn fab dark small color="error" @click.prevent="showConfirmationBeneficio(item)"> <v-icon >delete_forever</v-icon>
                                             </v-btn>
                                          </td>
                                       </tr>
                                    </table>
                                 </v-card>
                              </v-tab-item>
                              <v-tab-item>
                                 <v-card flat>
                                    <v-card-text></v-card-text>
                                    <v-layout  row wrap>
                                       <v-flex xs12 class="alignight">
                                          <v-btn class="btn-xs indigo btnText" @click.prevent="showcrear_multimedia()">+ Nuevo Multimedia</v-btn>
                                       </v-flex>
                                    </v-layout>
                                    <table class="table table-style">
                                       <tr>
                                          <th>Titulo</th>
                                          <th>Descripción</th>
                                          <th width="300px">Imagen</th>
                                          <th>Video</th>
                                          <th class="tamAcciones">Acción</th>
                                       </tr>
                                       <tr v-for="item in multimedia">
                                          <td>@{{ item.titulo }}</td>
                                          <td>@{{ item.descripcion }}</td>
                                          <td class="text-xs-right"><img width="60%" v-if="item.imagen_path!=null" v-bind:src="url +'/'+ item.imagen_path" /></td>
                                          <td>@{{ item.video }}</td>
                                          <td>
                                             <v-btn fab dark small color="cyan" @click.prevent="showeditar_multimedia(item)">
                                                <v-icon>edit</v-icon>
                                             </v-btn>
                                             <v-btn fab dark small color="error" @click.prevent="showConfirmationMultimedia(item)"> <v-icon >delete_forever</v-icon>
                                             </v-btn>
                                          </td>
                                       </tr>
                                    </table>
                                 </v-card>
                              </v-tab-item>
                              <v-tab-item>
                                 <v-card flat>
                                    <v-card-text></v-card-text>
																		<v-layout  row wrap>
                                       <v-flex xs12 class="alignight">
                                          <v-btn class="btn-xs indigo btnText" @click.prevent="showcrear_imagen()">+ Nueva Imagen</v-btn>
                                       </v-flex>
                                    </v-layout>
                                    <table class="table table-style">
                                       <tr>
                                          <th width="300px">Imagen</th>
                                          <th>Path</th>
                                          <th class="tamAcciones">Acción</th>
                                       </tr>
                                       <tr v-for="item in slicks">
                                          <td class="text-xs-right"><img width="60%" v-if="item.imagen_path!=null" v-bind:src="url +'/'+ item.imagen_path" /></td>
                                          <td>@{{item.imagen_path}}</td>
                                          <td>
																						 <v-btn fab dark small color="cyan" @click.prevent="showeditar_slickimagen(item)"> <v-icon >edit</v-icon>
																						 </v-btn>
                                             <v-btn fab dark small color="error" @click.prevent="showConfirmationSlick(item)"> <v-icon >delete_forever</v-icon>
                                             </v-btn>
                                          </td>
                                       </tr>
                                    </table>
                                 </v-card>
                              </v-tab-item>
                              <v-tab-item>
                                 <v-card flat>
                                    <v-card-text></v-card-text>
                                    <v-layout  row wrap>
                                       <v-flex xs12 class="alignight">
                                          <v-btn class="btn-xs indigo btnText" @click.prevent="showcrear_equipo()">+ Nuevo Equipo</v-btn>
                                       </v-flex>
                                    </v-layout>
                                    <table class="table table-style">
                                          <tr>
                                             <th>Nombre</th>
                                             <th>Descripción</th>
                                             <th width="300px">Imagen</th>
                                             <th class="tamAcciones">Acción</th>
                                          </tr>
                                          <tr v-for="item in equipo">
                                             <td>@{{ item.nombre }}</td>
                                             <td>@{{ item.descripcion }}</td>
                                             <td class="text-xs-right"><img width="60%" v-if="item.imagen_path!=null" v-bind:src="url +'/'+ item.imagen_path" /></td>
                                             <td>
                                                <v-btn fab dark small color="cyan" @click.prevent="showeditar_equipo(item)"> <v-icon >edit</v-icon>
                                                </v-btn>
                                                <v-btn fab dark small color="error" @click.prevent="showConfirmationEquipo(item)"> <v-icon >delete_forever</v-icon>
                                                </v-btn>
                                             </td>
                                          </tr>
                                    </table>
                                 </v-card>
                              </v-tab-item
                           </v-tabs>
                        </v-card>
                        <!--Inicio Modal-->
                        <v-dialog v-model="dialognew" max-width="500px">
                           <form data-vv-scope="form-1">
                           <v-card>
                              <v-card-title class="title-modal">
                                 Nuevo Beneficio
                              </v-card-title>
                              <v-card-text>
                                 <v-text-field
                                     id="newcifra"
                                     v-model="newcifra"
                                     label="Ingrese cifra"
                                     :error-messages="errors.collect('cifra')"
                                     v-validate="'required'"
                                     data-vv-name="cifra"
                                     name="cifra"
                                     required
                                  ></v-text-field>
                                    <v-text-field
                                       id="newdetalle"
                                        v-model="newdetalle"
                                        label="Ingrese detalle"
                                        :error-messages="errors.collect('detalle')"
                                        v-validate="'required'"
                                        data-vv-name="detalle"
                                        :counter="500"
                                        name="detalle"
                                        multi-line
                                        required
                                     ></v-text-field>
                              </v-card-text>
                              <v-card-actions class="">
                                 <v-btn class="btn indigo btnText" @click.stop="createBeneficio('form-1')">Crear</v-btn>
                                 <v-btn class="btn"  @click.stop="dialognew=false">Cerrar</v-btn>
                              </v-card-actions>
                           </v-card>
                        </form>
                        </v-dialog>
                        <!--fin modal crear-->
                        <!--Inicio Modal-->
                        <v-dialog v-model="dialognew_multimedia" max-width="500px">
                           <v-card>
                              <v-card-title class="title-modal">
                                 Nuevo elemento Multimedia
                              </v-card-title>
                              <v-card-text>
                                 <v-text-field label="Ingrese Título" name="titulo" id="newtitulo_multimedia" ref="t_titulo" v-model="newtitulo"></v-text-field>
                                 <v-text-field
                                    label="Ingrese descripción"
                                    name="descripcion"
                                    id="newdescripcion_multimedia"
                                    ref="t_descripcion"
                                    v-model="newdescripcion"
                                    :counter="500"
                                    multi-line
                                    ></v-text-field>
                                 <v-text-field label="URL video" name="video" id="newvideo_multimedia" ref="t_video" v-model="newvideo"></v-text-field>
                                 <v-layout row wrap>
                                    <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
                                      <input type="file" @change="onFileChange_" name="imagen_img_multimedia" id="newImagen_multimedia" img-name="#img-crearimg_multimedia">
                                      <br>
                                      <br>
                                      <img width="100px" height="100px" id="img-crearimg_multimedia"/>
                                    </v-flex>
                                 </v-layout>
                              </v-card-text>
                              <v-card-actions class="">
                                 <v-btn class="btn indigo btnText" @click.stop="createMultimedia()">Crear</v-btn>
                                 <v-btn class="btn"  @click.stop="dialognew_multimedia=false">Cerrar</v-btn>
                              </v-card-actions>
                           </v-card>
                        </v-dialog>
                        <!--fin modal crear-->
												<!--Inicio Modal-->
                        <v-dialog v-model="dialognew_imagen" max-width="500px">
                           <v-card>
                              <v-card-title class="title-modal">
                                 Nueva Imagen
                              </v-card-title>
                              <v-card-text>
                                 <v-layout row wrap>
                                    <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
																			 <input type="file" @change="onFileChange_" name="imagen_img" id="newImagen" img-name="#img-crearimg">
																			 <br>
                                       <br>
																			 <img width="100px" height="100px" id="img-crearimg"/>
                                    </v-flex>
                                 </v-layout>
                              </v-card-text>
                              <v-card-actions class="">
                                 <v-btn class="btn indigo btnText" @click.stop="createImagen()">Crear</v-btn>
                                 <v-btn class="btn"  @click.stop="dialognew_imagen=false">Cerrar</v-btn>
                              </v-card-actions>
                           </v-card>
                        </v-dialog>
                        <!--fin modal crear-->

												<!-- inicio modal editar beneficio-->
												<v-dialog v-model="dialogedit_beneficio" max-width="500px" >
                                       <form data-vv-scope="form-2">
                           <v-card>
                              <v-card-title class="title-modal">
                                Editar Beneficio
                              </v-card-title>

                              <v-card-text >
                                 {{-- <v-text-field label="Cifra" name="cifra" id="editcifra" :value="beneficio_update.cifra" ></v-text-field> --}}
                                 <v-text-field
                                     id="editcifra"
                                     :value="beneficio_update.cifra"
                                     v-model="cifra"
                                     label="Cifra"
                                     :error-messages="errors.collect('editcifra')"
                                     v-validate="'required'"
                                     data-vv-name="editcifra"
                                     name="editcifra"
                                     required
                                  ></v-text-field>

                                 <v-text-field
                                    id="editdetalle"
                                    :value="beneficio_update.detalle"
                                    v-model="detalle"
                                    label="Detalle"
                                    :error-messages="errors.collect('editdetalle')"
                                    v-validate="'required'"
                                    data-vv-name="editdetalle"
                                    name="editdetalle"
                                    :counter="500"
                                    multi-line
											></v-text-field>
                              </v-card-text>
                              <v-card-actions class="">
                                 <v-btn class="btn indigo btnText" @click.stop="editBeneficio(beneficio_update,'form-2')">Editar</v-btn>
                                 <v-btn class="btn"  @click.stop="dialogedit_beneficio=false">Cerrar</v-btn>
                              </v-card-actions>
                           </v-card>
                        </form>
                        </v-dialog>
												<!--fin modal editar beneficio-->
                        <!--Inicio Modal-->
                        <v-dialog v-model="dialogedit_multimedia" max-width="500px">
                           <v-card>
                              <v-card-title class="title-modal">
                                 Editar elemento Multimedia
                              </v-card-title>
                              <v-card-text>
                                 <v-text-field label="Ingrese Título" name="titulo" id="edittitulo_multimedia" ref="t_titulo" v-model="update_multimedia.titulo"></v-text-field>
                                 <v-text-field
                                    label="Ingrese descripción"
                                    name="descripcion"
                                    id="editdescripcion_multimedia"
                                    ref="t_descripcion"
                                    v-model="update_multimedia.descripcion"
                                    :counter="500"
                                    multi-line
                                    ></v-text-field>
                                 <v-text-field label="URL video" name="video" id="editvideo_multimedia" ref="t_video" v-model="update_multimedia.video"></v-text-field>
                                 <v-layout row wrap>
                                    <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
                                      <input type="file" @change="onFileChange_" name="imagen_img_multimedia" id="editImagen_multimedia" img-name="#img-editimg_multimedia">
                                      <br>
                                      <br>
                                      <img width="100px" height="100px" id="img-editimg_multimedia" :src="url+'/'+update_multimedia.imagen_path"/>
                                    </v-flex>
                                 </v-layout>
                              </v-card-text>
                              <v-card-actions class="">
                                 <v-btn class="btn indigo btnText" @click.stop="editMultimedia(update_multimedia)">Editar</v-btn>
                                 <v-btn class="btn"  @click.stop="dialogedit_multimedia=false">Cerrar</v-btn>
                              </v-card-actions>
                           </v-card>
                        </v-dialog>
                        <!--fin modal crear-->
												<!--Inicio Modal Eitar imagen slick-->
												<v-dialog v-model="dialogedit_imagen" max-width="500px">
													 <v-card>
															<v-card-title class="title-modal">
																 Editar Imagen
															</v-card-title>
															<v-card-text>
																 <v-layout row wrap>
																		<v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
																			 <v-text-field   class="contenidoImagen"  label="Imagen" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
																			 <input
																					type="file"
																					style="display: none"
																					ref="image"
																					name="imagen_img"
																					accept="image/*"
																					@change="onFilePicked"
                                          id="editImagenslick"
																					>
																			 <div>
																				   <img class="sizeImage hiddenImage" :src="url + '/' + slickimagen_update.imagen_path" v-if="slickimagen_update.imagen_path"/>
																					 <img class="sizeImage" v-if="imageUrl" :src="imageUrl"/>
																			 </div>
																		</v-flex>
																 </v-layout>
															</v-card-text>
															<v-card-actions class="">
																 <v-btn class="btn indigo btnText" @click.stop="editImagenSlick(slickimagen_update)">Editar</v-btn>
																 <v-btn class="btn"  @click.stop="dialogedit_imagen=false">Cerrar</v-btn>
															</v-card-actions>
													 </v-card>
												</v-dialog>
												<!--fin modal editar imagen slick-->

                        <!--Inicio Modal crear equipo slick-->
                        <v-dialog v-model="dialognew_equipo" max-width="500px">
                           <v-card>
                              <v-card-title class="title-modal">
                                 Crear Equipo
                              </v-card-title>
                              <v-card-text>
                                 <v-layout row wrap>
                                     <v-flex md12>
                                   <v-text-field label="Ingrese Nombre" name="nombre" id="newnombre_equipo"></v-text-field>
                                   <v-text-field
                                      label="Ingrese descripción"
                                      name="descripcion"
                                      id="newdescripcion_equipo"
                                      ref="t_descripcion"
                                      :counter="500"
                                      multi-line
                                      ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
                                       <input type="file" @change="onFileChange_" name="imagen_img_equipo" id="newImagenEquipo" img-name="#img-crearimgequipo">
                                       <br>
                                       <br>
                                       <img width="100px" height="100px" id="img-crearimgequipo"/>
                                    </v-flex>
                                 </v-layout>
                              </v-card-text>
                              <v-card-actions class="">
                                 <v-btn class="btn indigo btnText" @click.stop="createEquipo()">Crear</v-btn>
                                 <v-btn class="btn"  @click.stop="dialognew_equipo=false">Cerrar</v-btn>
                              </v-card-actions>
                           </v-card>
                        </v-dialog>
                        <!--fin modal crear equipo slick-->
                        <!--Inicio Modal crear equipo slick-->
                        <v-dialog v-model="dialogedit_equipo" max-width="500px">
                           <v-card>
                              <v-card-title class="title-modal">
                                 Editar Equipo
                              </v-card-title>
                              <v-card-text>
                                 <v-layout row wrap>
                                   <v-flex xs12 class="sinpaddingleft text-xs-center text-sm-center text-md-center text-lg-center">
                                   <v-text-field label="Ingrese Nombre" name="nombre" id="editnombre_equipo" :value="update_equipo.nombre"></v-text-field>
                                   <v-text-field
                                      label="Ingrese descripción"
                                      name="descripcion"
                                      id="editdescripcion_equipo"
                                      ref="t_descripcion"
                                      :counter="500"
                                      multi-line
                                      :value="update_equipo.descripcion"
                                      ></v-text-field>

                                       <input type="file" @change="onFileChange_" name="imagen_img_equipo" id="editImagenEquipo" img-name="#img-editimgequipo">
                                       <br>
                                       <br>
                                       <img width="100px" height="100px" id="img-editimgequipo" :src="url +'/' +update_equipo.imagen_path"/>
                                    </v-flex>
                                 </v-layout>
                              </v-card-text>
                              <v-card-actions class="">
                                 <v-btn class="btn indigo btnText" @click.stop="editEquipo(update_equipo)">Editar</v-btn>
                                 <v-btn class="btn"  @click.stop="dialogedit_equipo=false">Cerrar</v-btn>
                              </v-card-actions>
                           </v-card>
                        </v-dialog>
                        <!--fin modal crear equipo slick-->

                        <v-dialog v-model="dialogconfirmation_beneficio" max-width="500px">
                          <v-card>
                            <v-card-title class="title-modal">
                              Eliminar item
                            </v-card-title>
                            <v-card-text>
                              ¿Está seguro que desea eliminar el item?
                            </v-card-text>
                            <v-card-actions class="row-actions">
                            <v-btn class="btn indigo btnText" @click.stop="deleteBeneficio(beneficio_delete)">Sí, Eliminar</v-btn>
                            <v-btn class="btn" flat @click.stop="dialogconfirmation_beneficio=false">Cancelar</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogconfirmation_multimedia" max-width="500px">
                          <v-card>
                            <v-card-title class="title-modal">
                              Eliminar item
                            </v-card-title>
                            <v-card-text>
                              ¿Está seguro eliminar el item?
                            </v-card-text>
                            <v-card-actions class="row-actions">
                              <v-btn class="btn indigo btnText" @click.stop="deleteMultimedia(multimedia_delete)">Sí, Eliminar</v-btn>
                              <v-btn class="btn" flat @click.stop="dialogconfirmation_multimedia=false">Cancelar</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogconfirmation_slick" max-width="500px">
                          <v-card>
                            <v-card-title class="title-modal">
                              Eliminar item
                            </v-card-title>
                            <v-card-text>
                              ¿Está seguro eliminar el item?
                            </v-card-text>
                            <v-card-actions class="row-actions">
                              <v-btn class="btn indigo btnText" @click.stop="deleteSlick(slick_delete)">Sí, Eliminar</v-btn>
                              <v-btn class="btn" flat @click.stop="dialogconfirmation_slick=false">Cancelar</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogconfirmation_equipo" max-width="500px">
                          <v-card>
                            <v-card-title class="title-modal">
                              Eliminar item
                            </v-card-title>
                            <v-card-text>
                              ¿Está seguro eliminar el item?
                            </v-card-text>
                            <v-card-actions class="row-actions">
                              <v-btn class="btn indigo btnText" @click.stop="deleteEquipo(equipo_delete)">Sí, Eliminar</v-btn>
                              <v-btn class="btn" flat @click.stop="dialogconfirmation_equipo=false">Cancelar</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                        <dialog-error is="dialog-error" :dialogerror="dialogerror" @closedialogerror="closeDialogError()"></dialog-error>
                     </v-flex>
                  </v-layout>
               </v-flex>
            </v-layout>
         </v-container>
      </v-content>
   </v-app>
</div>
@endsection
