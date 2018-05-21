new Vue({
    el: '#editarmultimedia',
    data: {
        multimedia: multimedia,
        id_detalleportafolio:id_detalleportafolio,
        url: ruta_principal,
        url_update: '/admin/detalleportafolio/updatemultimedia',
        image: '',
        imageName: '',
        imageUrl: '',
        imageFile: '',
  },
  created : function(){
  },
  methods : {
        submit: function submit() {
          $('#formMultimedia').submit();
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
        pickFile () {
            this.$refs.image.click ();
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
          this.imageFile = files[0]
          $('.hiddenImage').css('display','none');
        })
      } else {
        this.imageName = ''
        this.imageFile = ''
        this.imageUrl = ''
      }
      },
  },
});
