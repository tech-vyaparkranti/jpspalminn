<?php
    include('header.php');
    $guest_checkin = $_POST['checkin'] ?? '';
    $guest_checkout = $_POST['checkout'] ?? '';
?>
<!-- Include jQuery and jQuery UI if not already in header.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<style>
    #form-2 {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: flex-end;
        margin-top: 30px;
    }

    #form-2 .col-1,
    #form-2 .col-3 {
        flex: 1 1 auto;
        min-width: 180px;
    }

    .form-control.input.datepicker {
        border-right: 1px solid #999;
    }

    select {
        width: auto;
    }
</style>

<div class="upper-page bg-dark" id="home">
    <!-- hero bg start -->
    <div class="hero-fullscreen">
        <div class="hero-fullscreen-FIX">
            <div class="hero-bg">
                <div class="swiper-container-wrapper">
                    <div class="swiper-container swiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="swiper-slide-inner">
                                    <div class="swiper-slide-inner-bg rooms-bg overlay overlay-dark"></div>
                                    <div class="swiper-slide-inner-txt-2">
                                        <div class="star-wrapper fadeIn-element">
                                            <span class="ion-ios-star"></span>
                                            <span class="ion-ios-star"></span>
                                            <span class="ion-ios-star"></span>
                                            <span class="ion-ios-star"></span>
                                            <span class="ion-ios-star"></span>
                                        </div>
                                        <div class="divider-m"></div>
                                        <h1 class="hero-heading hero-heading-home fadeIn-element">Rooms &amp; Suites</h1>
                                        <div class="divider-m"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero bg end -->

    <div class="scroll-indicator">
        <div class="scroll-indicator-wrapper">
            <div class="scroll-line fadeIn-element"></div>
        </div>
    </div>
</div>

<div class="vertical-lines-wrapper">
    <div class="vertical-lines"></div>
</div>

<!-- Check-in Form Section -->
<div class="container">
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

<br><br><br><br>

<!-- Room Results -->
<div class="container">
    <div class="row">
        <div class="col-md-9 card" id="available_rooms"></div>
        <div class="col-md-3 card1" id="booking_summary"></div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
  $(function () {
    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);

    let guest_checkin = "<?= $guest_checkin ?>";
    let guest_checkout = "<?= $guest_checkout ?>";

    let guest_select_in = guest_checkin !== "" ? guest_checkin : $.datepicker.formatDate('yy-mm-dd', today);
    let guest_select_out = guest_checkout !== "" ? guest_checkout : $.datepicker.formatDate('yy-mm-dd', tomorrow);

    $("#checkin").datepicker({
      minDate: today,
      dateFormat: 'yy-mm-dd',
      defaultDate: guest_select_in,
      onSelect: function (selectedDate) {
        const checkinDate = new Date(selectedDate);
        checkinDate.setDate(checkinDate.getDate() + 1);
        $("#checkout").datepicker("option", "minDate", checkinDate);
        $("#checkout").datepicker("setDate", checkinDate);
      }
    }).datepicker("setDate", guest_select_in);

    $("#checkout").datepicker({
      minDate: guest_select_out,
      dateFormat: 'yy-mm-dd',
      defaultDate: guest_select_out
    }).datepicker("setDate", guest_select_out);
  });

  $(document).ready(function () {
    remove_room();
    check_available();
    load_cart();
  });

  function check_available() {
    const checkin = $('#checkin').val();
    const checkout = $('#checkout').val();
    if (!checkin || !checkout) {
      alert("Please select both check-in and check-out dates.");
      return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("available_rooms").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "server/rooms-available.php?checkin=" + checkin + "&checkout=" + checkout, true);
    xhttp.send();
  }

  function add_to_cart(room_id, add_room) {
    const checkin = $('#checkin').val();
    const checkout = $('#checkout').val();
    if (!room_id || !add_room) {
      alert("Invalid selection.");
      return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        try {
          const response = JSON.parse(this.responseText);
          if (response.success) {
            check_available();
            load_cart();
          } else {
            alert(response.message);
          }
        } catch (e) {
          console.error("Invalid JSON:", this.responseText);
        }
      }
    };
    xhttp.open("GET", `server/add-to-cart.php?room_id=${room_id}&add_room=${add_room}&checkin=${checkin}&checkout=${checkout}`, true);
    xhttp.send();
  }

  function load_cart() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("booking_summary").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "server/load-cart.php", true);
    xhttp.send();
  }

  function remove_room(room_id = "") {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        check_available();
        load_cart();
      }
    };
    xhttp.open("GET", "server/remove-from-cart.php?room_id=" + room_id, true);
    xhttp.send();
  }

  function update_cart(cart_id) {
    const form = document.querySelector(`#cart_form_${cart_id}`);
    const adults = form.querySelector("[name='cart_adults']").value;
    const children = form.querySelector("[name='cart_childs']").value;
    let childAges = [];
    for (let i = 1; i <= children; i++) {
      const ageSelect = form.querySelector(`[name='child_age_${i}']`);
      if (ageSelect) childAges.push(ageSelect.value);
    }
    const queryString = `cart_id=${cart_id}&adults=${adults}&children=${children}&childs_details=${childAges}`;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        check_available();
        load_cart();
      }
    };
    xhttp.open("GET", "server/update-cart.php?" + queryString, true);
    xhttp.send();
  }
</script>
