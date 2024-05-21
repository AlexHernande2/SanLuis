<?php









?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/pedido.css">
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <h1>Historial de pedido </h1>

<main>
    <!--  -->
<table class="table table-dark table-striped">
    
<thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Fecha</th>
      <th scope="col">Estado</th>
      <th scope="col">Productos</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <!-- Id del pedido -->
      <th scope="row"></th>
      <!-- Va el contenido, Nombre, Fecha, Estado y Productos-->
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
   
  </tbody>

</table>
<!--  -->
<main>
  <div class="container" id="formularioDiv">
      <!-- Contenedor Bootstrap con ID "f" -->
     
     



</main>



    <footer>
        <div id="footer-container"></div>
    </footer>
    <script src="../js/initHF.js"></script>
    <script>
            const $dropdown = $(".dropdown");
            const $dropdownToggle = $(".dropdown-toggle");
            const $dropdownMenu = $(".dropdown-menu");
            const showClass = "show";
            $(window).on("load resize", function() {
                if (this.matchMedia("(min-width: 768px)").matches) {
                    $dropdown.hover(
                        function() {
                            const $this = $(this);
                            $this.addClass(showClass);
                            $this.find($dropdownToggle).attr("aria-expanded", "true");
                            $this.find($dropdownMenu).addClass(showClass);
                        },
                        function() {
                            const $this = $(this);
                            $this.removeClass(showClass);
                            $this.find($dropdownToggle).attr("aria-expanded", "false");
                            $this.find($dropdownMenu).removeClass(showClass);
                        }
                    );
                } else {
                    $dropdown.off("mouseenter mouseleave");
                }
            });
        </script>
</body>

</html>