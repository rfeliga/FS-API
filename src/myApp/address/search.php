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

$search_term= isset($_GET['search']) ? $_GET['search'] : die();

$address_arr=array();
$address_arr["records"]=array();

// query addresses
$result = $address->search_term($search_term);
$num = $result->rowCount();


if($num>0){

    // retrieve table contents
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        // TODO change the categories
        $address_item=array(
            "id" => $row['id'],
            "guid" => $row['guid'],
            "name" => $row['name'],
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