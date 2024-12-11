<?php
/*
 *	$Id: client1.php,v 1.3 2007/11/06 14:48:24 snichol Exp $
 *
 *	Client sample that should get a fault response.
 *
 *	Service: SOAP endpoint
 *	Payload: rpc/encoded
 *	Transport: http
 *	Authentication: none
 */
//ruta
require_once "vendor/econea/nusoap/src/nusoap.php";
$namespace = "InsertCategoriaSOAP";

// Config
$server = new nusoap_server();
$server->configureWSDL('InsertCategoria', $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

//estructura del servicio SOAP
$server->wsdl->addComplexType(
    'InsertCategoria',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'apellidos' => array('name' => 'apellidos', 'type' => 'xsd:string'),
        'correo' => array('name' => 'correo', 'type' => 'xsd:string')
    )
);

//Respuesta
$server->wsdl->addComplexType(
    'response',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'res' => array('name' => 'res', 'type' => 'xsd:boolean')
    )
);
$server->register(
    'InsertCategoriaService',
    array('InsertCategoria' => 'tns:InsertCategoria'),
    array('InsertCategoria' => 'tns:response'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'inserta una categoria'
);


 function InsertCategoriaService($request)
{
    require_once "config/Conection.php";
    require_once "controller/UsusarioController.php";

    $usuario = new Usuario();
    $usuario->store($request['nombre'], $request['apellidos'], $request['correo']);
    return array('res' => true);

}

$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);
exit();

?>