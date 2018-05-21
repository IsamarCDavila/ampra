<div class="main_slider">
  <div class="slider_include">
    <div v-for="value in slider">
        <div class="centrar_imgaen_background contenedor_slider" v-bind:style="{ 'background-image': 'url('+ url + '/' +value.imagen_path + ')' }"></div>
    </div>
  </div>
</div>
