<?php
include "../inclusiones/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel</title>
</head>
<?php
$carpeta = "imagen/";
$carpetaAbierta = opendir($carpeta);
//$carpetaLeida = readdir($carpetaAbierta);
$arrayArchivos = array();
while (($archivo = readdir($carpetaAbierta)) !== false) {
    if ($archivo != "." && $archivo != "..") {
        array_push($arrayArchivos, $archivo);
    }
}
//var_dump($arrayArchivos);
closedir($carpetaAbierta);
?>

<body>
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide  bg-dark" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                for ($i = 0; $i < count($arrayArchivos); $i++) {
                    if ($i == 0) {
                ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="active"></li>
                    <?php
                    } else {
                    ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
                <?php
                    }
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $bandera = 0;
                foreach ($arrayArchivos as $key => $archivo) {
                    if ($bandera == 0) {
                ?>
                        <div class="carousel-item active ">
                            <img src="imagen/<?php echo $archivo; ?>" class="d-block  h-75 mx-auto" alt="...">
                        </div>
                    <?php
                        $bandera = 1;
                    } else {
                    ?>
                        <div class="carousel-item ">
                            <img src="imagen/<?php echo $archivo; ?>" class="d-block  h-75 mx-auto" alt="...">
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

    <div class="container">
        <div class="row">
        <a class="mx-auto mt-2" href="panel.php">
            <button class="btn btn-danger  ">Ir al panel</button>
            </a>
        </div>
    </div>
</body>

</html>
<?php
include "../inclusiones/footer.php";



?>