var header = new Vue({
    el: '#header',
    data() {
        return {
            drawer: null,
            portafolio: [],
            comunidad: [
                ['EVENTOS'],
                ['GALERÍA'],
            ],
            icons: ['fab fa-facebook', 'fab fa-twitter', 'fab fa-google-plus', 'fab fa-linkedin', 'fab fa-instagram'],
            redes:[],
            pagina: pagina,

            email:null,
            errors:[],
            error_mail:'',
            error_mail:'',
            error_nombre:'',
            error_apellido:'',
            error_empresa:'',
            error_telefono:'',
            error_mensaje:'',
            error_distrito:'',
            error_metros:'',
            url_sendSuscribete: ruta_principal+'/sendEmail',
            url: ruta_principal,
        }
    },
    created(){
        this.drawer = true;
        this.getMenuPortafolio();
    },
    methods: {
        getMenuPortafolio: function(event){
          let vm = this;
          vm.$http.get(ruta_principal+'/getmenuportafolio').then((response) => {
            vm.portafolio = response.data.menu;
            vm.redes = response.data.redes_sociales;
          });
        },
        cerrar: function(event){
            $(".btn_hamburguesa").click();
        },
        vista: function(event){
            var href = window.location.href;

            if (event == 'EVENTOS') {
                this.drawer=false;
                if (href.indexOf("comunidad") > -1){
                    $('body,html').stop(true, true).animate({
                        scrollTop: $('#eventos').offset().top
                    }, 1000);
                }else{
                    window.location.href = ruta_principal + '/comunidad#eventos';
                }

            }
            if (event == 'GALERÍA') {
                console.log("gaeriaaaa", this.drawer);
                this.drawer = false;
                if (href.indexOf("comunidad") > -1) {
                    $('body,html').stop(true, true).animate({
                        scrollTop: $('#galeria').offset().top
                    }, 1000);
                } else {
                    window.location.href = ruta_principal + '/comunidad#galeria';
                }
            }

            if(event.id!==undefined){
              window.location.href = ruta_principal+'/portafolio/'+event.id+'/'+event.slug;
            }



        },
        eliminar: function(){
            $(".franja_suscribir").css("display","none");
        },
        gracias: function () {
            window.location.href = ruta_principal + '/mensaje-datos';
        },
        hrefPortafolio: function(){
            window.location.href = ruta_principal + '/portafolio';

        },
        checkForm:function(e) {
          this.errors = [];
          if(!this.email) {
            this.errors.push("El campo email es requerido.");
          } else if(!this.validEmail(this.email)) {
            this.errors.push("Ingrese un email válido.");
          }
          if(!this.errors.length) return true;
          e.preventDefault();
        },
        validEmail:function(email) {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return re.test(email);
        },
        submit: function submit() {
            $('#formsendEmail').submit();
        },
    }
})
var footer = new Vue({
    el: '#footer',
    data() {
        return {
            url: ruta_principal,
            contacto:{},
            errors:[],
            error_distrito:'',
            error_mail:'',
            error_nombre:'',
            error_apellido:'',
            error_empresa:'',
            error_telefono:'',
            error_mensaje:'',
            error_distrito:'',
            error_metros:'',
            url_sendContacto: ruta_principal+'/sendContacto',
            rows: [
                {
                    title: 'ABOUT US',
                    children: [
                        {
                            descripcion: 'Here you can use rows and columns here to organize your footer content.',
                            icon: '',
                            class: ''
                        },
                        {
                            descripcion: '',
                            icon: 'fa fa-facebook-f'
                        },
                        {
                            descripcion: '',
                            icon: 'fa fa-youtube-square',
                            class: ''
                        },
                        {
                            descripcion: '',
                            icon: 'fa fa-twitter',
                            class: ''
                        }
                    ],
                },
                {
                    title: 'CONTACT US',
                    children: [
                        {
                            descripcion: 'Arequipa, Paucarpata',
                            icon: 'place',
                            class: ''
                        },
                        {
                            descripcion: '999722195',
                            icon: 'local_phone',
                            class: ''
                        }
                    ],
                },
                {
                    title: 'NAVIGATION',
                    children: [
                        {
                            descripcion: 'Portafolio',
                            href: 'portafolio',
                            icon: '',
                            class: ''
                        },
                        {
                            descripcion: 'Comunidad',
                            href: 'comunidad',
                            icon: '',
                            class: ''
                        },
                        {
                            descripcion: 'Nosotros',
                            href: 'nosotros',
                            icon: '',
                            class: ''
                        },
                        {
                            descripcion: 'INGRESAR A INTRANET',
                            icon: '',
                            class: 'btn'
                        }
                    ],
                }
            ],
            valid: true,
            nombre: '',
            apellido: '',
            telefono: '',
            empresa: '',
            mensaje: '',
            metros: '',
            metros_: '',
            distrito: '',
            email: '',

            select: null,
            items: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4'
            ]
        }
    },
    methods: {
        checkForm:function(e) {
          this.errors = [];
          this.error_mail='';
          this.error_nombre='';
          this.error_apellido='';
          this.error_empresa='';
          this.error_telefono='';
          this.error_mensaje='';
          this.error_distrito='';
          this.error_metros='';
          $('#nombre').parent().parent().find('.input-group__details').find('.error--text').remove();
          $('#apellido').parent().parent().find('.input-group__details').find('.error--text').remove();
          $('#telefono').parent().parent().find('.input-group__details').find('.error--text').remove();
          $('#mensaje').parent().parent().find('.input-group__details').find('.error--text').remove();
          $('#empresa').parent().parent().find('.input-group__details').find('.error--text').remove();
          $('#email').parent().parent().find('.input-group__details').find('.error--text').remove();
          // $('#distrito').parent().parent().find('.input-group__details').find('.error--text').remove();
          // $('#metros').parent().parent().find('.input-group__details').find('.error--text').remove();


          if(!this.email) {
            this.errors.push("El campo email es requerido.");
            this.error_mail="El campo email es requerido.";
            $('#email').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_mail+'</div>');
            $('#email').parent().parent().find('.input-group__details').addClass('error--text');

          } else if(!this.validEmail(this.email)) {
            this.errors.push("Ingrese un email válido.");
            this.error_mail="Ingrese un email válido.";
            $('#email').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_mail+'</div>');
            $('#email').parent().parent().find('.input-group__details').addClass('error--text');

          }
          if(!this.nombre) {
            this.errors.push("El campo nombre es requerido.");
            this.error_nombre="El campo nombre es requerido.";

            $('#nombre').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_nombre+'</div>');
            $('#nombre').parent().parent().find('.input-group__details').addClass('error--text');
          }
          if(!this.apellido) {
            this.errors.push("El campo apellido es requerido.");
            this.error_apellido="El campo apellido es requerido.";
            $('#apellido').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_apellido+'</div>');
            $('#apellido').parent().parent().find('.input-group__details').addClass('error--text');
          }
          if(!this.empresa) {
            this.errors.push("El campo empresa es requerido.");
            this.error_empresa="El campo empresa es requerido.";
            $('#empresa').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_empresa+'</div>');
            $('#empresa').parent().parent().find('.input-group__details').addClass('error--text');
          }
          if(!this.telefono) {
            this.errors.push("El campo telefono es requerido.");
            this.error_telefono="El campo telefono es requerido.";
            $('#telefono').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_telefono+'</div>');
            $('#telefono').parent().parent().find('.input-group__details').addClass('error--text');
          }
          if(!this.mensaje) {
            this.errors.push("El campo mensaje es requerido.");
            this.error_mensaje="El campo mensaje es requerido.";
            $('#mensaje').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_mensaje+'</div>');
            $('#mensaje').parent().parent().find('.input-group__details').addClass('error--text');
          }
          // if(!this.distrito) {
          //   this.errors.push("El campo distrito es requerido.");
          //   this.error_distrito="El campo distrito es requerido.";
          //   $('#distrito').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_distrito+'</div>');
          //   $('#distrito').parent().parent().find('.input-group__details').addClass('error--text');
          // }
          // if(!this.metros_) {
          //   this.errors.push("El campo metros es requerido.");
          //   this.error_metros="El campo metros es requerido.";
          //   $('#metros').parent().parent().find('.input-group__details').after().append(' <div class="input-group__messages input-group__error error--text ">'+this.error_metros+'</div>');
          //   $('#metros').parent().parent().find('.input-group__details').addClass('error--text');
          // }

          if(!this.errors.length) return true;
          e.preventDefault();
        },
        validEmail:function(email) {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return re.test(email);
        },
        submit: function submit() {

            $('#formContacto').submit();
        },

        href: function(event){
            console.log("holaaa",event);
            if (event == "portafolio" || event == "comunidad" || event == "nosotros"){
                window.location.href = ruta_principal +'/'+event;
            }

        },
        gracias: function(){
            window.location.href = ruta_principal + '/mensaje-datos';
        }
    }

})

console.log("main",hero);
var hero = new Vue({
    el: '#hero_contenedor',
    data() {
        return {
            hero: hero,
        }
    }

})
var imagen_hero = hero.hero['imagen'];
// $("#hero_contenedor").find('.seccion_hero').css("background", 'red');
$("#hero_contenedor").find('.seccion_hero').css("background-image", 'url(' + imagen_hero + ')');

// SLIDER
$slick_novedades = $('.slick-carousel');
settings = {
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    responsive: [
        {
            breakpoint: 2000,
            settings: {
                infinite: true,
            },
        },
        {
            breakpoint: 1080,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            },
        },
    ],
};
$slick_novedades.slick(settings);
// FIN SLIDER

$(document).ready(function(){
    var href = window.location.href;
    console.log("windowssssssss", href);
    console.log(
        href.indexOf("mensaje-datos") > -1
    );
    if (href.indexOf("mensaje-datos") > -1 || href.indexOf("mensaje-brochure") > -1 || href.indexOf("comunidad") > -1 || href.indexOf("portafolio") > -1 || href.indexOf("evento") > -1 || href.indexOf("galeria") > -1){
        $(".mapa_footer").css("display","none");
        $("#footer").find(".application--wrap").css("min-height","0vh");
        $("#footer").css("margin-top","0%");
        $(".mensaje_carga").find(".application--wrap").css("min-height","65vh");
        $(".mensaje_carga").find(".seccion_hero").css("height", "100%");
    }
    if (href.indexOf("galeria") > -1) {
        $("#footer").css("margin-top","5%");
    }
    console.log("paginaaaaaa",pagina);
    if (pagina == "portafoliodetalle") {
        $(".formulario_inicial").css("display", "block");
        // $(".formulario_inicial").css("display", "none");
        $("#hero").find("h1").css("width", "60%");
        $("#hero").find("h1").css("margin", "0 auto");
        $("#hero").find("h1").css("font-size", "50px");
    }

    // if (href.indexOf("portafolio") > -1){
    //     console.log("dfjdsg", header);
    //     // $(".formulario_portafolio").css("display","none");
    //     // $(".formulario_inicial").css("display", "none");
    // }

    if (href.indexOf("comunidad") > -1) {
        $(".contenedor_hero").css("text-align", "center");
        $(".descripcion_hero").css("margin","0 auto");
        $("#hero").find("h1").css("text-align", "center");
        $(".descripcion_hero").find("p").css("text-align", "center");
        // var oficina = ruta_principal +'/portafoliodetalle';
        // $(".btn_banner").parent().attr('href', oficina);
    }

    if (href.indexOf("nosotros") > -1) {
        $("#hero").find("h1").css("width", "75%");
    }

    $(window).load(function () {
        $(".loader").delay(0.001).fadeOut("slow");
        $("#overlayer").delay(0.001).fadeOut("slow");
    })








    $('.mapa_ancla').click(function (e) {
        e.preventDefault();		//evitar el eventos del enlace normal
        var strAncla = $(this).attr('href');
        console.log("ancla",strAncla); //id del ancla
        $('body,html').stop(true, true).animate({
            scrollTop: $(strAncla).offset().top
        }, 1000);

    });

    $('.ancla_contactanos').click(function (e) {
        console.log("click");
        e.preventDefault();		//evitar el eventos del enlace normal
        var strAncla = $(this).attr('href'); //id del ancla
        $('body,html').stop(true, true).animate({
            scrollTop: $(strAncla).offset().top
        }, 1000);

    });




    $('.oficina_slider').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });


});

$('.slider_include').slick({
    dots: true,
    // infinite: true,
    centerPadding: '100px',
    speed: 300,
    slidesToShow: 3,
    centerMode: true,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ]
});
$( document ).ready(function() {
    $("#btn-portafolio .list__group__header" ).mouseover(
         function(){
              $(this).parent().parent().find('#itemportafolio').parent().css('background','#AA1731');
         }

    );
    $("#btn-portafolio .list__group__header" ).mouseleave(
         function(){
              $(this).parent().parent().find('#itemportafolio').parent().css('background','transparent');
         }

    );
    $("#itemcomunidad").find('.list__group__header').find('.icon').mouseover(
         function(){
             console.log('gdfgdfgd');
              // $(this).parent().parent().find('#itemportafolio').parent().css('background','transparent');
              //
              // console.log( $(this).parent().html());
         }

    );

    $(".list__group__header").click(function(){
        if($(this).parent().hasClass("portafolio_btn")){
            if ($(".header_comunidad").find(".list__group__header").hasClass("list__group__header--active")){
                $(".header_comunidad").find(".list__group__header").click();
            }
        }else{
            if ($(".portafolio_btn").find(".list__group__header").hasClass("list__group__header--active")){
                $(".portafolio_btn").find(".list__group__header").click();
            }
        }
    });
});
