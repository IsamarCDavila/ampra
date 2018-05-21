if($('#table-banners').length>0)
{
  new Vue({
      el: '#table-banners',
      data: {
            items: [],
            search: '',
            id_pagina: id_pagina,
            url: ruta_principal,
            url_edit: ruta_principal + '/admin/paginas/',
            url_banneredit: '/banner/edit/',
            url_getbanner: ruta_principal + '/admin/paginas/banner/',
            pagination: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
              },
            offset: 4,
            formErrors:{},
            formErrorsUpdate:{}

    },

    created : function(){
            this.getBanners(this.pagination.current_page);
    },
    methods : {
          getBanners: function(){
            let vm = this;
            vm.$http.get(ruta_principal+'/admin/getbanners?page='+this.pagination.current_page+'&id='+this.id_pagina).then((response) => {
              console.log(response);
              // this.$set('items', response.data.data);
              vm.items = response.data.data;
              vm.pagination = response.data.pagination;
              // this.$set('pagination', response.data.pagination);
            });
          },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getBanners(page);
        }
    }
  });
}
if($('#editarbanner').length>0)
{

  let editarbanner= new Vue({
      el: '#editarbanner',

      data: {
          banner: {},
          url: ruta_principal,
          id_pagina: id_pagina,
          url_update: ruta_principal+'/admin/banners/update/',
          image: '',
          image_:'',
          imageName: '',
          imageName_: '',
          imageUrl: '',
          imageUrl_: '',
          imageFile: '',
          imageFile_: '',
          documentName_:'',
          archivo_:'',
          dialogconfirmation_archivo:false,
          dialogerror:false

      },
      created() {
          this.getPagina();
      },
      methods: {

          getPagina() {
              var self = this;
              this.banner = banner;
              this.image = banner.imagen;
              if(banner.tipo_button==1){
                this.documentName_ = banner.link;
              }

          },
          onFileChange: function onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
            console.log('file change');
          },
          onFileChange_dos: function onFileChange_dos(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage_dos(files[0]);
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
          createImage_dos: function createImage_dos(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;
            reader.onload = function (e) {
              vm.image_ = e.target.result;
            };
            reader.readAsDataURL(file);
          },
          removeImage: function removeImage(e) {
            this.image = '';
          },
          removeImage_dos: function removeImage_dos(e) {
            this.image_ = '';
          },
          pickFile () {
              this.$refs.image.click ();
          },
          pickFile_ () {
              this.$refs.archivo_.click ();
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
      onFilePicked_ (e) {
        const files = e.target.files
        if(files[0] !== undefined) {
          this.documentName_ = files[0].name
          if(this.documentName_.lastIndexOf('.') <= 0) {
            return
          }
          const fr = new FileReader ()
          fr.readAsDataURL(files[0])
          fr.addEventListener('load', () => {
            this.archivo_ = files[0]
          })

        } else {
          this.documentName_ = ''
        }
      },
          submit: function submit() {
            // this.$validator.validateAll();
            console.log('entro');

            $('#formu').submit();
            // $.post(this.url_update+this.banner.id,this.pagina,function(response){
            //             console.log(response);
            //                });
          },
          clear: function clear() {
            // this.name = '';
            // this.email = '';
            this.select = null;
            // this.checkbox = null;
            // this.$validator.reset();
          },
          quitarArchivo: function(){
            let vm = this;
            var formData = {};
            this.dialogconfirmation_archivo = false;
            formData._token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: ruta_principal+'/admin/banners/removearchivo/'+vm.banner.id,
               type: "POST",
               data : formData,
                        success: function (result) {
                            if(result.success==true){
                              vm.banner.link = '';
                              vm.documentName_ = '';
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
      }
  })
}
// new Vue({
//     el: '#editarbanner',
// })
