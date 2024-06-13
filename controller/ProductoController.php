<?php
namespace productoController;

use producto\Producto;
use productoController\ProductoBaseController;
use conexionDb\ConexionDbController;

class ProductoController extends ProductoBaseController
{
    function updateProducto($id,$nombre, $cantidad, $tipoProducto, $categoria, $precioUnitario, $imagenProducto)
    {
        $conexiondb = new ConexionDbController();
        $imagenProducto = $conexiondb->execSQLESCAPE($imagenProducto);
        $sql = 'update producto ';
        $sql .= 'SET nombre = "'.$nombre.'", cantidad = '.$cantidad.', tipoProducto = "'.$tipoProducto.'", categoria = "'.$categoria.'", precioUnitario = '.$precioUnitario;

        if(!empty($imagenProducto)){
            $sql .= ',imagenProducto = "'.$imagenProducto.'"';
        }
        $sql .= 'where id = '.$id.'';
        $resultadoSQL = $conexiondb->execSQL($sql);
        $conexiondb->close();
        return $resultadoSQL;
    }
    function createProducto($nombre, $cantidad, $tipoProducto, $categoria, $precioUnitario, $imagenProducto)
    {
        
        $conexiondb = new ConexionDbController();
        //se busca los nombres que existen en la base de datos
        $sql = 'select * from producto where nombre = "'.$nombre.'"';
        $nombreRep = $conexiondb->execSQL($sql);
        $nombreRep = $nombreRep->fetch_assoc();
        $nombreRep = $nombreRep['nombre'];

        if(str_replace(" ","",$nombre) == str_replace(" ","",$nombreRep)){
            echo "<script>alert('Error: Producto con este nombe $nombre ya existe.');</script>";
            header('Refresh:0,5 ; url = indexAdmin.php');
            return "holas";
        }else{
            $imagenProducto = $conexiondb->execSQLESCAPE($imagenProducto);
            $sql = "insert into producto (nombre,cantidad,tipoProducto,categoria,precioUnitario,imagenProducto)";
            $sql .= "VALUES ('" . $nombre . "'," . $cantidad . ",'" . $tipoProducto . "','" . $categoria . "'," . $precioUnitario . ",'" . $imagenProducto . "')";
            $resultadoSQL = $conexiondb->execSQL($sql);
            $conexiondb->close();
            return $resultadoSQL;
        }

    
    }
    function readProductoCategori($tipoProducto)
    {
        $sql = 'select * from producto ';
        $sql .= 'where tipoProducto="' . $tipoProducto . '"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $productosValid = [];
        while ($registro = $resultadoSQL->fetch_assoc()) {
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);
       

            array_push($productosValid, $producto);


        }
        $conexiondb->close();
        return $productosValid;
    }
    function readProducBuscador($nombre)
    {
        $sql = 'select * from producto ';
        $sql .= 'WHERE nombre LIKE "%' . $nombre . '%"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $productos = [];
        while ($registro = $resultadoSQL->fetch_assoc()) {
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);


            array_push($productos, $producto);


        }
        $conexiondb->close();
        return $productos;
    }
    function readRow($idProducto)
    {
        $sql = 'select * from producto ';
        $sql .= 'WHERE id = ' . $idProducto;
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        while ($registro = $resultadoSQL->fetch_assoc()) {
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);

        }
        $conexiondb->close();
        return $producto;
    }


    /* */
    // Nuevo método para obtener todos los productos
    function readAllProductos()
    {
        $sql = 'SELECT * FROM producto';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $productos = [];
        while ($registro = $resultadoSQL->fetch_assoc()) {
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);

            array_push($productos, $producto);
        }
        $conexiondb->close();
        return $productos;
    }
    /* */
    function readProducBuscador3($categoria, $producto, $subCategoria)
    {
        //select * from producto where categoria LIKE "%comida%" AND tipoProducto LIKE "%vegetales%" AND nombre LIKE "%cilantro%"
        $sql = 'select * from producto ';
        $sql .= 'WHERE categoria LIKE "%' . $categoria . '%" AND ';
        $sql .= 'tipoProducto LIKE "%' . $subCategoria . '%" AND ';
        $sql .= 'nombre LIKE "%' . $producto . '%"';
        $conexiondb = new ConexionDbController();
        $resultadoSQL = $conexiondb->execSQL($sql);
        $productos = [];
        while ($registro = $resultadoSQL->fetch_assoc()) {
            $producto = new Producto();
            $producto->setId($registro['id']);
            $producto->setNombre($registro['nombre']);
            $producto->setDescripcion($registro['descripcion']);
            $producto->setCantidad($registro['cantidad']);
            $producto->setTipoProducto($registro['tipoProducto']);
            $producto->setCategoria($registro['categoria']);
            $producto->setPrecioUnitario($registro['precioUnitario']);
            $producto->setImagen($registro['imagenProducto']);


            array_push($productos, $producto);


        }
        $conexiondb->close();
        return $productos;

    }




    function delete($id) {
      
        $conexiondb = new ConexionDbController();
        
        $sql = 'DELETE FROM producto WHERE id = ' . $id;
        // Ejecutar la consulta
        $resultadoSQL = $conexiondb->execSQL($sql);
        $conexiondb->close();
        return $resultadoSQL;
    }



    function pdf($pdf)
    {
        $conexiondb = new ConexionDbController();
        $PDF = $conexiondb->execSQLESCAPE($pdf);
        $sql = 'insert into pdf (pdf) ';
        $sql .= 'VALUES ("'.$PDF.'")';
        $resultadoSQL = $conexiondb->execSQL($sql);
        $sql = 'select MAX(id) from pdf ';
        $resultadoSQL = $conexiondb->execSQL($sql);
        $resultadoSQL = $resultadoSQL->fetch_assoc();
        $resultadoSQL = $resultadoSQL['MAX(id)'];
        $conexiondb->close();
        return $resultadoSQL;
    }
    function readPdf($id){
        $conexiondb = new ConexionDbController();
        $sql = 'select pdf from pdf ';
        $sql .= 'where id='.$id.'';
        $resultadoSQL = $conexiondb->execSQL($sql);
        $resultadoSQL = $resultadoSQL->fetch_assoc();
        $resultadoSQL = $resultadoSQL['pdf'];
        // $resultadoSQL = $conexiondb->execSQLESCAPE($resultadoSQL);
        $conexiondb->close();
        return $resultadoSQL;
    }
}

