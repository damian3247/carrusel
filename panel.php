
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

</head>
<?php
$carpeta = "imagenProvisoria";
if (!dir($carpeta)) {
    mkdir($carpeta, 0777, true);
}
$carpetaAbierta = opendir($carpeta);
$arrayArchivos = array();
while (($archivo = readdir($carpetaAbierta)) !== false) {
    if ($archivo != "." && $archivo != "..") {
        array_push($arrayArchivos, $archivo);
    }
}
closedir($carpetaAbierta);


?>

<body class="bg-light">

    <div class="container mt-1">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                for ($i = 0; $i < count($arrayArchivos); $i++) {
                    if ($i == 0) {
                ?>
                        <li data-toggle="tooltip" title="x" data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="active"></li>
                    <?php
                    } else {
                    ?>
                        <li data-toggle="tooltip" title="x" data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
                <?php
                    }
                }
                ?>
            </ol>
            <div class="carousel-inner bg-dark">
                <?php
                $bandera = 0;
                foreach ($arrayArchivos as $key => $archivo) {
                    if ($bandera == 0) {
                ?>
                        <div class="carousel-item active ">
                            <img src="<?php echo $carpeta; ?>/<?php echo $archivo; ?>" class="d-block  h-50 mx-auto" alt="...">
                        </div>
                    <?php
                        $bandera = 1;
                    } else {
                    ?>
                        <div class="carousel-item ">
                            <img src="<?php echo $carpeta; ?>/<?php echo $archivo; ?>" class="d-block  h-50 mx-auto" alt="...">
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <button class="btn btn-info col-6 col-sm-3 " id="parar">Parar <i class="bi bi-pause-fill"></i></button>
            <button class="btn btn-danger col-6 col-sm-3" id="eliminar">Eliminar <i class="bi bi-trash"></i></button>
            <button class="btn btn-primary col-6 col-sm-3" id="enviarTodo">Enviar para carr actual <i class="bi bi-arrow-bar-down"></i></button>
            <button class="btn btn-warning col-6 col-sm-3" id="recibirTodo">Recibir de actual <i class="bi bi-arrow-bar-up"></i></button>
        </div>
    </div>
    </div>
    <div class="container mt-3">
        <div class="row ">
            <form class="mx-auto border form-inline" action="funciones.php" method="post" enctype="multipart/form-data">
                <input class="form-control" type="file" name="imagen" id="imagen">
                <button class="btn btn-primary form-control">Enviar</button>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2 class="mx-auto">Carrusel Actual</h2>
        </div>
        <div class="row">
           
        </div>
        <div class="row mt-1">
            <div class="col-12 border">
                <iframe src="./index.php" frameborder="0" class="mx-auto" width="100%" height="300"></iframe>
            </div>
        </div>
    </div>
</body>

<script src="js/jquery-3.5.1.js"></script>
<script src="js/bootstrap.js"></script>
</html>

<script>
    $('.carousel').carousel({
        interval: 1500
    })

    $('#parar').click(function() {
        $('.carousel').carousel('pause');

    })
    $('#eliminar').click(function() {
        var nombreImg = $(".active").find("img").attr("src");
        $.ajax({
            url: "funciones.php",
            type: "post",
            data: {
                nombreImagen: nombreImg
            },
            success: function(respuesta) {
                alert(respuesta);
                location.reload();
            }
        })
    });

    $('#enviarTodo').click(function() {
        $.ajax({
            url: "funciones.php",
            type: "post",
            data: {
                operacion: "enviar",
            },
            success: function(respuesta) {
                location.reload();
            }
        })
    });

    $('#recibirTodo').click(function() {
        $.ajax({
            url: "funciones.php",
            type: "post",
            data: {
                operacion: "recibir",
            },
            success: function(respuesta) {
                location.reload();
            }
        })
    });
</script>