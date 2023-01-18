<?php

require_once("lib/nusoap.php");

$namespace = "http://localhost/DAW_M07_T06_ACT_05_Hector_Camacho/servidor.php";
$server = new soap_server();
$server->configureWSDL("Servicio web - Héctor Camacho", $namespace);
$server->schemTargetNamespace = $namespace;
$server->soap_defencoding = "UTF-8";


//FUNCIONES

function nuevo_producto($nombre_producto, $categoria){
    $con = mysqli_connect("localhost", "root", "root",  "tienda");
    mysqli_query($con, "insert into producto(nombre, categoria) values('$nombre_producto', $categoria);");
}

function obtener_categorias(){
    $con = mysqli_connect("localhost", "root", "root",  "tienda");
    $categorias = array();
    $resultado = mysqli_query($con, "select * from categoria;");
    while($categoria = mysqli_fetch_assoc($resultado)){
		$categorias[] = $categoria;
	}
    mysqli_close($con);
	return $categorias;
}

function obtener_productos($id_categoria){
    $con = mysqli_connect("localhost", "root", "root",  "tienda");
    $productos = array();
    $resultado = mysqli_query($con, "select * from producto where categoria=$id_categoria;");
    while($producto = mysqli_fetch_assoc($resultado)){
		$productos[] = $producto;
	}
    mysqli_close($con);
	return $productos;
}

//TIPOS COMPLEJOS

$server->wsdl->addComplexType(
    'Categoria',
    'complexType',
    'struct',
    'all',
    '',
    array(
    'identificador' =>
    array('name'=>'identificador','type'=>'xsd:int'),
    'nombre' =>
    array('name'=>'nombre','type'=>'xsd:string')
    )
    );
    $server->wsdl->addComplexType(
    'ArrayCategorias',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
    array('ref'=>'SOAP-ENC:arrayType',
    'wsdl:arrayType'=>'tns:Categoria[]')),
    'tns:Categoria'
    );

    $server->wsdl->addComplexType(
        'Producto',
        'complexType',
        'struct',
        'all',
        '',
        array(
        'identificador' =>
        array('name'=>'identificador','type'=>'xsd:int'),
        'nombre' =>
        array('name'=>'nombre','type'=>'xsd:string'),
        'categoria' =>
        array('name'=>'categoria','type'=>'xsd:int')
        )
        );

        $server->wsdl->addComplexType(
        'ArrayProductos',
        'complexType',
        'array',
        '',
        'SOAP-ENC:Array',
        array(),
        array(
        array('ref'=>'SOAP-ENC:arrayType',
        'wsdl:arrayType'=>'tns:Producto[]')),
        'tns:Producto'
        );

//REGISTRO DE FUNCIONES

$server->register(
    'nuevo_producto',
    array('nombre_producto'=>'xsd:string', 'categoria'=>'xsd:int'),
    array(),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Función que crea un nuevo producto.'
);

$server->register(
    'obtener_categorias',
    array(),
    array('return'=>'tns:ArrayCategorias'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Método que devuelve una array de las categorías.'
    );

$server->register(
    'obtener_productos',
    array('id_categoria'=>'xsd:int'),
    array('return'=>'tns:ArrayProductos'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Método que devuelve una array con los productos de una categoría específica.'
    );

$server->service(file_get_contents("php://input"));


?>