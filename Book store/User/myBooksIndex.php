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
    <script src="userScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>

<body>
    <br>
    <br>
    <div class="row" style="margin-left: 100px;">
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
            <label class="sr-only" for="Search">Username</label>

            <input type="text" class="col-md-2" id="Search" name="Search" placeholder="Username" />
        </form>
    </div>
    <hr>

    <div id="display-div">
        <?php
        include("myBooks.php");
        ?>  
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width: 100%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="width: 100%;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Lexo Librin</h4>
                </div>
                <div class="modal-body" style="width: 100%;">
                    <iframe id="_Iframe" src="" width="100%" height="700px" frameborder="0" allowtransparency="true"></iframe>
                </div>
                <div class="modal-footer"style="width: 100%;" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</body>

</html>