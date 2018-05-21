if($('#newevento').length>0)
{
  new Vue({
      el: '#newevento',
      data () {
          return {
            url_store: ruta_principal+'/admin/eventos/store',
            fecha:'',
            portafolios: portafolios,
            image: '',
            imageName: '',
            imageUrl: '',
            imageFile: '',
            date: null,
             menu: false,
             modal: false,
             menu2: false,
            time:null,
            menu_date:false,
            estado: 0,
             menu_: false,
            detalle_portafolio_id:'',
            time: null,
            time_dos: null,
            estados: [
              { text: 'Activo', value: 0 },
              { text: 'Inactivo', value:1 }
            ]
          }
        },
    methods:{
          submit: function submit() {
            $('#formnewEvento').submit();
          },
          clear: function clear() {
            this.estado = '';
            this.duracion = '';
            this.genero = '';
            this.publico = '';
          },
          pickFile () {
              this.$refs.image.click ();
          },
          onFilePicked (e) {
            const files = e.target.files
            if(files[0] !== undefined) {
              this.imageName = files[0].name
              if(this.imageName.lastIndexOf('.') <= 0) {
                return
              }
              const fr = new FileReader ()
              fr.readAsDataURL(files[0])
              fr.addEventListener('load', () => {
                this.imageUrl = fr.result
                this.imageFile = files[0] // this is an image file that can be sent to server...
                $('.hiddenImage').css('display','none');
              })
            } else {
              this.imageName = ''
              this.imageFile = ''
              this.imageUrl = ''
            }
          },
        }
  });
}
if($('#editevento').length>0)
{
  new Vue({
      el: '#editevento',
      data () {
          return {
            url: ruta_principal,
            url_update: ruta_principal+'/admin/eventos/update',
            image: '',
            imageName: '',
            imageUrl: '',
            imageFile: '',
            date: null,
             menu: false,
             modal: false,
             menu2: false,
            time:null,
            menu_date:false,
            estado: 0,
             menu_: false,
            time: null,
            time_dos: null,
            fecha: '',
            portafolios: portafolios,
            detalle_portafolio_id: '',
            evento: evento,
            estados: [
              { text: 'Activo', value: 0 },
              { text: 'Inactivo', value:1 }
            ]
          }
        },
    created: function(){
      this.getData();
    },
    methods:{
          getData: function(){
            this.date = evento.fecha;
            this.time = evento.hora_inicial;
            this.time_dos = evento.hora_final;
            this.detalle_portafolio_id = evento.detalle_portafolio_id;
            this.estado = evento.estado;
          },
          submit: function submit() {
            $('#formeditEvento').submit();
          },
          clear: function clear() {
            this.estado = '';
            this.duracion = '';
            this.genero = '';
            this.publico = '';
          },
          pickFile () {
              this.$refs.image.click ();
          },
          onFilePicked (e) {
            const files = e.target.files
            if(files[0] !== undefined) {
              this.imageName = files[0].name
              if(this.imageName.lastIndexOf('.') <= 0) {
                return
              }
              const fr = new FileReader ()
              fr.readAsDataURL(files[0])
              fr.addEventListener('load', () => {
                this.imageUrl = fr.result
                this.imageFile = files[0] // this is an image file that can be sent to server...
                $('.hiddenImage').css('display','none');
              })
            } else {
              this.imageName = ''
              this.imageFile = ''
              this.imageUrl = ''
            }
          },
        }
  });
}
