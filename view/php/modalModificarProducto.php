<?php
require '../../model/Producto.php';
require '../../controller/conexionDbController.php';
require '../../controller/ProductoBaseController.php';
require '../../controller/ProductoController.php';

use producto\Producto;
use productoController\ProductoController;

$id = $_POST['id'];
$producto = new ProductoController();
$producto = $producto->readRow($id);



echo '
<form id="CreateForm" action="modificarProducto.php?id='.$id.'" method="POST" enctype="multipart/form-data" class="container py-4">
    <div class="row mb-3">
        <div class="col">
            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre del producto" aria-label="Nombre" value="'.$producto->getNombre().'">
        </div>s
        <div class="col">
            <input id="cantidad" name="cantidad" type="number" class="form-control" placeholder="Cantidad" aria-label="Cantidad" value="'.$producto->getCantidad().'">
        </div>
        <div class="col">
            <input id="tipoProducto" name="tipoProducto" type="text" class="form-control" placeholder="Tipo de producto" aria-label="Tipo de producto" value="'.$producto->getTipoProducto().'">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input id="categoria" name="categoria" type="text" class="form-control" placeholder="Categoría" aria-label="Categoría" value="'.$producto->getCategoria().'">
        </div>
        <div class="col">
            <input id="precioUnitario" name="precioUnitario" type="number" class="form-control" placeholder="Precio unitario" aria-label="Precio unitario" value="'.$producto->getPrecioUnitario().'">
        </div>
        <div class="col">
            <div class="input-group">
                <input id="imagenProducto" name="imagen" type="file" class="form-control" id="formFile" >
                <label class="input-group-text" for="formFile">Imagen</label>
            </div>
        </div>
    </div>
   </form>

';