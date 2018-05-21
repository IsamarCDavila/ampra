new Vue({
    el: '#comunidad',
    titulo: '',
    data() {

        return {
            url: ruta_principal,
            json_banner: banner,
            url_sendSuscribete:'',
            email:null,
            errors2:[],
            url_sendSuscribete: ruta_principal+'/sendEmail',
            galeria: galeria,
            eventos: eventos,
            total_errors:0,
            datosformulario:{ nombre: null, apellido:null, empresa:null, email:null, telefono:null, mensaje:null},
            errors:{ nombre: ' ', apellido:' ', empresa:' ', email:' ', telefono:' ', mensaje:' '},
            dialog2:false
        }
    },
    methods:{
        checkForm:function(e) {
          this.errors2 = [];
          if(!this.email) {
            this.errors2.push("El campo email es requerido.");
          } else if(!this.validEmail(this.email)) {
            this.errors2.push("Ingrese un email válido.");
          }
          if(!this.errors2.length) return true;
          e.preventDefault();
        },
        validEmail:function(email) {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return re.test(email);
        },
        submit: function submit() {
            $('#formsendEmail').submit();
        },
        checkFormDowload:function(e) {
          e.preventDefault();
          this.total_errors = 0;
          this.errors.nombre  = ' ';
          this.errors.apellido  = ' ';
          this.errors.empresa  = ' ';
          this.errors.email  = ' ';
          this.errors.telefono  = ' ';
          this.errors.mensaje  = ' ';

          if(!this.datosformulario.nombre || (this.datosformulario.nombre.trim()!='' && !this.datosformulario.nombre)){
            this.errors.nombre = "El nombre es requerido.";
            this.total_errors = this.total_errors +1;
          }
          if(!this.datosformulario.apellido || (this.datosformulario.apellido.trim()!='' && !this.datosformulario.apellido)){
            this.errors.apellido = "El apellido es requerido.";
            this.total_errors = this.total_errors +1;
          }
          if(!this.datosformulario.empresa || (this.datosformulario.empresa.trim()!='' && !this.datosformulario.empresa)){
            this.errors.empresa = "El empresa es requerido.";
            this.total_errors = this.total_errors +1;
          }
          if(!this.datosformulario.mensaje || (this.datosformulario.mensaje.trim()!='' && !this.datosformulario.mensaje)){
            this.errors.mensaje = "El mensaje es requerido.";
            this.total_errors = this.total_errors +1;
          }
          if(!this.datosformulario.telefono || (this.datosformulario.telefono.trim()!='' && !this.datosformulario.telefono)){
            this.errors.telefono = "El teléfono es requerido.";
            this.total_errors = this.total_errors +1;
          }
          if(!this.datosformulario.email || (this.datosformulario.email.trim()!='' && !this.datosformulario.email)) {
            this.errors.email ="El Email es requerido.";
            this.total_errors = this.total_errors +1;
          } else if(!this.validEmail(this.datosformulario.email)) {
            this.errors.email ="El Email debe ser válido.";
            this.total_errors = this.total_errors +1;
          }
          if(this.total_errors==0){
            $('#formDownloadFile').submit();
          }
        }
    }
})


$('.slider-single').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    asNavFor: '.slider-single',
    dots: true,
    centerMode: true,
    focusOnSelect: true
});




$('.slick_galeria_comunidad').slick({
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
