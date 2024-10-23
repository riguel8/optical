@include('template.client.header')

    @include('template.client.navbar')
    @include('template.client.sidebar')

    <div class="container mt-5">
    <div class="row">
        <!-- Left side: Calendar and time slots -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Branches</h5>
                    <select id="branch" class="form-control">
                        <option>EO Alta Citta</option>
                    </select>
                    <div class="mt-3">
                        <h6>Address</h6>
                        <p id="branch-address">Lower Ground Floor, 22-23, Alta Citta</p>
                    </div>
                    <div id="appointment-calendar" style="max-width: 100%; margin: 0 auto;"></div>
                    <div id="time-slots" class="mt-3">
                        <div class="time-slot" data-time="10:00 am">10:00 am</div>
                        <div class="time-slot" data-time="10:20 am">10:20 am</div>
                        <div class="time-slot" data-time="12:00 pm" style="background-color:#00C6F0;">12:00 pm</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side: Personal information form -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Personal Information</h5>
                    <form id="appointment-form">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone *</label>
                            <input type="tel" id="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address *</label>
                            <input type="text" id="address" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Book Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Overview -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking Overview</h5>
                    <p><strong>Branches:</strong> EO Alta Citta</p>
                    <p><strong>Service:</strong> FREE EYE CHECK-UP</p>
                    <p><strong>Date:</strong> <span id="selected-date"></span></p>
                    <p><strong>Time:</strong> <span id="selected-time"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>



@include('template.client.footer')