
<?php


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SuperMercadoSanLuis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/index.css">


</head>


<body>
  <header>
    <?php include 'header.php' ; ?>
  </header>

  <main>
    <!-- Carrusel de imagenes -->

    <div class="container-fluid " id="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div id="carouselProductos" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../imagenes/cafe.jpg" class="d-block w-100" alt="cafe">
              </div>
              <div class="carousel-item">
                <img src="../imagenes/cocacola.jpg" class="d-block w-100" alt="cocacola">
              </div>
              <div class="carousel-item">
                <img src="../imagenes/pepsi.jpg" class="d-block w-100" alt="pepsi">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Caja de categorias -->
    <div class="container">
      <section id="categoriesSection">
        <h1>Destacados</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4">
          <div class="col">
            <div class="card" id="contenidoCajaCat">
              <img src="../imagenes/vegetales.jpg.png" class="card-img-top" alt="vegetales">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=vegetales" id="titCategorias">
                  <h5 class="card-title" id="tit">vegetales</h5>
                </a>

              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  id="contenidoCajaCat">
              <img src="../imagenes/pan.jpg.png" class="card-img-top" alt="pan">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=panaderia" id="titCategorias">
                  <h5 class="card-title" id="tit">Panadería</h5>
                </a>

              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  id="contenidoCajaCat">
              <img src="../imagenes/alcohol.jpg.png" class="card-img-top" alt="licores">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=cerveza" id="titCategorias">

                  <h5 class="card-title" id="tit">Licores</h5>
                </a>

              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  id="contenidoCajaCat">
              <img src="../imagenes/lacteos.jpg.png" class="card-img-top" alt="lacteos">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=lacteos y huevos" id="titCategorias">
                  <h5 class="card-title" id="tit">Lácteos y huevos</h5>
                </a>
              </div>
            </div>
          </div>
        </div>
        <br>
        <!-- Segunda fila -->
        <div class="row row-cols-1 row-cols-md-4 g-4">
          <div class="col">
            <div class="card"  id="contenidoCajaCat">
              <img src="../imagenes/carne.jpg.png" class="card-img-top" alt="carne">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=carnes y aves" id="titCategorias">
                  <h5 class="card-title" id="tit">Carne y aves</h5>
                </a>

              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  id="contenidoCajaCat">
              <img src="../imagenes/gaseosas.jpg.png" class="card-img-top" alt="productosSinAlcohol">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=bebidas sin alcohol" id="titCategorias">
                  <h5 class="card-title" id="tit">Bebidas sin alcohol</h5>
                </a>

              </div>
            </div>
          </div>
          <div class="col">
            <div class="card"  id="contenidoCajaCat">
              <img src="../imagenes/limpieza.jpg.png" class="card-img-top" alt="productosLimpieza">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=casa y cocina" id="titCategorias">
                  <h5 class="card-title" id="tit">Productos de limpieza</h5>
                </a>

              </div>
            </div>
          </div>
          <div class="col ">
            <div class="card"  id="contenidoCajaCat">
              <img src="../imagenes/cereal-1444495_1280.jpg.192x192.png" class="card-img-top" alt="cereales">
              <div class="card-body">
                <a href="./productos.php?tipoProducto=cereales" id="titCategorias">
                  <h5 class="card-title" id="tit">Cereales</h5>
                </a>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>



    <br>

  </main>

  <footer>
    <div id="footer-container"></div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../js/index.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="../js/busqueda.js"></script>
  <script src="../js/index.js"></script>
  <script src="../js/initHF.js"></script>
  
</body>

</html>