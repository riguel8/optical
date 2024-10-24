@include('template.admin.header')


        @include('template.admin.navbar')
        @include('template.admin.sidebar')

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Patients</h4>
                        <h6>Patient Lists</h6>
                    </div>
                        <div class="page-btn">
                            <a data-bs-target="#add" data-bs-toggle="modal" class="btn btn-added"><img src="{{ asset("assets/img/icons/plus.svg")}}" alt="img">Add Patient</a>
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
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Prescription</th>
                                        <th>Lens</th>
                                        <th>Frame</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($patients as $patient)
                                        <tr>
                                            <td>{{ $patient->complete_name}}</td>
                                            <td>{{ $patient->age}}</td>

                                            <td class="{{ isset($patient->prescription) && $patient->prescription->Prescription ? '' : 'text-red' }}">
                                                {{ $patient->prescription->Prescription ?? 'No Prescription Yet' }}
                                            </td>
                                            
                                            <td class="{{ isset($patient->prescription) && $patient->prescription->Lens ? '' : 'text-red' }}">
                                                {{ $patient->prescription->Lens ?? 'No Lens Yet' }}
                                            </td>

                                            <td class="{{ isset($patient->prescription) && $patient->prescription->Frame ? '' : 'text-red' }}">
                                                {{ $patient->prescription->Frame ?? 'No Frame Yet' }}
                                            </td>

                                            <td class="{{ isset($patient->prescription) && $patient->prescription->Price ? '' : 'text-red' }}">
                                                {{ $patient->prescription->Price ?? 'N/A' }}
                                            </td>


                                            <td>{{ date('m/d/Y', strtotime($patient->created_at)) }}</td>
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
                                            <td class="text-center" colspan="5">No Patients found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<style>
    .text-red {
    color: red;
}
</style>


@include('template.admin.footer')
</header>