<?php
/**
 * Created by PhpStorm.
 * User: Rafal Feliga
 * Date: 15/05/2019
 * Time: 12:50
 */

session_start();
if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true') {
    header('Location: src/login.php');
}