<?php
/**
 * Created by PhpStorm.
 * User: Rafal Feliga
 * Date: 10/05/2019
 * Time: 13:17
 */

require 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./main.css" >

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title>Title</title>
    </head>
    <body>
        <div class="">
            <div class="row">
            <div class="form-group col">
                <form action="index.php">
                    <input type="text" name="guid" value="" placeholder="Find user using GUID" pattern="^[A-Za-z0-9]{8}-[A-Za-z0-9]{4}-[A-Za-z0-9]{4}-[A-Za-z0-9]{4}-[A-Za-z0-9]{12}$" required>
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="form-group col">
                <form action="index.php">
                    <input type="submit" value="View All">
                </form>
            </div>
            <div class="form-group col">
                <form action="index.php">
                    <input type="text" name="search" value="" placeholder="Search name, address and email">
                    <input type="submit" value="Search">
                </form>
            </div>
            </div>

            <div class="table-responsive" id="table-head">

            </div>

            <div class="container" id="userCard">

            </div>
        </div>
        <script src="src/scripts/script.js"></script>
    </body>
</html>


