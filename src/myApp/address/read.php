<?php
/**
 * Created by PhpStorm.
 * User: Rafal Feliga
 * Date: 10/05/2019
 * Time: 09:25
 */

// required headers
$callback = isset($_GET["callback"]) ? $_GET["callback"] : "?";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../../../vendor/autoload.php';

use App\DBConnect;
use App\Address;

$dbConn = new DBConnect();
$dbConn->get_Connection();

$address = new Address($dbConn->conn);

// query addresses
$result = $address->read();
$num = $result->rowCount();

// check for records
if($num>0){

    $address_arr=array();
    $address_arr["records"]=array();

    // retrieve table contents
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        // TODO change the categories
        $address_item=array(
            "id" => $row['id'],
            "name" => $row['name'],
            "guid" => $row['guid'],
            "email" => $row['email'],
            "isActive" => $row['isActive']
            //"gender" => $row['gender'],
            //"company" => $row['company'],
            //"phone" => $row['phone'],
            //"address" => $row['address'],
            //"latitude" => $row['latitude'],
            //"longitude" => $row['longitude']
        );

        array_push($address_arr["records"], $address_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show data in json format
    echo json_encode($address_arr);
} else {

    http_response_code(404);

    echo json_encode(
        array("message" => "No records found.")
    );
}