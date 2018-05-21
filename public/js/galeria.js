Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-galeria',
    data: {
    items: [],
    search: '',
    url: ruta_principal,
    url_edit: ruta_principal+'/admin/galeria/editar',
    url_new: ruta_principal + '/admin/galeria/crear',
    galeria_delete:{},
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
    dialogerror:false,
    dialogconfirmation:false,
    newItem : {'title':'','description':''},
    fillItem : {'title':'','description':'','id':''},

  },

  created : function(){
          this.getGaleria(this.pagination.current_page);
  },
  methods : {
        getGaleria: function(){
          let vm = this;
          vm.$http.get(ruta_principal+'/admin/getgalerias?page='+this.pagination.current_page).then((response) => {
            vm.items = response.data.data;
            vm.pagination = response.data.pagination;
            vm.offset=4;
          });
        },
      changePage: function (page) {
          this.pagination.current_page = page;
          this.getGaleria(page);
      },
      showConfirmation: function(item){
        this.evento_delete = item;
        this.dialogconfirmation = true;
        this.dialogerror=false;
      },
      deleteItem: function(item){
        let vm = this;
        var formData = {};
        this.dialogconfirmation = false;
        formData._token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: ruta_principal+'/admin/galeria/deletegaleria/'+item.id,
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
      }
  }
});
