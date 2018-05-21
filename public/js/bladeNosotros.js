new Vue({
    el: '#nosotros',
    titulo:'',
    data() {
        return {
            url: ruta_principal,
            json_banner: banner,
            dialog2: false,
            oficina: oficina,
            clientes: clientes,
            servicios: servicios,
            slider: slider,
            certificaciones: certificaciones,
            titulo: seccion_alquiler.titulo,
            descripcion_corta: seccion_alquiler.introduccion,
            descripcion_larga: seccion_alquiler.descripcion,
            seccion_certificados: seccion_certificados,
            total_errors:0,
            datosformulario:{ nombre: null, apellido:null, empresa:null, email:null, telefono:null, mensaje:null},
            errors:{ nombre: ' ', apellido:' ', empresa:' ', email:' ', telefono:' ', mensaje:' '}
        }
    },
    methods:{
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
      },
      validEmail:function(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      },
    }

})
