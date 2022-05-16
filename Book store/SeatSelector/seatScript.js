// const container = document.querySelector('.container');
// const seats = document.querySelectorAll('.row .seat:not(.occupied');
// const count = document.getElementById('count');
// const total = document.getElementById('total');
// const movieSelect = document.getElementById('movie');

// populateUI();
// let ticketPrice = +movieSelect.value;

// // Save selected movie index and price
// function setMovieData(movieIndex, moviePrice) {
//     localStorage.setItem('selectedMovieIndex', movieIndex);
//     localStorage.setItem('selectedMoviePrice', moviePrice);
// }

// // update total and count
// function updateSelectedCount() {
//     const selectedSeats = document.querySelectorAll('.row .seat.selected');

//     const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

//     localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

//     //copy selected seats into arr
//     // map through array
//     //return new array of indexes

//     const selectedSeatsCount = selectedSeats.length;

//     count.innerText = selectedSeatsCount;
//     total.innerText = selectedSeatsCount * ticketPrice;
// }

// // get data from localstorage and populate ui
// function populateUI() {
//     const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));
//     if (selectedSeats !== null && selectedSeats.length > 0) {
//         seats.forEach((seat, index) => {
//             if (selectedSeats.indexOf(index) > -1) {
//                 seat.classList.add('selected');
//             }
//         });
//     }

//     const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

//     if (selectedMovieIndex !== null) {
//         movieSelect.selectedIndex = selectedMovieIndex;
//     }
// }

// // Movie select event
// movieSelect.addEventListener('change', (e) => {
//     ticketPrice = +e.target.value;
//     setMovieData(e.target.selectedIndex, e.target.value);
//     updateSelectedCount();
// });

// // Seat click event
// container.addEventListener('click', (e) => {
//     if (e.target.classList.contains('seat') && !e.target.classList.contains('occupied')) {
//         e.target.classList.toggle('selected');

//         updateSelectedCount();
//     }
// });

// // intial count and total
// updateSelectedCount();

$(document).ready(function () {
    sessionStorage.setItem("numberOfSelection", 0);
    $("#reserve-button").on("click", function (e) {
        e.preventDefault();
        // debugger;
        //kontrolli elementet e formes nese jane te sakta
        //nese true => bej rezervimin ne database pasi e ke kontrolluar qe eshte akoma e lire ne ate orar
        // else => bej alert qe eshte e zene ose errorin perkates
        var start = $("#start").val();
        var end = $("#end").val();
        var data = $("#form").serializeArray();
        var id = {
            name: "id",
            value: sessionStorage.getItem("seat_id")
        };
        // data.push({name:"id",value: sessionStorage.getItem("seat_id")});
        data.push(id);
        console.log(data);
        if ((start > 8 && start <= 18) && (end > 9 || end <= 19)) {
            $.ajax({
                type: "POST",
                url: "makeReservation.php",
                data: data,
                success: function (response) {
                    debugger;
                    //kontrollo nese kemi sukses ose jo
                    //nese true => atehere fshije nga session storeage karrigen
                    var rez = JSON.parse(response);
                    if (rez.Return) {
                        alert(rez.Message);
                        $("#" + sessionStorage.getItem("seat_id")).removeClass("selected");
                        sessionStorage.setItem("numberOfSelection", 0);
                        sessionStorage.setItem("seat_id", "");
                    } else {
                        alert(rez.Message);
                    }
                }
            });
        } else {
            alert("Keni kaluar afatin e rezervimit");
        }





    });
    setInterval(function () {
        // var start = $("start-time").val();
        // var end = $("end-time").val();
        // console.log(start);
        // console.log(end);
        // var data = {
        //     start: start,
        //     end: end
        // };

        var start = $("#start").val();
        var end = $("#end").val();
        debugger;
        if ((start > 8 && start <= 18) && (end > 9 || end <= 19)) {
            var data = $("#form").serialize();
            $.ajax({
                type: "GET",
                url: 'pageRefresh-v2.php',
                data: data,
                success: function (response) {
                    // debugger;
                    var rez = JSON.parse(response);
                    var data = rez.Data;
                    var current_occupied_data = $("div.occupied");
                    for (let i = 1; i < current_occupied_data.length; i++) {

                        //check nese id eshte null ose jo para se te kryesh veprimet
                        var element = current_occupied_data[i];
                        var id = $(element).prop("id");
                        if (data.indexOf(id) == -1) {
                            $("#" + id).removeClass("occupied");
                        }
                    }
                    // current_occupied_data.forEach(element => {
                    //     var id = $(element).attr("id");
                    //     console.log(id);
                    //     if (data.indexOf(id) == -1) {
                    //         $(id).removeClass("occupied");
                    //     }
                    // });
                    for (let i = 0; i < data.length; i++) {
                        var element = data[i];
                        $("#" + element).addClass("occupied");
                    }
                    // data.forEach(element => {
                    //     $("#" + element).addClass("occupied");
                    // });
                    // $(".container").html(response);
                    console.log("brenda");
                    // debugger;
                    if (sessionStorage.getItem("seat_id") != "") {

                        var id = sessionStorage.getItem("seat_id");
                        console.log(id);
                        $("#" + id).addClass("selected");
                    } else {}
                    // $(".container #20").addClass("selected");
                }
            });
        }

    }, 1000);
    // $("$start-time").on("keyup", function () {

    // });
    // $("$end-time").on("keyup", function () {

    // });
});
$(document).on("click", ".seat", function (e) {
    debugger;
    e.preventDefault();
    console.log($(this).val());
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected");
        sessionStorage.setItem("numberOfSelection", 0);
        sessionStorage.setItem("seat_id", "");
    } else if (sessionStorage.getItem("numberOfSelection") == 1) {
        alert("Mund te selektoni te shumten nje karrige")
    } else {
        $(this).addClass("selected");
        sessionStorage.setItem("numberOfSelection", 1);
        console.log("Id e seat eshte: " + $(this).attr("id"));
        sessionStorage.setItem("seat_id", $(this).attr("id"));
    }

});


var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();
$(document).on("keyup", ".time-element", function () {
    delay(function () {
        var start = $("#start").val();
        var end = $("#end").val();
        var current_time = new Date().getHours();
        if (current_time >= 18) {
            alert("Libraria eshte mbyllur per sot.Ju lutem hajdeni nseser perseri");
        } else if (start <= current_time) {
            alert("Mund te rezervoni orare ne te ardhmen jo te shkuaren.");
        } else if (end > 19) {
            alert("Libraria eshte hapur deri ne oren 19:00 per rezervime vendesh.");
        } else if (end <= current_time + 1) {
            alert("Koha e mbarimit duhet te jete me e madhe se koha e tanishme.");
        } else {
            localStorage.setItem("timeCheck", true);
        }
    }, 2000);
});