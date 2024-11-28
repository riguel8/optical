@extends('template.staff.layout')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Messages</h4>
                <h6>Messages List</h6>
            </div>
            <div class="page-btn">
                {{-- <a data-bs-target="#addModal" data-bs-toggle="modal" class="btn btn-added">
                    <img src="{{ asset("assets/img/icons/plus.svg")}}" alt="img">Add Question and Response
                </a> --}}
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a href="#" class="btn btn-searchset">
                                <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img"></a></li>
                            <li><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"></a></li>
                            <li><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img"></a></li>
                        </ul>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Responder</th>
                                <th>Status</th>
                                <th>Last Message</th>
                                <th>Conversation Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conversations as $conversation)
                                <tr>
                                    <td>{{ $conversation->client ? $conversation->client->name : 'No client' }}</td>
                                    <td>{{ $conversation->staff ? $conversation->staff->name : 'No staff' }}</td>
                                    <td>{{ $conversation->status}}</td>
                                    <td>{{ \Carbon\Carbon::parse($conversation->last_message_at)->format('F-j-Y')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($conversation->created_at)->format('F-j-Y')}}</td>
                                    <td>
                                        <a class="me-3 view-message" href="#" data-id="{{ $conversation->id }}" title="View Message">
                                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Message">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="chat-modal" id="chatModal">
    <div class="chat-header">
        <span> Client Chat</span>
        <button class="close-btn" id="closeChatModal">&times;</button>
    </div>
    <div class="messages" id="messageContainer">
    </div>
    <div class="input-container">
        <input type="text" id="messageInput" placeholder="Type a message...">
        <button id="sendButton">Send</button>
    </div>
</div>



    @section('scripts')
    @endsection

@endsection
    