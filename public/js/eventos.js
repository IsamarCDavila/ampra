Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-eventos',
    data: {
    items: [],
    search: '',
    url: ruta_principal,
    url_edit: ruta_principal+'/admin/eventos/editar',
    url_new: ruta_principal + '/admin/eventos/crear',
    evento_delete:{},
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
          this.getEventos(this.pagination.current_page);
  },
  methods : {
        getEventos: function(){
          let vm = this;
          vm.$http.get(ruta_principal+'/admin/geteventos?page='+this.pagination.current_page).then((response) => {
            vm.items = response.data.data;
            vm.pagination = response.data.pagination;
            vm.offset=4;
          });
        },
      changePage: function (page) {
          this.pagination.current_page = page;
          this.getEventos(page);
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
            url: ruta_principal+'/admin/eventos/deleteevento/'+item.id,
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
