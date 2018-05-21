if($('#table-paginas').length>0)
{
  new Vue({
      el: '#table-paginas',
      data: {
      items: [],
      search: '',
      url: ruta_principal,
      url_edit: ruta_principal + '/admin/paginas/edit/',
      url_getbanner: ruta_principal + '/admin/paginas/',
      url_banner:'/banner',
      pagination: {
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1
        },
      offset: 4,
      formErrors:{},
      formErrorsUpdate:{},
      newItem : {'title':'','description':''},
      fillItem : {'title':'','description':'','id':''}
    },

    created : function(){
            this.getPaginas(this.pagination.current_page);
    },
    methods : {
          getPaginas: function(){
            let vm = this;
            vm.$http.get(ruta_principal+'/admin/getpaginas?page='+this.pagination.current_page).then((response) => {
              console.log(response);
              // this.$set('items', response.data.data);
              vm.items = response.data.data;
              vm.pagination = response.data.pagination;
              // this.$set('pagination', response.data.pagination);
            });
          },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getPaginas(page);
        }
    }
  });
}
if($('#editarpagina').length>0)
{
  let editarpagina= new Vue({
      el: '#editarpagina',

      data: {
          pagina: {},
          url: ruta_principal,
          url_update: ruta_principal+'/admin/paginas/update/',
          image: '',
          image_:'',
          imageName: '',
          imageName_: '',
          imageUrl: '',
          imageUrl_: '',
          imageFile: '',
          imageFile_: '',
      },
      created() {
          this.getPagina();
      },
      methods: {

          getPagina() {
              var self = this;
              this.pagina = pagina;
              this.image = pagina.imagen
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
              this.$refs.image_.click ();
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
          this.imageName_ = files[0].name
          if(this.imageName_.lastIndexOf('.') <= 0) {
            return
          }
          const fr = new FileReader ()
          fr.readAsDataURL(files[0])
          fr.addEventListener('load', () => {
            this.imageUrl_ = fr.result
            this.imageFile_ = files[0] // this is an image file that can be sent to server...
            $('.hiddenIcono').css('display','none');
          })
        } else {
          this.imageName_ = ''
          this.imageFile_ = ''
          this.imageUrl_ = ''
        }
      },
          submit: function submit() {
            // this.$validator.validateAll();
            console.log('entro');

            $('#formu').submit();
            // $.post(this.url_update+this.pagina.id,this.pagina,function(response){
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
      }
  })
}
// new Vue({
//     el: '#editarpagina',
// })
