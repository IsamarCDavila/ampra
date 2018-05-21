new Vue({
    el: '#galeria',
    titulo: '',
    data() {
        return {
            url: ruta_principal,
            dialog2: false,
            items: [
                {
                    src: 'https://vuetifyjs.com/static/doc-images/carousel/squirrel.jpg'
                },
                {
                    src: 'https://vuetifyjs.com/static/doc-images/carousel/sky.jpg'
                },
                {
                    src: 'https://vuetifyjs.com/static/doc-images/carousel/bird.jpg'
                },
                {
                    src: 'https://vuetifyjs.com/static/doc-images/carousel/planet.jpg'
                }
            ],
            galeria : galeria,
            mas_galerias: mas_galerias,
            imagenes_galeria: imagenes_galeria,
            actual_item: 4,
            carouselIndex:0
        }
    },
    methods: {
      showDialog: function(item){
        var index = this.imagenes_galeria.indexOf(item);
        this.carouselIndex = index;
        this.dialog2 = true;
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
