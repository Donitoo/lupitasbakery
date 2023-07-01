<?php
date_default_timezone_set('America/Lima');
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../login.php');
}

include 'conexion.php';

$descuento = 0;
$sentencia = "SELECT discount FROM Client_view WHERE client_id=client_id";
$stid = oci_parse($conn, $sentencia);
oci_execute($stid);

while (oci_fetch($stid)) {
    $descuento = oci_result($stid, 'DISCOUNT');
}

$Breads = oci_parse($conn, 'SELECT * FROM Bread');
oci_execute($Breads);



if(!isset($_POST['Registro']) ){
   
}else {
   
    // var_dump($_POST['client_id']) ;echo "<br>";
    // var_dump($_POST['Type']) ;echo "<br>";
    // var_dump($_POST['Quantity']) ;echo "<br>";

    $client_id = $_POST['client_id'];

    $b= array();
    foreach ($_POST['Type'] as $clave => $valor) {
        array_push($b,$valor);
    }

    $c= array();
    foreach ($_POST['Quantity'] as $clave => $valor) {
        array_push($c,intval($valor));
    }

    $stid = oci_parse($conn, "begin  My_Procedures.new_order(:p1,:p2,:p3); end;");
    oci_bind_by_name($stid, ':p1', $client_id);
    oci_bind_array_by_name($stid, ":p2", $b, count($b), 20, SQLT_CHR);
    oci_bind_array_by_name($stid, ":p3", $c, count($c), 20, SQLT_INT );
    oci_execute($stid);

    // header('Location: ../login.php');
}






?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CPanel | Lupita's Bakery</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">


    <link rel="stylesheet" href="../assets/css/panel/style.css">

</head>

<body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <a href="../index.php"><img class="d-block mx-auto mb-4" src="../assets/img/logo.png" alt="" width="72" height="72"></a>
            <h2>Register Order</h2>
            <p class="lead">You can send them for delivery nationwide! Lupita's Bakery is the most reliable bread
                delivery service online - we guarantee on-time delivery
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4" id="carritoCompras">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill" id="contadorPanes">0</span>
                </h4>
                <ul class="list-group mb-3">
                    <!-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0" id="nombrePan"></h6>
                            <small class="text-muted">Unit cost: $<span id="precioUnitario">1.48</span></small>
                        </div>
                        <span class="text-muted">$<span id="Tb1">0</span></span>
                    </li> -->
                </ul>
                <span class="list-group-item d-flex justify-content-between">
                    <span>Discount</span>
                    <strong class="text-danger">-$<span id="D"><?PHP echo  $descuento ?></span></strong>
                </span>
                <span class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<span id="T">0</span></strong>
                </span>


            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Breads</h4>
                <form class="form-inline" >
                    <div class="form-group mb-2">
                        <select id="selectPanes">
                            <?php
                            while (oci_fetch($Breads)) {
                                echo "<option>".oci_result($Breads, 'TYPE')."</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">Quantity</label>
                        <input type="text" class="form-control" id="quantity" placeholder="Quantity">
                    </div>
                    <button class="btn btn-primary mb-2" id="addBread">Add Bread</button>
                </form>
                <!-- action="ingresar_pedido.php" method="POST" -->
                <form class="needs-validation" novalidate="" action="ingresar_pedido.php" method="POST" >
                <input type="hidden" name="client_id" value="<?php echo $_SESSION['user_id'] ?>">
                    <hr class="mb-4">

                    <div class="row">

                        <table class="table" id="panes">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bread</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>


                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="Registro">Continue to
                        checkout</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2021 Lupita Bakery</p>
            <!-- <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul> -->
        </footer>
    </div>


    <script src="../assets/js/jquery-3-3-1.js"></script>

    <script>
        // alert("Holi");
        var total = 0;
        (function() {
            'use strict';

            window.addEventListener('load', function() {

                var forms = document.getElementsByClassName('needs-validation');

                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);

            var x;


            $('#addBread').on('click', function() {
                event.preventDefault();

                var precioUnitario = 0.15;
                var rowCount = $('#panes tr').length;
                var selectPanes = $('select[id="selectPanes"] option:selected').text();
                var quantity = $("#quantity").val();
                var discount = $("#D").val();
                var subTotal = parseInt(quantity) * 0.15;
                total = Total(subTotal)- discount;
                $("#contadorPanes").text(rowCount);
                $("#T").text(total.toFixed(2));
                // $("#nombrePan").text(selectPanes);
                $("#carritoCompras ul").append(
                    "<li class='list-group-item d-flex justify-content-between lh-condensed'> <div><h6 class='my-0' id='nombrePan'>" +
                    selectPanes + "</h6><small class='text-muted'>Unit cost: $<span id='precioUnitario'>" +
                    precioUnitario + "</span></small></div><span class='text-muted'>$<span id='Tb1'>" +
                    subTotal.toFixed(2) + "</span></span></li>");
                var htmlTags = '<tr>' +
                    '<th scope="row">' + rowCount + '</th>' +
                    '<td>' + selectPanes + '</td>' +
                    '<td>' + quantity + '</td>' +
                    '<td>' + subTotal.toFixed(2) + '</td>' +
                    '<input type="hidden" id="t-'+rowCount +'" name="Type[]" value="'+ selectPanes+'">'+
                    '<input type="hidden" id="q-'+rowCount +'" name="Quantity[]" value="'+ quantity+'">'+
                '</tr>';
                $('#panes tbody').append(htmlTags);

            });

            function Total(x) {
                return total + x;
            }



        })();
    </script>
<script src="jquery.js"></script>
<script src="main.js"></script>
</body>

</html>