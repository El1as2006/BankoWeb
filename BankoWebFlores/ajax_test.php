<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Documento sin título</title>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script>
        
        $(document).ready(function () {
            $("#resultadoBusqueda").html('<p>JQUERY VACIO</p>');
        });
       
        function buscar() {
            
            var textoBusqueda = $("input#busqueda").val();

            if (textoBusqueda != "") {
                $.post("gethint_ajax.php", { valorBusqueda: textoBusqueda }, function (mensaje) {
                    $("#resultadoBusqueda").html(mensaje);
                });
            } else {
                $("#resultadoBusqueda").html('<p>JQUERY 123 VACIO</p>');
            }
        }
    </script>
</head>
<body>
    <form accept-charset="utf-8" method="post">
        <input type="text" name="busqueda" id="busqueda" value="" placeholder="" maxlength="30" autocomplete="off" />
    </form>
    <div id="resultadoBusqueda"></div>
</body>
</html>
