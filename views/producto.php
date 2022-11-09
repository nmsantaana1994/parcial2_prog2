<?php
$id = $_GET["id"] ?? FALSE;
$miObjetoProducto = new Repuestos();
$producto = $miObjetoProducto->producto_x_id($id);
?>

<section class="row" id="producto">

<?php if (isset($producto)) { ?>
    
    <div class="col">
        <div class="card mt-5 mb-5 p-3">
            <div class="row">
                <div class="col-md">
                    <img class="ancho" src="imagenes/productos/<?= $producto->getCategoria() ?>/<?= $producto->getFoto() ?>" alt="<?= $producto->getMarca(); ?> <?= $producto->getModelo() ?>" style="width: 100%;">
                </div>
                <div class="col-md align-items-center">
                    <div class="card-body">
                        <h1 class="mb-3"><?= $producto->getMarca(); ?> <?= $producto->getModelo() ?></h1>
                        <p class="card-text"><?= $producto->getDescripcion() ?></p>
                    </div>
                    <div class="card-body">
                        <div class="precio"><span>$<?= $producto->precio_formateado(); ?></span></div>
                        <a href="#" class="btn w-100 btn-brown mt-4 fuente" >COMPRAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php }else{ ?>
    <div class="col">
        <h2>No se encontró el producto deseado.</h2>
    </div>

<?php } ?>

</section>