@extends('app.app')
@section('style')
@endsection
@section('script')
<script>
    console.log("oficina",{!!$oficina!!});
    var banner = {!!$banner!!};
    var oficina = {!!$oficina!!};
    var slider = {!!$slider!!};
    var banner_logo = {!!$banner_logo!!};
    var servicios = {!!$servicios!!};
</script>
<script src="<?php echo URL::asset('js/bladeHome.js'); ?>"></script>
@endsection
<!-- /.heading-->

@section('content')
<div class="nosotros" id="home">
    <v-app id="inspire">
    @include('front.includes.hero_detalle')
    @include('front.includes.galeria')
    @include('front.includes.list_product')
    @include('front.includes.slider')
    @include('front.includes.banner')
    </v-app>
</div>
@endsection
