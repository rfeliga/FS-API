<?php
/**
 * Created by PhpStorm.
 * User: Rafal Feliga
 * Date: 10/05/2019
 * Time: 09:19
 */

namespace App;

use PDO;

class Address
{
    public $conn;
    public $table_name = "addresses";
    private $names_table = "names";
    private $personal_table = "personal";

    public $id;
    public $guid;
    public $name;//
    public $gender;//
    public $company;//
    public $phone;//
    public $address;//
    public $latitude;
    public $longitude;
    public $picture;//
    public $age;//
    public $eyeColor;//
    public $about;//
    public $email;//
    public $balance;
    public $isActive;//
    Public $registered;//

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    // read products
    function read(){

        // select all
        $query = "SELECT a.id, a.guid, a.name, n.email, n.isActive FROM $this->table_name as a INNER JOIN $this->names_table as n ON n.guid = a.guid";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function search_term(string $search_term){

        // select search term
        $search_term = "%$search_term%";

        $query = "SELECT a.id, a.guid, a.name, n.email, n.isActive FROM $this->table_name as a INNER JOIN $this->names_table as n ON n.guid = a.guid WHERE a.name like :name or a.address like :address or n.email like :email";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $search_term);
        $stmt->bindParam(':address', $search_term);
        $stmt->bindParam(':email', $search_term);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readOne(){

        $query = "SELECT a.*, n.email, n.isActive, n.registered, p.age, p.eyeColor, p.about, p.picture, p.balance 
                    FROM $this->table_name as a 
                    INNER JOIN $this->names_table as n ON a.guid = n.guid
                    INNER JOIN $this->personal_table as p on p.guid = n.guid
                    WHERE a.guid = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->guid);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['id'] !== null) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->gender = $row['gender'];
            $this->company = $row['company'];
            $this->phone = $row['phone'];
            $this->address = $row['address'];
            $this->latitude = $row['latitude'];
            $this->longitude = $row['longitude'];
            $this->picture = $row['picture'];
            $this->age = $row['age'];
            $this->eyeColor = $row['eyeColor'];
            $this->about = $row['about'];
            $this->email = $row['email'];
            $this->balance = $row['balance'];
            $this->isActive = $row['isActive'];
            $this->registered = $row['registered'];

        } else {
            $this->guid = null;
        }

    }
}