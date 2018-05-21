@extends('app.app')
@section('style')
@endsection
@section('script')
<script>
    var oficina = {!!$oficina!!};
    var banner_logo = {!!$banner_logo!!};
    var servicios = {!!$servicios!!};
</script>
<script src="<?php echo URL::asset('js/bladePortafoliolanding.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div class="nosotros" id="vistaportafolio">
    <v-app id="inspire">
    @include('front.includes.hero_detalle')
    @include('front.includes.galeria')
    @include('front.includes.list_product')
    </v-app>
</div>
@endsection
