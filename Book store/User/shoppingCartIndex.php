<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="shoppingCartScript.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Document</title>
    <style>
        td img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        td,tr,button{
            font-size: 25px;
        }
    </style>
</head>

<body>
<?php
    include "../userHeader.php";
    ?>
    <br>
 

    <div class="container" style="margin-top: 120px; margin-bottom: 120px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); ">
        <?php
        include "shoppingCart.php";
        ?>
    </div>
</body>

</html>