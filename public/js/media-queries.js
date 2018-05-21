var mq767 = window.matchMedia('(max-width:767px)');

$(document).ready(function () {
    mediaQueries();
    $(window).resize(function () {
        mediaQueries();
    });
});

function mediaQueries() {
    var href = window.location.href;
    if (mq767.matches) {
        var intranet = $(".footer").find(".intranet_responsive").clone().html();
        $("<div class='child'>" + intranet+"</div>").insertAfter($(".col_footer").eq(1).find(".contenedor_footer"));
        $(".card__actions .footer_responsive").find(".intranet_responsive").remove();
        $(".list--dense").find('div').first().css("visibility","hidden");

        console.log("pagina",pagina);
        if(pagina =='home'){
            $("#home").find(".contenedor_hero").clone().insertAfter($(".container_2"));
            $("#home").find(".contenedor_hero").first().remove();
            $(".navigation-drawer .btn_hamburguesa").click();
        }
        if (pagina == 'portafoliodetalle'){
            $("#portafolio").find(".section_alquiler").clone().insertBefore($(".slider_portafolio_responsive"));
            $("#portafolio").find(".section_alquiler").last().remove();
            $("#footer .formulario_inicial").css("display","initial");

            $("#portafolio").find(".section_banner").clone().insertBefore($(".main_slider"));
            $("#portafolio").find(".section_banner").last().remove();
            $(".navigation-drawer .btn_hamburguesa").click();
        }
        if (pagina == 'comunidad') {
            $("#footer .formulario_inicial").css("display", "initial");
            $("#filtro").clone().insertBefore($("#mapa"));
            $(".filtro").last().remove();
            $(".section_banner").last().remove();
            $("#comunidad .section_banner").css("margin-top","50%");
            $(".navigation-drawer .btn_hamburguesa").click();
        }
        if(pagina =='nosotros'){
            $(".navigation-drawer .btn_hamburguesa").click();
        }
        if (pagina == 'evento' || pagina == 'mensaje') {
            $(".navigation-drawer .btn_hamburguesa").click();
        }
        
    }
};