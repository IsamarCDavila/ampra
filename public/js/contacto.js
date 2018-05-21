Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-contacto',
    data: {
      items: [],
      pagination: {
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1
        },
      url: ruta_principal,
      url_new: ruta_principal + '/admin/contacto/contactoviewnew',
      url_edit: ruta_principal + '/admin/contacto/contactoviewedit',
  },
  created : function(){
          this.getContacto(this.pagination.current_page);
  },
  methods : {
    getContacto: function(){
      let vm = this;
      vm.$http.get(ruta_principal+'/admin/getcontacto?page='+this.pagination.current_page).then((response) => {
        vm.items = response.data.data;
        vm.pagination = response.data.pagination;
        vm.offset=4;
      });
    },
  },
});
