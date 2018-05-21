Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-items',
    data: {
    items: [],
    search: '',
    url: ruta_principal,
    item_update:{},
    item_delete:{},
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
    new_nombre_item:'',
    nombre_item:'',
    tipo: tipo,
    new_titulo_item:'',
    new_descripcion_item:''

  },

  created : function(){
          this.getItems(this.pagination.current_page);
  },
  methods : {
        getItems: function(){
          let vm = this;
          vm.$http.get(ruta_principal+'/admin/getitems?page='+this.pagination.current_page+'&tipo='+this.tipo).then((response) => {
            vm.items = response.data.data;
            vm.pagination = response.data.pagination;
            vm.offset=4;
          });
        },
      changePage: function (page) {
          this.pagination.current_page = page;
          this.getItems(page);
      },
      showmodal: function(item){
        $('#tituloedit').val('');
        $('#descripcionedit').val('');
        this.item_update = item;
        this.dialogedit = true;

      },
      showConfirmation: function(item){
        this.item_delete = item;
        this.dialogconfirmation = true;
      },
      showcrear: function(item){
            $('#img-crearimg').attr('src', '');
            this.new_titulo_item = '';
            this.new_descripcion_item = '';
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
        formData.append('titulo', this.new_titulo_item);
        formData.append('descripcion', this.new_descripcion_item);
        formData.append('tipo', this.tipo);
        $.ajax({
            url: ruta_principal+'/admin/items/store',
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
         formData.append('titulo', $('#tituloedit').val());
         formData.append('descripcion', $('#descripcionedit').val());
         $.ajax({
             url: ruta_principal+'/admin/items/update/'+item.id,
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
            url: ruta_principal+'/admin/items/delete/'+item.id,
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
