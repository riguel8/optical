@include('template.admin.header')


        @include('template.admin.navbar')
        @include('template.admin.sidebar')
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Appointments</h4>
                        <h6>Appointment Lists</h6>
                    </div>
                    <div class="page-btn">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newAppointmentModal">
                            Add New Appointment
                        </button>
                    </div>
                </div>
        
                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="search-set">
                                <div class="search-input">
                                    <a class="btn btn-searchset">
                                        <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                                    </a>
                                </div>
                            </div>
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf">
                                            <img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                                            <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print">
                                            <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Date</th>
                                        <th>Patient Name</th>
                                        <th>Patient Age</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($appointments as $appointment)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('Y-m-d') }}</td>
                                            <td>{{ $appointment->patient->complete_name ?? 'N/A' }}</td>
                                            <td>{{ $appointment->patient->age ?? 'N/A' }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="me-3" href="#">
                                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img">
                                                    </a>
                                                    <a class="me-3" href="#">
                                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="5">No appointments found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('template.admin.footer')