
function consulta_buscador(busqueda) {
    var parametros = { "busqueda": busqueda };
    $.ajax({
        data: parametros,
        url: '../html/busqueda.php',
        type: 'POST',
        beforeSend: function () {

        },
        success: function (data) {

            if (busqueda == '') {
                document.getElementById("card_busqueda").style.opacity = 0;
            } else {
                document.getElementById("card_busqueda").style.transition = "all 1s";
                document.getElementById("card_busqueda").style.opacity = 1;
            }

            document.getElementById("resultados_busqueda_nav").innerHTML = data;
        },
        error: function (data, error) {


        }
    })
}
