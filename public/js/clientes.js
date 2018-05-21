Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-clientes',
    data: {
    items: [],
    search: '',
    url: ruta_principal,
    cliente_update:{},
    cliente_delete:{},
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
    newItem : {'title':'','description':''},
    fillItem : {'title':'','description':'','id':''},
    new_nombre_cliente:'',
    nombre_cliente:''

  },

  created : function(){
          this.getClientes(this.pagination.current_page);
  },
  methods : {
        getClientes: function(){
          let vm = this;
          vm.$http.get(ruta_principal+'/admin/getclientes?page='+this.pagination.current_page).then((response) => {
            vm.items = response.data.data;
            vm.pagination = response.data.pagination;
            vm.offset=4;
          });
        },
      changePage: function (page) {
          this.pagination.current_page = page;
          this.getClientes(page);
      },
      showmodal: function(item){
        this.cliente_update = item;
        this.dialogedit = true;
      },
      showConfirmation: function(item){
        this.cliente_delete = item;
        this.dialogconfirmation = true;
      },
      showcrear: function(item){
            this.new_nombre_cliente = '';
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
        formData.append('nombre', this.new_nombre_cliente);
        $.ajax({
            url: ruta_principal+'/admin/clientes/store',
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
         formData.append('nombre', this.cliente_update.nombre);
         $.ajax({
             url: ruta_principal+'/admin/clientes/update/'+item.id,
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
            url: ruta_principal+'/admin/clientes/delete/'+item.id,
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
