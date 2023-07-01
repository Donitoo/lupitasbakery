<?php 
   session_start();

   if (!isset($_SESSION['email'])){

      header('Location: ../login.php');
   } else{
       if ($_SESSION['email']!='Admin'){
          header("Location: panel/ingresar_pedido.php");
          // echo "ingresar_pedido";
       }
   }

    include 'conexion.php';


    if (isset($_POST['Type']) && isset($_POST['Price'])){

        $sentencia= "INSERT INTO Bread(type,price) VALUES ('".$_POST['Type']."',".$_POST['Price'].")";
        $stid = oci_parse($conn, $sentencia);
        oci_execute($stid);
        header("Location: index_bread.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Bread | Lupita's Bakery</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">


    <link rel="stylesheet" href="../assets/css/panel/style.css">

</head>

<body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../assets/img/logo.png" alt="" width="72" height="72">
            <h2>Register Bread</h2>

        </div>

        <div class="row">
            <form action="register_bread.php" method="POST" class="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Type</label>
                    <input type="text" class="form-control" id="dba" name="Type" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Price</label>
                    <input type="text" class="form-control" id="phone" name="Price" aria-describedby="emailHelp" value="0.15">

                </div>
                

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017-2018 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script>
    // alert("Holi");


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





    })();
    </script>


</body>

</html>