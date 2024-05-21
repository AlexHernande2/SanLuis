

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
                    <th scope="row">1</th>
                    <!-- Va el contenido, Nombre, Fecha, Estado y Productos-->
                    <td>Cesar Martinez Avella </td>
                    <td>21/05/2024</td>
                    <td>Rec</td>
                    <td>

                        <div class="container-sm">
                            <div class="accordion  accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Ver Productos
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Aca se deben mostrar los productos del cliente.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </td>
                </tr>

            </tbody>

        </table>
<p>d</p>


    </main>



    <footer>
        <div id="footer-container"></div>
    </footer>
    <script src="../js/initHF.js"></script>

</body>

</html>