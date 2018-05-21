Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');
new Vue({
    el: '#table-suscriptores',
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
  },
  created : function(){
          this.getSuscriptores(this.pagination.current_page);
  },
  methods : {
    getSuscriptores: function(){
      let vm = this;
      vm.$http.get(ruta_principal+'/admin/getsuscriptores?page='+this.pagination.current_page).then((response) => {
        vm.items = response.data.data;
        vm.pagination = response.data.pagination;
        vm.offset=4;
      });
    },
  },
});
