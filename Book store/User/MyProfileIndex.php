<?php
session_start();
include "../DBconnect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profilePageUser.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="userScript.js"></script>
</head>

<body>
    <?php
    include "../userHeader.php";
    ?>
    <div class="container" style="padding-top: 20px; margin-top: 80px; width: 100%;">
        <div class="row">
            <div class="profile-nav col-md-3">
                <?php
                try {
                    $id = $_SESSION["user_id"];
                    $stmt = $pdo->prepare("SELECT * FROM person p inner join address a on p.address_id = a.address_id inner join city c on a.city = c.city_id where person_id = ?");
                    $stmt->execute(array($id));
                    $rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if ($rez != null) {
                ?>
                        <div class="user-heading">
                            <a href="#">
                                <img src="default.jpg" alt="">
                            </a>
                            <h1><?php echo $rez[0]["name"] . " " . $rez[0]["surname"] ?></h1>
                            <p><?php echo $rez[0]["email"] ?></p>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item active fa fa-user" id="profile-button"> Profile</li>
                            <li class="list-group-item fa fa-calendar" id="payments-button"> Payments History</li>
                            <li class="list-group-item fa fa-edit" id="edit-profile-button"> Edit Profile</li>
                        </ul>
            </div>
            <div class="col-md-9 content-div">
                <div class="heading">
                    <h1>My Profile</h1>
                </div>
                <div>
                    <h1>Bio</h1>
                    <hr>

                    <div class="row">
                        <div class="bio-row col">
                            <p><b>Name</b> </span>: <?php echo $rez[0]["name"] ?></p>
                        </div>
                        <div class="bio-row col">
                            <p><b>Surnname</b> </span>: <?php echo $rez[0]["surname"] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="bio-row col">
                            <p><b>Email</b> </span>: <?php echo $rez[0]["email"] ?></p>
                        </div>
                        <div class="bio-row col">
                            <p><b>Birthday</b></span>: <?php echo $rez[0]["birthday"] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="bio-row col">
                            <p><b>City</b> </span>: <?php echo $rez[0]["city_name"] ?></p>
                        </div>
                        <div class="bio-row col">
                            <p><b>Street</b> </span>: <?php echo $rez[0]["street_name"] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="bio-row col">
                            <p><b>Postal Code</b></span>: <?php echo $rez[0]["postal_code"] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <h1>Subscription</h1>
                        <hr>

                        <?php
                        $current_date = date("Y-m-d", time());
                        $stmt = $pdo->prepare("SELECT * from `user_subscription` where person_id = ? and subscription_finish_date > ? ");
                        $stmt->execute(array($id,$current_date));
                        $rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($rez) > 0) {
                        ?>
                        <div class="bio-row col">
                            <p><b>START</b> </span>: <?php echo date("j-F-Y",strtotime($rez[0]["subscription_start_date"])) ?></p>
                        </div>
                        <div class="bio-row col">
                            <p><b>END</b> </span>: <?php echo date("j-F-Y",strtotime($rez[0]["subscription_finish_date"])) ?></p>
                        </div>
                        <div class="bio-row col">
                            <p><b>PRICE</b> </span>: <?php echo $rez[0]["purchase_price"] ?>$</p>
                        </div>
                        <div class="bio-row col">
                            <p><b>AMOUNT OF SALE</b> </span>: <?php echo $rez[0]["amount_of_sale_at_purchase"] ?>%</p>
                        </div>
                        <?php
                        }
                        ?>
                    </div>



            <?php
                    }
                } catch (\Throwable $th) {
                }


            ?>

                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>