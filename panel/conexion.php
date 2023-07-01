<?php
// (SERVICE_NAME = lupitapdb)

// $db = "(DESCRIPTION =
//   (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
//   (CONNECT_DATA =
//     (SERVER = DEDICATED)
//     (SERVICE_NAME = lupitapdb)
//   )
// )";
$db= "lupitabakeryapp.database.com";
$conn = oci_connect("lupitabakery", "12345", $db);

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} else {
    // var_dump($connect);
}
?>