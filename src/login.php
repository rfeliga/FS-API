<?php
/**
 * Created by PhpStorm.
 * User: Rafal Feliga
 * Date: 15/05/2019
 * Time: 12:00
 */

require_once '../vendor/autoload.php';

use App\DBConnect;

$username = null;
$password = null;

$dbConn = new DBConnect();
$dbConn->get_Connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = $dbConn->conn->prepare("SELECT u.id FROM users as u WHERE username = ? and password = PASSWORD(?)");
        $query->bindParam(1, $username);
        $query->bindParam(2, $password);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        echo "ID";
        echo $row;

        if(!empty($row['id'])) {
            session_start();
            $_SESSION["authenticated"] = 'true';
            header('Location: ../index.php');
        }
        else {
            header('Location: login.php');
        }

    } else {
        header('Location: login.php');
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Simple Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <div id="page">
        <header id="banner">
                <h1>Login</h1>
        </header>
        <section id="content">
            <form id="login" method="post">
                <label for="username">Username:</label>
                <input id="username" name="username" type="text" required>
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" required>
                <br />
                <input type="submit" value="Login">
            </form>
        </section>
    </div>
    </body>
    </html>
<?php } ?>