<?php
/**
 * Created by PhpStorm.
 * User: Rafal Feliga
 * Date: 10/05/2019
 * Time: 08:26
 */

namespace App;

use PDO;
use PDOException;


class DBConnect
{
    private $host = "kcpgm0ka8vudfq76.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";//"localhost";
    private $db_name = "gywi124dzdj30f9p";//"fs_db";
    private $username = "ykid7cbr7mn38cbn";//"root";
    private $password = "y03rfmjfqheu6rmo";//"root";
    public $conn;


    public function _construct(){

        $this->table_exists('users');
        $this->table_exists('names');
        $this->table_exists('addresses');
        $this->table_exists('personal');
    }

    public function get_Connection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");

        }catch(PDOException $exception){
            $this->conn = "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    private function create_table ($table_name){
        switch($table_name) {
            case "users":
                $sql = "CREATE TABLE users (
                                id int(13) NOT NULL,
                                username varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                password varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                admin tinyint(1) NOT NULL DEFAULT 1)";
                break;
            case "names":
                $sql = "CREATE TABLE names (
                                id int(13) NOT NULL,
                                email varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                guid varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                isActive tinyint(1) NOT NULL DEFAULT 1,
                                registered varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL)";
            case "addresses":
                $sql = "CREATE TABLE addresses (
                                id int(13) NOT NULL,
                                guid varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                name varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                gender varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                company varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                phone varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                address varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                latitude decimal(13,10) NOT NULL,
                                longitude decimal(13,10) NOT NULL)";
                break;
            case "personal":
                $sql = "CREATE TABLE personal (
                                id int(13) NOT NULL,
                                guid varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                age int(3) NOT NULL,
                                eyeColor varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                about longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                picture varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                                balance decimal(13,2) NOT NULL
                                )";
        }
        $this->conn->prepare($sql)->execute();
    }

    private function table_exists($table_name){
        if($this->conn->query("select 1 from $table_name LIMIT 1") == FALSE)
        {
            $this->create_table($table_name);
        }
    }
}