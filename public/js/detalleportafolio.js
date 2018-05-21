Vue.use(VeeValidate);
new Vue({
      el: '#table-detalleportafolio',
      data: {
            id_detalleportafolio: id_detalleportafolio,
            beneficios: [],
            slicks: [],
            items: [],
            multimedia: [],
            equipo: [],
            beneficio_update:{},
            slickimagen_update:{},
            update_equipo:{},
            update_multimedia:{},
            search: '',
            url: ruta_principal,
            url_detalle:'/admin/detalleportafolio/',
            url_edit_beneficios: '/beneficios/edit/',
            url_edit_multimedia: '/multimedia/edit/',
            url_edit_slick: '/slick/edit/',
            url_getdetalle: ruta_principal + '/admin/portafolio/',
            newcifra:'',
            newdetalle:'',
            newtitulo:'',
            newvideo:'',
            newnombre:'',
            newdescripcion:'',
            dialognew:false,
            dialognew_multimedia:false,
            dialognew_imagen:false,
            dialogedit_beneficio:false,
            dialogedit_imagen:false,
            dialogedit_multimedia:false,
            dialognew_equipo:false,
            dialogedit_equipo:false,
            dialogerror:false,
            dialogconfirmation_beneficio:false,
            multimedia_delete:{},
            dialogconfirmation_multimedia :false,
            equipo_delete:{},
            dialogconfirmation_equipo :false,
            slick_delete:{},
            dialogconfirmation_slick :false,
            editcifra:'',
            editdetalle:'',
            cifra:'',
            detalle:'',
            image: '',
            imageName: '',
            imageUrl: '',
            imageFile: '',
            formErrors:{},
            formErrorsUpdate:{},
            newItem : {'title':'','description':''},
            fillItem : {'title':'','description':'','id':''}
    },
    created : function(){
              this.getBeneficios();
              this.getSlick();
              this.getMultimedia();
              this.getEquipo();
    },
    methods : {
          getBeneficios: function(){
            let vm = this;
            vm.$http.get(ruta_principal+'/admin/detalleportafolio/getbeneficios?id_detailportfolio='+this.id_detalleportafolio).then((response) => {
             // console.log('data',response.data);
              vm.beneficios = response.data;
            });
            },
            getSlick: function(){
                  let vm = this;
                  vm.$http.get(ruta_principal+'/admin/detalleportafolio/getslick?id_detailportfolio='+this.id_detalleportafolio).then((response) => {
                  vm.slicks = response.data;
            });
            },
            getMultimedia: function(){
                  let vm = this;
                  vm.$http.get(ruta_principal+'/admin/detalleportafolio/getmultimedia?id_detailportfolio='+this.id_detalleportafolio).then((response) => {
                  vm.multimedia = response.data;
            });
            },
            getEquipo: function(){
                  let vm = this;
                  vm.$http.get(ruta_principal+'/admin/detalleportafolio/getequipo?id_detailportfolio='+this.id_detalleportafolio).then((response) => {
                  vm.equipo = response.data;
            });
            },
            showcrear: function(item){
                  this.newcifra = '';
                  this.newdetalle = '';
                  this.dialognew = true;
                  this.$validator.reset();
            },
           showcrear_multimedia: function(item){
                 this.newtitulo = '';
                 this.newdescripcion= '';
                 this.dialognew_multimedia = true;
                 this.$validator.reset();
           },
           showcrear_imagen: function(item){
                 this.newimagen = '';
                 this.newpath_imagen= '';
                 this.dialognew_imagen = true;
                 this.$validator.reset();
           },
           showeditar_beneficio: function(item){
                this.beneficio_update = item;
                this.cifra=item.cifra;
                this.detalle=item.detalle;
                this.dialogedit_beneficio = true;
                this.$validator.reset();
           },
           showeditar_slickimagen: function(item){
               this.slickimagen_update = item;
               this.dialogedit_imagen = true;
          },
          showeditar_multimedia: function(item){
              this.update_multimedia = item;
              this.dialogedit_multimedia = true;
         },
          showcrear_equipo: function(){
                $('#newnombre_equipo').val('');
                $('#newdescripcion_equipo').val('');
                $('#img-crearimgequipo').attr('src','');
               this.dialognew_equipo = true;
          },
          showeditar_equipo: function(item){
              $('#editnombre_equipo').val('');
              $('#editdescripcion_equipo').val('');
              $('#img-editimgequipo').attr('src','');
              this.update_equipo = item;
              this.dialogedit_equipo = true;
          },
          createBeneficio: function(scope){
           let vm = this;
           this.$validator.validateAll(scope).then(function (result) {
            if (result) {
                var formData = {};
                formData._token = $('meta[name="csrf-token"]').attr('content');
                formData.cifra = $('#newcifra').val();
                formData.detalle = $('#newdetalle').val();
                formData.iddetalleportafolio= id_detalleportafolio;
                $.ajax({
                  url: ruta_principal+'/admin/detalleportafolio/createbeneficio',
                  type: "POST",
                  data : formData,
                            success: function (result) {
                                if(result.success==true){
                                  vm.beneficios.push(result.item);
                                  vm.dialognew = false;

                                }
                            }
                       });
                         this.$validator.reset();
           } else {
                    // validation failed.
                    console.log('validation failed.');
                  }
            })
          },

            pickFile () {
                    this.$refs.image.click ();
            },

      nuevaImagen: function(){
        this.newtituloimagen = '';
        $('#img-crearimg').attr('src', '');
        this.dialognew_imagen = true;
      },
      createImagen: function(){
        let vm = this;
        var	imagen = document.getElementById('newImagen');
        var formData = new FormData();
            if(imagen)
      			{
      				if (imagen.files.length > 0) {
      					formData.append('imagen_img', imagen.files[0]);
      				}
      			}
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('iddetalleportafolio', id_detalleportafolio);
        console.log(formData);

        $.ajax({
          url: ruta_principal+'/admin/detalleportafolio/createimagen',
          type: "POST",
          processData: false,
    		  contentType: false,
          data : formData,
                    success: function (result) {
                        if(result.success==true){
                          vm.slicks.push(result.item);
                          vm.dialognew_imagen = false;
                        }
                    }
               });
        },
        createMultimedia: function(item){
          let vm = this;
          var imagen = document.getElementById('newImagen_multimedia');
          var formData = new FormData();
              if(imagen)
              {
                if (imagen.files.length > 0) {
                  formData.append('imagen_img_multimedia', imagen.files[0]);
                }
              }
          formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
          formData.append('iddetalleportafolio', id_detalleportafolio);
          formData.append('titulo', $('#newtitulo_multimedia').val());
          formData.append('descripcion', $('#newdescripcion_multimedia').val());
          formData.append('video', $('#newvideo_multimedia').val());

          $.ajax({
            url: ruta_principal+'/admin/detalleportafolio/createmultimedia',
            type: "POST",
            processData: false,
            contentType: false,
            data : formData,
                      success: function (result) {
                          if(result.success==true){
                            vm.multimedia.push(result.item);
                            vm.dialognew_multimedia = false;
                          }
                      }
                 });
          },
          onFileChange_: function onFileChange_(e) {
            console.log('cambiofile');
                  var files = e.target.files || e.dataTransfer.files;
                  if (!files.length) return;
                  var name = $(e.target).attr('img-name');
                  var image = new Image();
                  var reader = new FileReader();
                  var vm = this;
                  reader.onload = function (e) {
                    $(name).attr('src', e.target.result);
                  };
                  reader.readAsDataURL(files[0]);
                },
            onFileChange: function onFileChange(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    if (!files.length) return;
                    this.createImage(files[0]);
                    console.log('file change');
            },
            createImage: function createImage(file) {
                    var image = new Image();
                    var reader = new FileReader();
                    var vm = this;
                                reader.onload = function (e) {
                                vm.image = e.target.result;
                                };
                    reader.readAsDataURL(file);
            },
            removeImage: function removeImage(e) {
                    this.image = '';
            },

            onFilePicked (e) {
                      const files = e.target.files
                      if(files[0] !== undefined) {
                      this.imageName = files[0].name
                      if(this.imageName.lastIndexOf('.') <= 0) {
                                  return
                      }
                      const fr = new FileReader ()
                      fr.readAsDataURL(files[0])
                      fr.addEventListener('load', () => {
                      this.imageUrl = fr.result
                      this.imageFile = files[0] // this is an image file that can be sent to server...
                      $('.hiddenImage').css('display','none');
                      })
                      } else {
                                  this.imageName = ''
                                  this.imageFile = ''
                                  this.imageUrl = ''
                                  }
                      },
              editBeneficio: function(item,scope){

                let vm = this;
                this.$validator.validateAll(scope).then(function (result) {
                if (result) {
                var formData = {};
                formData._token = $('meta[name="csrf-token"]').attr('content');
                formData.cifra = $('#editcifra').val();
                formData.detalle = $('#editdetalle').val();
                 $.ajax({
                     url: ruta_principal+'/admin/detalleportafolio/updatebeneficio/'+item.id,
                    type: "POST",
                    data : formData,
                             success: function (result) {
                                 if(result.success==true){
                                   var indice = vm.beneficios.indexOf(item);
                                   vm.beneficios[indice] = result.item;
                                   vm.dialogedit_beneficio = false;
                                 }
                             }
                        });

                 } else {
                        // validation failed.
                        console.log('validation failed.');

                      }
                })
              },
              editImagenSlick: function(item){

                let vm = this;

                 var	imagen = document.getElementById('editImagenslick');

                 var formData = new FormData();
                 if(imagen)
                 {
                   if (imagen.files.length > 0) {
                     formData.append('imagen_img', imagen.files[0]);
                   }
                 }
                 formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                 $.ajax({
                     url: ruta_principal+'/admin/detalleportafolio/updateslick/'+item.id,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data : formData,
                             success: function (result) {
                                 if(result.success==true){
                                   var indice = vm.slicks.indexOf(item);
                                   vm.slicks[indice] = result.item;
                                   vm.dialogedit_imagen = false;
                                 }
                             }
                        });
              },
              editMultimedia: function(item){

                let vm = this;

                 var	imagen = document.getElementById('editImagen_multimedia');

                 var formData = new FormData();
                 if(imagen)
                 {
                   if (imagen.files.length > 0) {
                     formData.append('imagen_img', imagen.files[0]);
                   }
                 }
                 formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                 formData.append('titulo', $('#edittitulo_multimedia').val());
                 formData.append('descripcion', $('#editdescripcion_multimedia').val());
                 formData.append('video', $('#editvideo_multimedia').val());
                 $.ajax({
                     url: ruta_principal+'/admin/detalleportafolio/updatemultimedia/'+item.id,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data : formData,
                             success: function (result) {
                                 if(result.success==true){
                                   var indice = vm.multimedia.indexOf(item);
                                   vm.multimedia[indice] = result.item;
                                   vm.dialogedit_multimedia = false;
                                 }
                             }
                        });
              },
              showConfirmationBeneficio: function(item){
                this.beneficio_delete = item;
                this.dialogconfirmation_beneficio = true;
              },
              deleteBeneficio: function(item){
                let vm = this;
                var formData = {};
                this.dialogconfirmation_beneficio = false;
                formData._token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: ruta_principal+'/admin/detalleportafolio/deletebeneficio/'+item.id,
                   type: "POST",
                   data : formData,
                            success: function (result) {
                                if(result.success==true){
                                  vm.beneficios.splice(vm.beneficios.indexOf(item), 1);
                                }
                                else{
                                  $('#error_msg').text(result.msg);
                                  vm.dialogerror=true;
                                }
                            }
                       });
              },
              showConfirmationMultimedia: function(item){
                this.multimedia_delete = item;
                this.dialogconfirmation_multimedia = true;
              },
              deleteMultimedia: function(item){
                let vm = this;
                var formData = {};
                this.dialogconfirmation_multimedia = false;
                formData._token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: ruta_principal+'/admin/detalleportafolio/deletemultimedia/'+item.id,
                   type: "POST",
                   data : formData,
                            success: function (result) {
                                if(result.success==true){
                                  vm.multimedia.splice(vm.multimedia.indexOf(item), 1);
                                }
                                else{
                                  $('#error_msg').text(result.msg);
                                  vm.dialogerror=true;
                                }
                            }
                       });
              },
              showConfirmationSlick: function(item){
                this.slick_delete = item;
                this.dialogconfirmation_slick = true;
              },
              deleteSlick: function(item){
                let vm = this;
                var formData = {};
                this.dialogconfirmation_slick = false;
                formData._token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: ruta_principal+'/admin/detalleportafolio/deleteslick/'+item.id,
                   type: "POST",
                   data : formData,
                            success: function (result) {
                                if(result.success==true){
                                  vm.slicks.splice(vm.slicks.indexOf(item), 1);
                                }
                                else{
                                  $('#error_msg').text(result.msg);
                                  vm.dialogerror=true;
                                }
                            }
                       });
              },
              closeDialogError: function(){
                  this.dialogerror=false;
              },
              createEquipo: function(item){
                let vm = this;
                var imagen = document.getElementById('newImagenEquipo');
                var formData = new FormData();
                    if(imagen)
                    {
                      if (imagen.files.length > 0) {
                        formData.append('imagen_img', imagen.files[0]);
                      }
                    }
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('iddetalleportafolio', id_detalleportafolio);
                formData.append('nombre', $('#newnombre_equipo').val());
                formData.append('descripcion', $('#newdescripcion_equipo').val());

                $.ajax({
                  url: ruta_principal+'/admin/detalleportafolio/createequipo',
                  type: "POST",
                  processData: false,
                  contentType: false,
                  data : formData,
                            success: function (result) {
                                if(result.success==true){
                                  vm.equipo.push(result.item);
                                  vm.dialognew_equipo = false;
                                }
                            }
                       });
                },
                editEquipo: function(item){
                  let vm = this;
                  var imagen = document.getElementById('editImagenEquipo');
                  var formData = new FormData();
                      if(imagen)
                      {
                        if (imagen.files.length > 0) {
                          formData.append('imagen_img', imagen.files[0]);
                        }
                      }
                  formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                  formData.append('nombre', $('#editnombre_equipo').val());
                  formData.append('descripcion', $('#editdescripcion_equipo').val());

                  $.ajax({
                    url: ruta_principal+'/admin/detalleportafolio/updateequipo/'+item.id,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data : formData,
                              success: function (result) {
                                  if(result.success==true){
                                    var indice = vm.equipo.indexOf(item);
                                    vm.equipo[indice] = result.item;
                                    vm.dialogedit_equipo = false;
                                  }
                              }
                         });
                  },
                  showConfirmationEquipo: function(item){
                    this.equipo_delete = item;
                    this.dialogconfirmation_equipo = true;
                  },
                  deleteEquipo: function(item){
                    let vm = this;
                    var formData = {};
                    this.dialogconfirmation_equipo = false;
                    formData._token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: ruta_principal+'/admin/detalleportafolio/deleteequipo/'+item.id,
                       type: "POST",
                       data : formData,
                                success: function (result) {
                                    if(result.success==true){
                                      vm.equipo.splice(vm.equipo.indexOf(item), 1);
                                    }
                                    else{
                                      $('#error_msg').text(result.msg);
                                      vm.dialogerror=true;
                                    }
                                }
                           });
                  },
       },

});
