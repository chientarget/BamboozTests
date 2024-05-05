<link rel="stylesheet" href="./assets/css/style_Tracuu.css">

<div class="container container-Tracuu ">
    <div class="row">
        <div class="body-Tracuu col-md-10">
            <div class="row header-inner-pages"><b>Tra cứu</b></div>
            <div class="row pb-5">
                <div class="col-md-5">
                    <form class="form-inline ">
                        <div class="input-group ">
                            <input id="flightNumber" class="form-control" type="text" placeholder="Số chuyến bay"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button id="searchButton" class="btn btn-outline-success">Search</button>
                            </div>
                        </div>
                        <p class="error-message"></p>
                    </form>
                </div>
                <div class="col-md"></div>
                <div class="col-md-4">
                    <b class="label-kh">
                        <div id="customerName" class="col-md"></div>
                    </b>
                </div>
            </div>
            <div class="row content">
                <div class="row flight-id">
                    <div class="col-md-2">Flight ID</div>
                    <div id="flightId" class="col-md"></div>
                    <div class="col-md-2">Seat Number</div>
                    <div id="seatNumber" class="col-md"></div>

                </div>

                <div class="row departure-time">
                    <div class="col-md-2">Departure Time</div>
                    <div id="departureTime" class="col-md"></div>
                    <div class="col-md-2">Arrival Time</div>
                    <div id="arrivalTime" class="col-md"></div>
                </div>

                <div class="row available-seats">
                    <div class="col-md-2">Available Seats</div>
                    <div id="availableSeats" class="col-md"></div>
                    <div class="col-md-2">Total Seats</div>
                    <div id="totalSeats" class="col-md"></div>
                </div>

                <div class="row customer-email">
                    <div class="col-md-2">Customer Email</div>
                    <div id="customerEmail" class="col-md"></div>
                    <div class="col-md-2">City</div>
                    <div id="city" class="col-md"></div>
                </div>

                <div class="row city">
                    <div class="col-md-2">Country</div>
                    <div id="country" class="col-md"></div>
                    <div class="col-md-2">Airfield</div>
                    <div id="airfield" class="col-md"></div>
                </div>

                <div class="row seat-class">
                    <div class="col-md-2">Seat Class</div>
                    <div id="seatClass" class="col-md"></div>
                    <div class="col-md-2">Amount</div>
                    <div id="amount" class="col-md"></div>
                </div>
            </div>


        </div>
    </div>
    <img src="./assets/img/bg-3.svg" alt="Góc phải dưới" class="corner-image" width="30%">
</div>

<script>
    document.getElementById('searchButton').addEventListener('click', function (event) {
        event.preventDefault();
        var flightNumber = document.getElementById('flightNumber').value;
        fetch('../service/get_flight_info.php?flightNumber=' + flightNumber)
            .then(response => response.json())
            .then(data => {
                // Display the flight information in the HTML
                document.getElementById('flightId').innerText = data.flight_id;
                document.getElementById('departureTime').innerText = data.departureTime;
                document.getElementById('arrivalTime').innerText = data.arrivalTime;
                document.getElementById('availableSeats').innerText = data.availableSeats;
                document.getElementById('totalSeats').innerText = data.totalSeats;
                document.getElementById('customerName').innerText = data.fullName;
                document.getElementById('customerEmail').innerText = data.email;
                document.getElementById('city').innerText = data.city;
                document.getElementById('country').innerText = data.country;
                document.getElementById('airfield').innerText = data.airfield;
                document.getElementById('seatClass').innerText = data.seat_clazz;
                document.getElementById('amount').innerText = data.amount;
                document.getElementById('seatNumber').innerText = data.seatNumber;
            });
    });
</script>