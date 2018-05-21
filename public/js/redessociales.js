Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-redessociales',
    data: {
    items: [],
    search: '',
    url: ruta_principal,
    red_update:{},
    red_delete:{},
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
    newrednombre: '',
    newredicono: '',
    newredurl: '',
    newItem : {'title':'','description':''},
    fillItem : {'title':'','description':'','id':''},

  },

  created : function(){
          this.getRedes(this.pagination.current_page);
  },
  methods : {
        getRedes: function(){
          let vm = this;
          vm.$http.get(ruta_principal+'/admin/getredessociales?page='+this.pagination.current_page).then((response) => {
            vm.items = response.data.data;
            vm.pagination = response.data.pagination;
            vm.offset=4;
          });
        },
      changePage: function (page) {
          this.pagination.current_page = page;
          this.getRedes(page);
      },
      showmodal: function(item){
        this.red_update = item;
        this.dialogedit = true;
      },
      showcrear: function(item){
        this.newredicono = '';
        this.newrednombre = '';
        this.newredurl = '';
        this.dialognew = true;
      },
      showConfirmation: function(item){
        this.red_delete = item;
        this.dialogconfirmation = true;
      },
      createItem: function(item){

        let vm = this;

        var formData = {};
        formData._token = $('meta[name="csrf-token"]').attr('content');
        formData.nombre = $('#newrednombre').val();
        formData.icono = $('#newredicono').val();
        formData.url = $('#newredurl').val();
        $.ajax({
            url: ruta_principal+'/admin/redessociales/createredsocial',
           type: "POST",
           data : formData,
                    success: function (result) {
                        if(result.success==true){
                          vm.items.push(result.item);
                          vm.dialognew = false;
                        }
                    }
               });
      },
      editItem: function(item){

        let vm = this;

        var formData = {};
        formData._token = $('meta[name="csrf-token"]').attr('content');
        formData.nombre = $('#nombrered').val();
        formData.icono = $('#iconored').val();
        formData.url = $('#urlred').val();
        $.ajax({
            url: ruta_principal+'/admin/redessociales/updateredsocial/'+item.id,
           type: "POST",
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
        this.dialogconfirmation = false;
        let vm = this;
        var formData = {};

        formData._token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: ruta_principal+'/admin/redessociales/deleteredsocial/'+item.id,
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
