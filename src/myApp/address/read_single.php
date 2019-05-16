<?php
/**
 * Created by PhpStorm.
 * User: Rafal Feliga
 * Date: 10/05/2019
 * Time: 13:27
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once '../../../vendor/autoload.php';
include '../../authentication.php';

use App\DBConnect;
use App\Address;

$dbConn = new DBConnect();
$dbConn->get_Connection();

$address = new Address($dbConn->conn);

$address->guid = isset($_GET['guid']) ? $_GET['guid'] : die();

$address_arr=array();
$address_arr["records"]=array();

$address->readOne();

if($address->guid!=null){

    $address_item = array(
        "id" => $address->id,
        "guid" => $address->guid,
        "name" => $address->name,
        "gender" => $address->gender,
        "company" => $address->company,
        "phone" => $address->phone,
        "address" => $address->address,
        "latitude" => $address->latitude,
        "longitude" => $address->longitude,
        "age" => $address->age,
        "picture" => $address->picture,
        "eyeColor" => $address->eyeColor,
        "about" => $address->about,
        "email" => $address->email,
        "balance" => $address->balance,
        "isActive" => $address->isActive,
        "registered" => $address->registered


    );

    array_push($address_arr["records"], $address_item);

    http_response_code(200);

    echo json_encode($address_arr);
}

else{
    http_response_code(404);

    echo json_encode(array("message" => "Product does not exist."));
}
?>