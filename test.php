<?php
include('header.php');
?>

<style>
    #form-2 .col-1 {
    
    width: 40%;
}
#form-2 .col-3 {
   
    width: 20%;
}
.form-control.input.datepicker {
    
    border-right: 1px solid #999;
}
</style>
 <div class="upper-page bg-dark" id="home">
        <!-- hero bg start -->
        <div class="hero-fullscreen">
            <div class="hero-fullscreen-FIX">
                <div class="hero-bg">
                    <!-- hero slider wrapper start -->
                    <div class="swiper-container-wrapper">
                        <!-- swiper container start -->
                        <div class="swiper-container swiper2">
                            <!-- swiper wrapper start -->
                            <div class="swiper-wrapper">
                                <!-- swiper slider item start -->
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner">
                                        <!-- swiper slider item IMG start -->
                                        <div class="swiper-slide-inner-bg rooms-bg overlay overlay-dark">
                                        </div>
                                        <!-- swiper slider item IMG end -->
                                        <!-- swiper slider item txt start -->
                                        <div class="swiper-slide-inner-txt-2">
                                            <!-- section subtitle start -->
                                            <div class="star-wrapper fadeIn-element">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                            </div>
                                            <!-- section subtitle end -->
                                            <!-- divider start -->
                                            <div class="divider-m"></div>
                                            <!-- divider end -->
                                            <!-- section title start -->
                                            <h1 class="hero-heading hero-heading-home fadeIn-element">
                                                Rooms &amp; Suites
                                            </h1>
                                            <!-- section title end -->
                                            <!-- divider start -->
                                            <div class="divider-m"></div>
                                            <!-- divider end -->
                                        </div>
                                        <!-- swiper slider item txt end -->
                                    </div>
                                </div>
                                <!-- swiper slider item end -->
                            </div>
                            <!-- swiper wrapper end -->   
                        </div>
                        <!-- swiper container end -->
                    </div>
                    <!-- hero slider wrapper end -->
                </div>
            </div>
        </div>
        <!-- hero bg end -->
        <!-- scroll indicator start -->
        <div class="scroll-indicator">
            <div class="scroll-indicator-wrapper">
                <div class="scroll-line fadeIn-element"></div>
            </div>
        </div>
        <!-- scroll indicator end -->
    </div>
    <div class="container">
    
     <div class="col-lg-12">
                            <!-- divider start -->
                            <div class="divider-l"></div>
                            <!-- divider end -->
                            <!-- line start -->
                            <div class="the-line"></div>
                            <!-- line end -->
                            <!-- divider start -->
                            <div class="divider-l"></div>
                            <!-- divider end -->
                        </div>
    
          <div class="col-lg-12">
        <form action="#" id="form-2" class="form-2" method="post" name="send">
            <div class="col-1 c-1">
                <div class="input-wrapper">
                    <label>Check-In</label>
                    <div class="input-inner">
                        <input class="requiredField-r checkin form-control input datepicker" id="checkin" name="checkin" placeholder="Check-In" type="text" readonly>
                    </div>
                </div>
            </div>
            <div class="col-1 c-2">
                <div class="input-wrapper">
                    <label>Check-Out</label>
                    <div class="input-inner">
                        <input class="requiredField-r checkout form-control input datepicker" id="checkout" name="checkout" placeholder="Check-Out" type="text" readonly>
                    </div>
                </div>
            </div>
            <div class="col-3 c-6">
                <button type="button" onclick="remove_room();check_available();" class="reservation-button">Check Availability</button>
            </div>
        </form>
    </div> 
    
    
    
    
    <div class="row">
        <div class="col-lg-12">
            <!-- divider start -->
            <div class="divider-l"></div>
            <!-- divider end -->
            <!-- divider start -->
            <div class="divider-l"></div>
            <!-- divider end -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 card">
           
                <div class="col-md-4">
                    <img src="img/21.png" alt="Room Image">
                </div>
                <div class="col-md-8">
                    <div class="divider-l"></div>
                    <h4>Deluxe Room without balcony (Partial View) Only</h4>
                    <div class="divider-l"></div>
                    <div class="row">
                        <div class="col-md-8">
                            <p>Room Capacity: 2 <i class="ion-ios-person"></i> 2 <i class="ion-ios-person"></i></p>
                            <p>Room Rates Inclusive of Tax</p>
                        </div>
                        <div class="col-md-4">
                            <p>Rs 4,590.88 <i class="fa fa-info-circle"></i></p>
                            <span class="pere">Price for 1 Night</span><br>
                            <span class="pere">2 Adults, 0 Child, 1 Room</span>
                            <div class="compare-container">
                                <label>
                                    <input type="checkbox" name="compare">
                                </label>
                                <span class="compare-text">Add To Compare</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="roomr">
                                <li><span>Room Info</span></li>
                                <li class="enf"><span>Enquire</span></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="roomr">
                                <li><span>7 Rooms Left</span></li>
                                <li class="enf"><a class="btn">Add room</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            
        </div>
        <div class="col-md-3 card1">
            <div class="card-title">
                <h4>Booking Summary</h4>
            </div> <div class="divider-l"></div>
            <div class="card-body">
                <p class="pereq"><b>Dates:</b> 07/08/2024 - 08/08/2024</p><hr>
                <p class="pereq"><b>Night:</b> 1</p>
               <div class="divider-l"></div>
               <a class="btn">Book</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- divider start -->
            <div class="divider-l"></div>
            <!-- divider end -->
            <!-- divider start -->
            <div class="divider-l"></div>
            <!-- divider end -->
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
<script>
  $(function() {
    var today = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);

    $("#checkin").datepicker({
      minDate: today,
      dateFormat: 'yy-mm-dd',
      defaultDate: today,
      onSelect: function(selectedDate) {
        var checkinDate = new Date(selectedDate);
        checkinDate.setDate(checkinDate.getDate() + 1);
        $("#checkout").datepicker("option", "minDate", checkinDate);
        $("#checkout").datepicker("setDate", checkinDate);
      }
    }).datepicker("setDate", today);

    $("#checkout").datepicker({
        minDate: tomorrow,
        dateFormat: 'yy-mm-dd',
        defaultDate: tomorrow
    }).datepicker("setDate", tomorrow);
  });
</script>


<script>
    $(document).ready(function(){
        remove_room();
        check_available();
        load_cart();
    });
    function check_available(){
        checkin = $('#checkin').val();
        checkout = $('#checkout').val();
        var xhttp;
        if (checkin == "" || checkout == "") {
            alert("Please select both check-in and check-out dates.");
            return;
        }
       /* var checkinDate = new Date(checkin);
        var checkoutDate = new Date(checkout);
        var currentDate = new Date();
        if (checkinDate >= currentDate) {
            alert("Check-in date must be in the future.");
            return;
        }
        if (checkoutDate <= checkinDate) {
            alert("Check-out date must be after the check-in date.");
            return;
        }*/
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("available_rooms").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "server/rooms-available.php?checkin="+checkin+"&checkout="+checkout, true);
        xhttp.send();
    }
</script>

<script>
    function add_to_cart(room_id,add_room){
        checkin = $('#checkin').val();
        checkout = $('#checkout').val();
        var xhttp;
        if(room_id =="" || add_room ==""){
            alert("Invalid selection.");
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    check_available();
                    load_cart();
                } else {
                    alert(response.message);
                }
            }
        };
        xhttp.open("GET", "server/add-to-cart.php?room_id="+room_id+"&add_room="+add_room+"&checkin="+checkin+"&checkout="+checkout, true);
        xhttp.send();
    }
    
    function load_cart(){
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("booking_summary").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "server/load-cart.php", true);
        xhttp.send();
    }
    
    
    function remove_room(room_id){
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                check_available();
                load_cart();
            }
        };
        xhttp.open("GET", "server/remove-from-cart.php?room_id="+room_id, true);
        xhttp.send();
    }
    
    function update_cart(cart_id) {
        const form = document.querySelector(`#cart_form_${cart_id}`);
        const adults = form.querySelector("[name='cart_adults']").value;
        const children = form.querySelector("[name='cart_childs']").value;
        let childAges = [];
        for (let i = 1; i <= children; i++) {
            let ageSelect = form.querySelector(`[name='child_age_${i}']`);
            if(ageSelect){
                childAges.push(ageSelect.value);
            }
        }
        let queryString = `cart_id=${cart_id}&adults=${adults}&children=${children}&childs_details=${childAges}`;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                check_available();
                load_cart();
            }
        };
        xhttp.open("GET", "server/update-cart.php?" + queryString, true);
        xhttp.send();
    }

</script>

