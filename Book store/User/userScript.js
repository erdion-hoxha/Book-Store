$(document).ready(function () {

    $("#Search").on("keyup", function () {
        debugger;
        var search = $("#Search").val();
        var searchCategory = $("#SearchCategory :selected").text();
        //var data = {
        //    Search = search,
        //    SearchCaegory = searchCategory
        //}
        var data = $("#search-form").serializeArray();
        console.log(data);
        var tmp = data.find(function (input) {
            return input.name == 'SearchCategory';
        }).value = searchCategory;
        tmp = searchCategory;
        console.log(data);
        $.ajax({
            type: "GET",
            /*contentType: "application/json; charset=utf-8",*/
            url: "bokIndex.php",
            data: data,
            contentType: "application/json; charset=utf-8",
            success: function (content) {
                debugger;
                console.log("brenda success");
                $("#display-div").html(content);
            }
        });
    });
    $("#payments-button").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "myPayments.php",
            success: function (response) {
                $(".list-group li").removeClass("active");
                $("#payments-button").addClass("active");
                $(".content-div").html(response);
            }
        });
        
    });
    $("#profile-button").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "myProfile.php",
            success: function (response) {
                $(".list-group li").removeClass("active");
                $("#profile-button").addClass("active");
                $(".content-div").html(response);
            }
        });
    });
    $("#edit-profile-button").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "myProfile.php",
            success: function (response) {
                $(".list-group li").removeClass("active");
                $("#profile-button").addClass("active");
                $(".content-div").html(response);
            }
        });
    });

    $(document).on("click", ".add", function (e) {
        alert("test");
        debugger;
        e.preventDefault();
        var siblings = $(this).children("i")
        var isbn = siblings.attr("data-ISBN");
        var price = siblings.attr("data-price");
        console.log(isbn);
        var data = {
            isbn: isbn,
            price: price
        };
        $.ajax({
            type: "GET",
            url: "bookAddToShoppingCart.php",
            data: data,
            contentType: "application/json; charset=utf-8",
            success: function (response) {
                debugger;
                var rez = JSON.parse(response);

                console.log(response.Message);
                console.log(response.Return);
                if (rez.Return) {
                    swal({
                        title: "Shoppin Cart Add",
                        text: rez.Message,
                        icon: "success",
                      });
                }
                else{
                    swal({
                        title: "Shoppin Cart Add",
                        text: rez.Message,
                        icon: "error",
                      });
                }
                window.location.reload();
            }
        });

    });
    $(document).on("click", ".details", function (e) {
        alert("test");
        debugger;
        e.preventDefault();
        var siblings = $(this).children("i")
        var isbn = siblings.attr("data-ISBN");
        console.log(isbn);
        var data = {
            isbn: isbn,
        };
        $.ajax({
            type: "GET",
            url: "bookShowDetails.php",
            data: data,
            contentType: "application/json; charset=utf-8",
            success: function (response) {
                debugger;
                var rez = JSON.parse(response);

                console.log(rez.Message);
                console.log(rez.Return);
                if (rez.Return) {
                    swal({
                        title: "Shoppin Cart Add",
                        text: rez.Message,
                        icon: "success",
                      });
                }
                else{
                    swal({
                        title: "Shoppin Cart Add",
                        text: rez.Message,
                        icon: "error",
                      });
                }
                window.location.reload();
            }
        });

    });

    $(".prove").click(function (e) {
        debugger;
        $("#myModal").modal("show");
        var bookFile = $(this).attr("data-file");
        var path = "../book_file/" + bookFile
        $("#_Iframe").attr("src", path);
        console.log($("#_Iframe").attr("src"));
    });
    $(document).on("click", ".buySubscription", function (e) {
        alert("test");
        debugger;
        e.preventDefault();
        var siblings = $(this).children("i")
        var isbn = siblings.attr("data-id");
        var price = siblings.attr("data-price");
        var type = siblings.attr("data-subscription-type");
        var sale = siblings.attr("data-sale");
        console.log(isbn);
        var data = {
            id: isbn,
            price: price,
            type: type,
            sale: sale
        };
        $.ajax({
            type: "GET",
            url: "buySubscriptions.php",
            data: data,
            contentType: "application/json; charset=utf-8",
            success: function (response) {
                debugger;
                var rez = JSON.parse(response);
                console.log(rez.Message);
                console.log(rez.Return);
                if (rez.Return) {
                    swal({
                        title: "Shoppin Cart Add",
                        text: rez.Message,
                        icon: "success",
                      });
                }
                else{
                    swal({
                        title: "Shoppin Cart Add",
                        text: rez.Message,
                        icon: "error",
                      });
                }
                // window.location.reload();
            }
        });

    });

});