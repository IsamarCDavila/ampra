new Vue({
    el: '#evento',
    titulo: '',
    data() {
      return {
        url: ruta_principal,
        evento: evento,
        otros_eventos: otros_eventos
      }
    },
    methods:{
      shareFacebook: function(item){
          	var title = item.titulo;
          	var description = item.descripcion;
          	var image = item.imagen;
            var link = item.link;

          	shareOverrideOGMeta(link,
          						title,
          						description,
          						image);

          	return false;
        }
    }
})


$('.slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,

});