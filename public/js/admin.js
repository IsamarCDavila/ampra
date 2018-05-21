// "use strict"
// $(window).load(function () {
//     $(".loader").delay(0.001).fadeOut("slow");
//     $("#overlayer").delay(0.001).fadeOut("slow");
// })
// Vue.use(VueMaterial.default)
// Vue.use(VeeValidate);
new Vue({
  el: '#appadmin',
  name: "ListExpansion",
  $_veeValidate: {
   validator: 'new'
 },
  data: () => ({
    select: null,
    drawer: null,
    image: '',
    image_:'',
    ruta_admin:ruta_admin,

    admins: [
        ['Lista Páginas', 'storage']
      ],
    portafolios: [
        ['Lista Portafolio', 'storage']
      ],
    contactos: [
        ['Lista Contacto', 'contact_phone']
      ],
    suscriptores: [
          ['Lista Suscriptores', 'notifications']
      ],
    comunidades: [
            ['Seccion eventos', 'event','/eventos'],
            ['Seccion galería', 'collections','/galeria']
    ],
    redes: [
            ['Listado Redes Sociales', 'group','/redessociales']
    ],
      cruds: [
        ['Create', 'add'],
        ['Read', 'insert_drive_file'],
        ['Update', 'update'],
        ['Delete', 'delete']
      ],
    items: [

              { title: 'Páginas', icon: 'pages',slug:'paginas', expand: 'md-expand',
              items_dos: [
                  { icon: 'storage', subtitle: 'Lista Páginas', slug: 'paginas'}
                ]
              },

              { title: 'Portafolio', icon: 'folder_open' , slug: 'portafolio',  expand: 'md-expand',
              items_dos: [
                  { icon: 'storage', subtitle: 'Lista Portafolio' ,slug: 'portafolio' }
                ]
              },
              { title: 'Comunidad', icon: 'dashboard', slug: 'comunidad', expand: 'md-expand',
              items_dos: [
                  { icon: 'event', subtitle: 'Sección Eventos  ' ,slug: 'eventos' },
                  { icon: 'collections', subtitle: 'Sección Galería   ' ,slug: 'galeria' }
                ]
            },

              { title: 'Contacto', icon: 'contact_phone', slug: 'contacto' , expand: ''},
              { title: 'Suscriptores', icon: 'notifications', slug: 'suscriptores' , expand: ''},
              { title: 'Redes Sociales', icon: 'group', slug: 'redessociales' , expand: ''},
            ],
            items_select: [
             'Item 1',
             'Item 2',
             'Item 3',
             'Item 4'
   ],
  }),

  methods:{
          abrir: function(event){
          window.location.href =ruta_principal+'/admin/'+event;
        },
          data:function() {
              return {
                expandNews: false
              }
            },
            onFileChange: function onFileChange(e) {
              var files = e.target.files || e.dataTransfer.files;
              if (!files.length) return;
              this.createImage(files[0]);
            },
            onFileChange_dos: function onFileChange_dos(e) {
              var files = e.target.files || e.dataTransfer.files;
              if (!files.length) return;
              this.createImage_dos(files[0]);
            },
            createImage: function createImage(file) {
              var image = new Image();
              var reader = new FileReader();
              var vm = this;

              reader.onload = function (e) {
                vm.image = e.target.result;
              };
              reader.readAsDataURL(file);
            },
            createImage_dos: function createImage_dos(file) {
              var image = new Image();
              var reader = new FileReader();
              var vm = this;
              reader.onload = function (e) {
                vm.image_ = e.target.result;
              };
              reader.readAsDataURL(file);
            },
            removeImage: function removeImage(e) {
              this.image = '';
            },
            removeImage_dos: function removeImage_dos(e) {
              this.image_ = '';
            },
            submit: function submit() {
              this.$validator.validateAll();
            },
            clear: function clear() {
              // this.name = '';
              // this.email = '';
              this.select = null;
              // this.checkbox = null;
              // this.$validator.reset();
            },
            mounted () {
              this.$validator.localize('es', this.dictionary)
            }
  }
});

new Vue({
  el: '#footer',
 }
);


// var example = {
//   name: "ListExpansion",
//
//   data: function data() {
//     return {
//       expandNews: false
//     }
//   }
// }
