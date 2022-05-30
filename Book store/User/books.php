<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="userScript.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    include "../userHeader.php";
    ?>
    <br>
    <br>
    <div class="row" style="margin-left: 10%; margin-top:5%;">
        <form class="" id="search-form">
            <label for="SearchCategory">Search by</label>
            <select class="col-md-1" data-live-search="true" aria-label="Default select example" name="SearchCategory" id="SearchCategory" style="margin-left: 10px;">
                <?php
                $tmp;
                if ($tmp == "Title") {
                ?><option value="Title" selected>Title</option>
                <?php
                } else {
                ?><option value="Title">Title</option>

                <?php
                }
                if ($tmp == "Author") {
                ?><option value="Author" selected>Author</option>

                <?php
                } else {
                ?><option value="Title">Author</option>
                <?php
                }
                if ($tmp == "PubishingHouse") {
                ?><option value="PubishingHouse" selected>Pubishing House</option>
                <?php
                } else {
                ?><option value="Title">Publishing House</option>
                <?php
                }
                ?>
            </select>
            <input type="text" class="col-md-2" id="Search" name="Search" />
        </form>
    </div>
    <hr>

    <div id="display-div">
        <?php
        include("bokIndex.php");
        ?>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:100%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ISBN</label>
                        <input type="number" id="id_e" name="id" class="form-control" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>
                    <div class="form-group">
                        <label>BOOK NAME</label>
                        <input type="text" id="title_e" name="title" class="form-control" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>
                    <div class="form-group">
                        <label>PRICE</label>
                        <input type="number" id="price_e" name="price" class="form-control" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>
                    <div class="form-group">
                        <label>AUTHOR FULLNAME</label>
                        <select name="author_fullname" id="author_fullname_e" class="form-select form-select-lg" required>
                            <?php

                            $stmt = $pdo->prepare("Select * from author");
                            $stmt->execute();
                            $i = 0;
                            //vendos id direkte tek option jo emri
                            while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                for ($i = 0; $i < count($row); $i++) {
                            ?>
                                    <option value="<?php echo $row[$i]["author_name"] . " " . $row[$i]["author_surname"] ?>"> <?php echo $row[$i]["author_name"] . " " . $row[$i]["author_surname"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                        <!-- <input type="text" id="author_fullname" name="author_fullname" class="form-control" placeholder="Author Fullname" required> -->
                    </div>
                    <div class="form-group">
                        <label>QUNATITY</label>
                        <input type="number" id="quantity_e" name="quantity" class="form-control" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>
                    <div class="form-group">
                        <label>PUBLISHING DATE</label>
                        <input type="number" id="date_e" name="date" class="form-control" step="1" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>
                    <div class="form-group">
                        <label>DESCRIPTION</label>
                        <input type="text" id="description_e" name="description" class="form-control" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>

                    <div class="form-group">
                        <label>PUBLISHING HOUSE</label>
                        <select name="publishing_house" id="publishing_house_e" class="form-select form-select-lg" required>
                            <?php

                            $stmt = $pdo->prepare("Select * from publishing_house");
                            $stmt->execute();
                            $i = 0;
                            while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                for ($i = 0; $i < count($row); $i++) {
                                    // if ($row[$i]["name"] == $("tr #")) {
                                    //     # code...
                                    // }
                            ?>
                                    <option value="<?php echo $row[$i]["name"] ?>"> <?php echo $row[$i]["name"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                        <!-- <input type="text" id="publishing_house_e" name="publishing_house" class="form-control" required> -->
                    </div>
                    <div class="form-group">
                        <label>CATEGORY</label>
                        <select name="category" id="category_e" class="form-select form-select-lg" required>
                            <?php

                            $stmt = $pdo->prepare("Select * from book_category");
                            $stmt->execute();
                            $i = 0;
                            while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                for ($i = 0; $i < count($row); $i++) {
                            ?>
                                    <option value="<?php echo $row[$i]["category_name"] ?>"> <?php echo $row[$i]["category_name"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                        <!-- <input type="text" id="category_e" name="category" class="form-control" required> -->
                    </div>
                    <div class="form-group">
                        <label> BOOK COVER</label>
                        <input type="file" id="book_cover_e" name="book_cover" class="form-control" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>
                    <div class="form-group">
                        <label>BOOK FILE</label>
                        <input type="file" id="book_file_e" name="book_file" class="form-control" required>
                        <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</body>

</html>