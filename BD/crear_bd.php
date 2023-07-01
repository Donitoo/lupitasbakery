<?php

include '../conexion.php';

$tblClient = "CREATE TABLE Client(
    client_id VARCHAR2(6) NOT NULL,
    DBA     VARCHAR2(120) NOT NULL,
    register_date DATE,
    discount NUMBER(10,4),
    phone VARCHAR2(11),
    email VARCHAR2(120) NOT NULL,
    password VARCHAR2(120) NOT NULL,

    CONSTRAINT PK_Client
    PRIMARY KEY(client_id)
)";

$tblOrden = "CREATE TABLE Orden(
    order_id    VARCHAR2(12) NOT NULL,
    client_id   VARCHAR2(6) NOT NULL,
    register_date   DATE,
    delivery_date   DATE,
    bread_quantity  NUMBER(5) ,
    total   NUMBER(10,4) ,

    CONSTRAINT PK_Orden
    PRIMARY KEY(order_id),

    CONSTRAINT FK_Order_Client
    FOREIGN KEY (client_id)
    REFERENCES Client(client_id)
)";


$tblBread = "CREATE TABLE Bread(
    bread_id VARCHAR2(6) NOT NULL,
    type VARCHAR2(120) NOT NULL,
    price NUMBER(10,4) NOT NULL,

    CONSTRAINT PK_Bread
    PRIMARY KEY(bread_id)
)";


$tblOrder_item = "CREATE TABLE Order_item(
    order_id    VARCHAR2(12) NOT NULL,
    bread_id VARCHAR2(6) NOT NULL,
    bread_quantity NUMBER(5),
    subtotal NUMBER(10,4),

    CONSTRAINT PK_Order_item
    PRIMARY KEY(order_id,bread_id),

    CONSTRAINT FK_Order_item_Orden
    FOREIGN KEY (order_id)
    REFERENCES Orden(order_id),

    CONSTRAINT FK_Order_item_Bread
    FOREIGN KEY (bread_id)
    REFERENCES Bread(bread_id)
)";


$tblReturn = "CREATE TABLE Return(
    return_id VARCHAR2(12) NOT NULL,
    client_id VARCHAR2(6) NOT NULL,
    fecha DATE,
    bread_quantity NUMBER(5),
    total NUMBER(10,4),

    CONSTRAINT PK_Return
    PRIMARY KEY(return_id),

    CONSTRAINT FK_Return_Client
    FOREIGN KEY (client_id)
    REFERENCES Client(client_id)
)";


$tblReturn_item = "CREATE TABLE Return_item(
    return_id VARCHAR2(12) NOT NULL,
    bread_id VARCHAR(6) NOT NULL,
    bread_quantity NUMBER(5),
    subtotal NUMBER(10,4),

    CONSTRAINT PK_Return_item
    PRIMARY KEY(return_id,bread_id),

    CONSTRAINT FK_Return_item_Return
    FOREIGN KEY (return_id)
    REFERENCES Return(return_id),

    CONSTRAINT FK_Return_item_Bread
    FOREIGN KEY (bread_id)
    REFERENCES Bread(bread_id)

)";

$client_seq = "CREATE SEQUENCE client_seq START WITH 1";
$Orden_seq = "CREATE SEQUENCE Orden_seq START WITH 1";
$Bread_seq = "CREATE SEQUENCE Bread_seq START WITH 1";
$Return_seq = "CREATE SEQUENCE Return_seq START WITH 1";

$generateID_client = "CREATE OR REPLACE TRIGGER generateID_client
BEFORE INSERT ON client 
FOR EACH ROW
BEGIN
  SELECT client_seq.NEXTVAL
  INTO   :new.CLIENT_ID
  FROM   dual;
END;
/";

$generateID_Orden = "CREATE OR REPLACE TRIGGER generateID_Orden
BEFORE INSERT ON Orden 
FOR EACH ROW
BEGIN
  SELECT Orden_seq.NEXTVAL
  INTO   :new.order_id
  FROM   dual;
END;
/";

$generateID_Bread = "CREATE OR REPLACE TRIGGER generateID_Bread
BEFORE INSERT ON Bread 
FOR EACH ROW
BEGIN
  SELECT Bread_seq.NEXTVAL
  INTO   :new.bread_id
  FROM   dual;
END;
/";

$generateID_Return = "CREATE OR REPLACE TRIGGER generateID_Return
BEFORE INSERT ON Return 
FOR EACH ROW
BEGIN
  SELECT Return_seq.NEXTVAL
  INTO   :new.return_id
  FROM   dual;
END;
/";


#Tables
oci_execute(oci_parse($connect, $tblClient));
oci_execute(oci_parse($connect, $tblBread));
oci_execute(oci_parse($connect, $tblOrden));
oci_execute(oci_parse($connect, $tblOrder_item));
oci_execute(oci_parse($connect, $tblReturn));
oci_execute(oci_parse($connect, $tblReturn_item));

#Secuencias
oci_execute(oci_parse($connect, $client_seq));
oci_execute(oci_parse($connect, $Orden_seq));
oci_execute(oci_parse($connect, $Bread_seq));
oci_execute(oci_parse($connect, $Return_seq));

#Triggers
// oci_execute(oci_parse($connect, $generateID_client));
// oci_execute(oci_parse($connect, $generateID_Orden));
// oci_execute(oci_parse($connect, $generateID_Bread));
// oci_execute(oci_parse($connect, $generateID_Return));

?>