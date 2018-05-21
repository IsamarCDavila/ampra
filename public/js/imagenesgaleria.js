Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-imagenesgaleria',
    data: {
    items: [],
    galeria: galeria,
    search: '',
    url: ruta_principal,
    imagen_update:{},
    imagen_delete:{},
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
    dialogedit:false,
    dialognew:false,
    dialogconfirmation:false,
    dialogerror:false,
    newtituloimagen:'',
    newItem : {'title':'','description':''},
    fillItem : {'title':'','description':'','id':''},

  },

  created : function(){
          this.getImagenesGaleria(this.pagination.current_page);
  },
  methods : {
        getImagenesGaleria: function(){
          let vm = this;
          vm.$http.get(ruta_principal+'/admin/getimagenesgaleria?page='+this.pagination.current_page+'&id_galeria='+this.galeria.id).then((response) => {
            vm.items = response.data.data;
            vm.pagination = response.data.pagination;
            vm.offset=4;
          });
        },
      changePage: function (page) {
          this.pagination.current_page = page;
          this.getImagenesGaleria(page);
      },
      showmodal: function(item){
        this.imagen_update = item;
        this.dialogedit = true;
      },
      showConfirmation: function(item){
        this.imagen_delete = item;
        this.dialogconfirmation = true;
      },
      nuevaImagen: function(){
        this.newtituloimagen = '';
        $('#img-crearimg').attr('src', '');
        this.dialognew = true;
      },
      createItem: function(item){

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
        formData.append('titulo', $('#newtituloimagen').val());
        formData.append('id_galeria', vm.galeria.id);
        $.ajax({
            url: ruta_principal+'/admin/galeria/createimagen',
           type: "POST",
           processData: false,
		   contentType: false,
           data : formData,
                    success: function (result) {
                        vm.dialognew = false;
                        if(result.success==true){
                          vm.items.push(result.item);

                        }
                        else{
                          $('#error_msg').text(result.msg);
                          vm.dialogerror=true;
                        }
                    }
               });
      },
      editItem: function(item){

        let vm = this;

         var	imagen = document.getElementById('editImagen');

         var formData = new FormData();
         if(imagen)
         {
           if (imagen.files.length > 0) {
             formData.append('imagen_img', imagen.files[0]);
           }
         }
         formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
         formData.append('titulo', $('#tituloimagen').val());
         $.ajax({
             url: ruta_principal+'/admin/galeria/updateimagen/'+item.id,
            type: "POST",
            processData: false,
            contentType: false,
            data : formData,
                     success: function (result) {
                         if(result.success==true){
                           var indice = vm.items.indexOf(item);
                           vm.items[indice] = result.item;
                           vm.dialogedit = false;
                         }
                     }
                });
      },
      deleteItem: function(item){
        let vm = this;
        var formData = {};
        this.dialogconfirmation = false;
        formData._token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: ruta_principal+'/admin/galeria/deleteimagen/'+item.id,
           type: "POST",
           data : formData,
                    success: function (result) {
                        if(result.success==true){
                          vm.items.splice(vm.items.indexOf(item), 1);
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
      onFileChange: function onFileChange(e) {
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
      }
  }
});
