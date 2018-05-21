Vue.component('dialog-error', {
  template: `<v-dialog v-model="showdialog" max-width="500px">
    <v-card>
      <v-card-title>
        Error
      </v-card-title>
      <v-card-text id="error_msg">

      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" flat @click.stop="showdialog=false">OK</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>`,
  props: ['dialogerror', 'closedialogerror'],
  computed: {
    showdialog: {
      get () {
        return this.dialogerror
      },
      set (value) {
        if (!value) {
          this.$emit('closedialogerror')
        }
      }
    }
  }
});

// Vue.component('redes-item', {
//   template: '\
//     <v-list-tile-title>\
//       <button @click.stop="$emit(\'remove\')"><v-icon class="remove-email-icon" color="red">remove_circle</v-icon></button>\{{ url }}\
//     </v-list-tile-title>\
//   ',
//   props: ['url']
// });
//
// Vue.component('horario-item', {
//   template: '\
//     <v-list-tile-title>\
//       <button @click.stop="$emit(\'remove\')"><v-icon class="remove-horario-icon" color="red">remove_circle</v-icon></button>\{{ tipo }}, {{horarios}}\
//     </v-list-tile-title>\
//   ',
//   props: ['tipo', 'horarios']
// });
