@isset($hero)
<div class="seccion_hero background_image">
    <div id="hero">
        <div class="contenedor_hero">
            <div class="container_1">
                <h1>@{{hero.title}}</h1>
                <div class="descripcion_hero">
                    <p>@{{hero.descripcion}}</p>
                </div>
                @if ($pagina == 'comunidad' )
                    <div>
                        <a href="#mapa_ancla" class ="mapa_ancla" data-ancla="mapa_ancla">
                            <span class="btn_mapa">@{{hero.button}}</span>
                            <span class="flecha_mapa"><v-icon>arrow_downward</v-icon></span>
                        </a>

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endisset
