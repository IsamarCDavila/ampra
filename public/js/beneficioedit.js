
new Vue({
    el: '#editarbeneficio',
    data: {
      beneficio: beneficio,
      id_detalleportafolio:id_detalleportafolio,
      url: ruta_principal,
      url_update: '',
  },
  created : function(){
          // this.getBeneficio();
  },
  methods : {
    submit: function submit() {
          $('#formBeneficio').submit();

        },
  },
});
