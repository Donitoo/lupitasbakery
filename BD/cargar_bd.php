<?php

include '../conexion.php';
include '../funciones/generateID.php';


####################################################
############# CLIENT
####################################################
$tblClient = "INSERT ALL ";
$tblClient.= "INTO client(dba,register_date,email,password) values ('Protiviti','12/09/21','ventas@protiviti.com','12345')";
$tblClient.= "INTO client(dba,register_date,email,password) values ('Paycom','12/09/21','ventas@Paycom.com','12345')";
$tblClient.= "INTO client(dba,register_date,email,password) values ('QuikTrip','12/09/21','ventas@QuikTrip.com','12345')";
$tblClient .= "SELECT * FROM dual"; 


####################################################
############# BREAD
####################################################
$tblBread = "INSERT ALL ";
$tblBread.= "INTO Bread (type,price) values ('Frybread',0.15)";
$tblBread.= "INTO Bread (type,price) values ('cornbread',0.15)";
$tblBread.= "INTO Bread (type,price) values ('Pan Graham',0.15)";
$tblBread .= "SELECT * FROM dual";


####################################################
############# ORDEN
####################################################
$tblOrden = "INSERT INTO Orden(client_id,delivery_date,bread_quantity,total) values ('41','12/09/21',150,22.5)";
oci_execute(oci_parse($connect, $tblOrden));
$orden_id = generateID('order_id','Orden');
echo "<BR> Orden ID: ".$orden_id;

############# ORDEN_ITEM #############
$tblOrder_item = "INSERT ALL ";
$tblOrder_item.= "INTO Order_item (order_id,bread_id,bread_quantity,subtotal) values ($orden_id,'1',100,15)";
$tblOrder_item.= "INTO Order_item (order_id,bread_id,bread_quantity,subtotal) values ($orden_id,'2',50,7.5)";
$tblOrder_item .= "SELECT * FROM dual";


####################################################
############# RETURN
####################################################
$tblReturn = "INSERT INTO Return (client_id,fecha,bread_quantity,total) values ('41','12/09/21',20,3)";
oci_execute(oci_parse($connect, $tblReturn));
$return_id = generateID('return_id','Return');
echo "<BR> Return ID: ".$return_id;

############# RETURN_ITEM #############
$tblReturn_item = "INSERT ALL ";
$tblReturn_item.= "INTO Return_item (return_id,bread_id,bread_quantity,subtotal) values ($return_id,'1',20,3)";
$tblReturn_item .= "SELECT * FROM dual";



// oci_execute(oci_parse($connect, $tblClient));
// oci_execute(oci_parse($connect, $tblBread));

// oci_execute(oci_parse($connect, $tblOrder_item));
// oci_execute(oci_parse($connect, $tblReturn_item));

?>