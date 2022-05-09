<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->
<?php
require_once "../DBconnect.php";

$stmt = $pdo->prepare("SELECT * FROM book b inner join book_category c on b.FK_book_category_id = c.category_id inner join publishing_house p on b.publishing_house_id = p.publishing_house_id inner join author a on b.author_id = a.author_id");
$stmt->execute();

?>
<div class="container-fluid">
    <?php
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        for ($i = 0; $i < count($row); $i++) {

            if ($i % 3 == 0) {
    ?>
    <div class="row">
                <?php
            }
                ?>

                <div class="col-md-4 col-xs-6 border-primary mb-3">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="card-header text-white bg-info">
                                    <p class="card-text">
                                    <h3 class="card-title">
                                        <?php echo $row[$i]["book_name"] ?>
                                    </h3>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="../book_cover/<?php echo $row[$i]["book_cover"]; ?>" alt="Image" width="100%" height="200px" />
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <p class="card-text"><b>Price: </b><?php echo $row[$i]["price"]; ?></p>
                                    <p class="card-text">
                                        <b>Auhtor: <?php echo $row[$i]["author_name"]. " " .$row[$i]["author_surname"]; ?>" </b>
                                    </p>
                                    <p class="card-text"><b>Category: </b><?php echo $row[$i]["category_name"]; ?></p>
                                    <p class="card-text"><b>Publishing Date: </b><?php echo $row[$i]["publishing_date"]; ?></p>
                                    <!-- <p class="card-text"><b>Publishing House: </b>@item.PublishingHouse</p> -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card-footer ">
                                    <p class="card-text">
                                        <a class="btn btn-outline-primary float-right" href="Details/id=@item.ISBN">
                                            <i class="bi bi-eye-fill"></i> Show Details
                                        </a>
                                        <!-- @Html.ActionLink("Show Details", "Details", new { id = item.ISBN }, new { @class = "btn btn-primary" })
                                        @Html.ActionLink("Add to Shopping Cart", "Add", "ShoppingCart", new { id = item.ISBN }, new { @class = "btn btn-success" }) -->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        if ($i % 3 == 2 ) {
            ?>
    </div>
            <?php

        }
        elseif ($i = count($row)-1) {
            ?>
    </div>
            <?php
        }
    }
?>
