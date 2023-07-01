<?php

include '../conexion.php';


$tblReturn_item = "DROP TABLE RETURN_ITEM";
$tblOrder_item = "DROP TABLE ORDER_ITEM";
$tblReturn = "DROP TABLE RETURN";
$tblOrden = "DROP TABLE ORDEN";
$tblClient = "DROP TABLE CLIENT";
$tblBread = "DROP TABLE BREAD";
oci_execute(oci_parse($connect, $tblReturn_item));
oci_execute(oci_parse($connect, $tblOrder_item));
oci_execute(oci_parse($connect, $tblReturn));
oci_execute(oci_parse($connect, $tblOrden));
oci_execute(oci_parse($connect, $tblClient));
oci_execute(oci_parse($connect, $tblBread));


$BREAD_SEQ = "DROP SEQUENCE BREAD_SEQ";
$CLIENT_SEQ = "DROP SEQUENCE CLIENT_SEQ";
$ORDEN_SEQ = "DROP SEQUENCE ORDEN_SEQ";
$RETURN_SEQ = "DROP SEQUENCE RETURN_SEQ";
oci_execute(oci_parse($connect, $BREAD_SEQ));
oci_execute(oci_parse($connect, $CLIENT_SEQ));
oci_execute(oci_parse($connect, $ORDEN_SEQ));
oci_execute(oci_parse($connect, $RETURN_SEQ));


$generateID_client = "DROP TRIGGER generateID_client";
$generateID_Orden = "DROP TRIGGER generateID_Orden";
$generateID_Bread = "DROP TRIGGER generateID_Bread";
$generateID_Return = "DROP TRIGGER generateID_Return";
oci_execute(oci_parse($connect, $generateID_client));
oci_execute(oci_parse($connect, $generateID_Orden));
oci_execute(oci_parse($connect, $generateID_Bread));
oci_execute(oci_parse($connect, $generateID_Return));

?>