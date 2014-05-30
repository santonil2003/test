<?php

// Declare a namespace to be used below
$ns = 'http://www.identikid.com.au/ws';

header("Cache-control: private");
include("../common_db.php");
linkme();
// Include the nusoap file
require_once('nusoap.php');

// Setup the WSDL
$server = new soap_server();
$server->debug_flag=false;
$server->configureWSDL('IKGraphics', $ns);
$server->wsdl->schemaTargetNamespace = $ns;

// Create a complex type

$server->wsdl->addComplexType(
    'OrderItem',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id' => array('name' => 'id', 'type' => 'xsd:int'),
        'ordernumber' => array('name' => 'ordernumber', 'type' => 'xsd:int'),
        'price' => array('name' => 'price', 'type' => 'xsd:float'),
        'quantdesc' => array('name' => 'quantdesc', 'type' => 'xsd:string'),
        'type' => array('name' => 'type', 'type' => 'xsd:int'),
        'typedetail' => array('name' => 'typedetail', 'type' => 'xsd:int'),
        'pic' => array('name' => 'pic', 'type' => 'xsd:string'),
        'text1' => array('name' => 'text1', 'type' => 'xsd:string'),
        'text2' => array('name' => 'text2', 'type' => 'xsd:string'),
        'text3' => array('name' => 'text3', 'type' => 'xsd:string'),
        'text4' => array('name' => 'text4', 'type' => 'xsd:string'),
        'text5' => array('name' => 'text5', 'type' => 'xsd:string'),
        'text6' => array('name' => 'text6', 'type' => 'xsd:string'),
        'text7' => array('name' => 'text7', 'type' => 'xsd:string'),
        'text8' => array('name' => 'text8', 'type' => 'xsd:string'),
        'text9' => array('name' => 'text9', 'type' => 'xsd:string'),
        'text10' => array('name' => 'text10', 'type' => 'xsd:string'),
        'text11' => array('name' => 'text11', 'type' => 'xsd:string'),
        'text12' => array('name' => 'text12', 'type' => 'xsd:string'),
        'colours' => array('name' => 'colours', 'type' => 'xsd:string'),
        'font' => array('name' => 'font', 'type' => 'xsd:string'),
        'picon' => array('name' => 'picon', 'type' => 'xsd:string'),
        'gift' => array('name' => 'gift', 'type' => 'xsd:int'),
        'split' => array('name' => 'split', 'type' => 'xsd:string'),
        'data_colour_id' => array('name' => 'data_colour_id', 'type' => 'xsd:int'),
        'data_font_colour_id' => array('name' => 'data_font_colour_id', 'type' => 'xsd:int'),
        'data_identitag_id' => array('name' => 'data_identitag_id', 'type' => 'xsd:int')
    )
);

$server->wsdl->addComplexType(
	'OrderItems', // Name
	'complexType', // Type Class
	'array', // PHP Type
	'', // Compositor
	'SOAP-ENC:Array', // Restricted Base
	array(),
	array(
		array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:OrderItem[]')
	),
	'tns:OrderItem'
);

$server->wsdl->addComplexType(
    'Order',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'Id' => array('name' => 'Id', 'type' => 'xsd:int'),
        'Surname' => array('name' => 'Surname', 'type' => 'xsd:string'),
        'Firstname' => array('name' => 'FirstName', 'type' => 'xsd:string'),
	'Started' => array('name' => 'Started', 'type' => 'xsd:string')
    )
);

// Create an array of the above ComplexType1 
// - Note that ComplexType1 is used with []'s and then without []'s

$server->wsdl->addComplexType(
	'OrderList', // Name
	'complexType', // Type Class
	'array', // PHP Type
	'', // Compositor
	'SOAP-ENC:Array', // Restricted Base
	array(),
	array(
		array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Order[]')
	),
	'tns:Order'
);

// Create a complex type to upload a file

$server->wsdl->addComplexType(
	'FileBytes', // Name
	'complexType', // Type Class
	'array', // PHP Type
	'', // Compositor
	'SOAP-ENC:Array', // Restricted Base
	array(),
	array(
		array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'xsd:unsignedByte[]')
	),
	'xsd:unsignedByte'
);


// Register the method to return a single ComplexType1

$server->register('OrderGet',                    // method name
    array('Id' => 'xsd:int'),          // input parameters
    array('return' => 'tns:Order'),    // output parameters
    $ns,                         // namespace
    $ns . '#OrderGet',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Get Specific Order'        // documentation
);

// Register the method to return all ComplexType1s

$server->register('ProcessListGet',                    // method name
    array(),          // input parameters
    array('return' => 'tns:OrderList'),    // output parameters
    $ns,                         // namespace
    $ns . '#ProcessListGet',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Get All Orders List'        // documentation
);

$server->register('OrdersGet',                    // method name
    array('startDate' => 'xsd:string', 'endDate' => 'xsd:string'),          // input parameters
    array('return' => 'tns:OrderList'),    // output parameters
    $ns,                         // namespace
    $ns . '#OrdersGet',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Get All Orders within a date range'        // documentation
);

$server->register('OrderNoGet',                    // method name
    array('orderId' => 'xsd:int'),          // input parameters
    array('return' => 'tns:OrderList'),    // output parameters
    $ns,                         // namespace
    $ns . '#OrderNoGet',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Get Order by Id'        // documentation
);

$server->register('OrderItemsGet',                    // method name
    array('Id' => 'xsd:int'),          // input parameters
    array('return' => 'tns:OrderItems'),    // output parameters
    $ns,                         // namespace
    $ns . '#OrderItemsGet',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Get Order Items'        // documentation
);

// Register the method to update a single CompexType1

$server->register('UpdateComplexType1',                    // method name
    array('ComplexType1' => 'tns:Order'),          // input parameters
    array('return' => 'xsd:boolean'),    // output parameters
    $ns,                         // namespace
    $ns . '#UpdateComplexType1',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Update a Complex Type'        // documentation
);

// Register the method to uplaod a file

$server->register('UploadFile',                    // method name
    array('bytes' => 'tns:FileBytes', 'filename' => 'xsd:string'),          // input parameters
    array('return' => 'xsd:boolean'),    // output parameters
    $ns,                         // namespace
    $ns . '#UploadFile',                   // soapaction
    'rpc',                                    // style
    'encoded',                                // use
    'Upload a File'        // documentation
);

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA'])
                        ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
$server->service($HTTP_RAW_POST_DATA);
exit();


/* 
 * Declare the functions which are called when the above methods are used 
 */

function OrderGet($id)
{
	// Example returns a dummy complex type
	return array(
		'Id' => 42,
		'Title' => "This is a description of the Complex Type",
		'Distance' => 12.4,
		'Date' => date('Y-m-d', time())
	);
}

function OrdersGet($startDate, $endDate)
{
/*
 *$query = "SELECT o.id+1000, c.surname, c.firstname, date_format(started,'%e/%m/%Y') date FROM orders o left join customers c on (o.Customer=c.id) WHERE payment_received=1 and (started >='".$startDate."' and started < '".$endDate."')";
 */
	$query = "SELECT o.id+1000, c.surname, c.firstname, date_format(started,'%e/%m/%Y') date FROM orders o left join customers c on (o.Customer=c.id) WHERE (started >='".$startDate."' and started < '".$endDate."')";
	$result = array();

	$SQLresult = mysql_query($query);

	if(!$SQLresult) error_message(sql_error());
	while($qdata = mysql_fetch_array($SQLresult)){
		$result[] = array(
			'Id' => $qdata["o.id+1000"],
			'Surname' => $qdata["surname"],
			'Firstname' => $qdata["firstname"],
			'Started' => $qdata["date"]
		);
	}

	return $result;
}

function OrderNoGet($orderId)
{

	$query = "SELECT o.id+1000, c.surname, c.firstname, date_format(started,'%e/%m/%Y') date FROM orders o left join customers c on (o.Customer=c.id) WHERE o.id=".$orderId."-1000";
	$result = array();

	$SQLresult = mysql_query($query);

	if(!$SQLresult) error_message(sql_error());
	while($qdata = mysql_fetch_array($SQLresult)){
		$result[] = array(
			'Id' => $qdata["o.id+1000"],
			'Surname' => $qdata["surname"],
			'Firstname' => $qdata["firstname"],
			'Started' => $qdata["date"]
		);
	}

	return $result;
}

function OrderItemsGet($idOrder)
{

	$query = "SELECT id,ordernumber+1000,price,quantdesc,type,typedetail,pic,text1,text2,text3,text4,text5,text6,text7,text8,text9,text10,text11,text12,colours,font,picon,gift,split,data_colour_id,data_font_colour_id,data_identitag_id FROM basket_items where ordernumber = ".$idOrder."-1000";
	$result = array();

	$SQLresult = mysql_query($query);

	if(!$SQLresult) error_message(sql_error());
	while($qdata = mysql_fetch_array($SQLresult)){
		$result[] = array(
		'id' => $qdata["id"],
		'ordernumber' => $qdata["ordernumber+1000"],
		'price' => $qdata["price"],
		'quantdesc' => $qdata["quantdesc"],
		'type' => $qdata["type"],
		'typedetail' => $qdata["typedetail"],
		'pic' => $qdata["pic"],
		'text1' => $qdata["text1"],
		'text2' => $qdata["text2"],
		'text3' => $qdata["text3"],
		'text4' => $qdata["text4"],
		'text5' => $qdata["text5"],
		'text6' => $qdata["text6"],
		'text7' => $qdata["text7"],
		'text8' => $qdata["text8"],
		'text9' => $qdata["text9"],
		'text10' => $qdata["text10"],
		'text11' => $qdata["text11"],
		'text12' => $qdata["text12"],
		'colours' => $qdata["colours"],
		'font' => $qdata["font"],
		'picon' => $qdata["picon"],
		'gift' => $qdata["gift"],
		'split' => $qdata["split"],
		'data_colour_id' => $qdata["data_colour_id"],
		'data_font_colour_id' => $qdata["data_font_colour_id"],
		'data_identitag_id' => $qdata["data_identitag_id"]
		);
	}

	return $result;
}

?>