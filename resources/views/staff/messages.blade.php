@extends('template.staff.layout')

@section('content')



        <div class="page-wrapper">
            <div class="content">
                <div class="row chat-window">
                    <!-- Chat Users List -->
                    <div class="col-lg-5 col-xl-4 chat-cont-left">
                        <div class="card mb-sm-3 mb-md-0 contacts_card flex-fill">
                            <div class="card-header chat-search">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="search_btn"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" placeholder="Search" class="form-control search-chat rounded-pill" id="searchChat">
                                </div>
                            </div>
                            <div class="card-body contacts_body chat-users-list chat-scroll" id="chatUsersList">
                                @foreach ($conversations as $conversation)
                                    <a href="javascript:void(0);" 
                                       class="media d-flex chat-user {{ $loop->first ? 'active' : '' }}" 
                                       data-id="{{ $conversation->id }}" 
                                       data-client-name="{{ $conversation->client->name ?? 'No client' }}">
                                        <div class="media-img-wrap flex-shrink-0">
                                        </div>
                                        <div class="media-body flex-grow-1">
                                            <div>
                                                <div class="user-name">{{ $conversation->client->name ?? 'No client' }}</div>
                                                <div class="user-last-chat">{{ $conversation->last_message }}</div>
                                            </div>
                                            <div>
                                                <div class="last-chat-time">{{ \Carbon\Carbon::parse($conversation->last_message_at)->diffForHumans() }}</div>
                                                @if($conversation->unread_count > 0)
                                                    <div class="badge badge-success badge-pill">{{ $conversation->unread_count }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>                         
                        </div>
                    </div>
        
                    <!-- Chat Messages -->
                    <div class="col-lg-7 col-xl-8 chat-cont-right">
                        <div class="card mb-0">
                            <div class="card-header msg_head">
                                <div class="d-flex bd-highlight">
                                    <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <div class="img_cont">
                                        <img class="rounded-circle user_img" src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="">
                                    </div>
                                    <div class="user_info">
                                        <span><strong id="receiver_name"></strong></span>
                                        <p class="mb-0">Messages</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body msg_card_body chat-scroll" id="messageContainer">
                                <!-- Messages appear here (From Javascript) -->
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <input class="form-control type_msg mh-auto empty_check" id="messageInput" placeholder="Type your message...">
                                    <button class="btn btn-primary btn_send" id="sendButton">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .message {
                padding: 10px;
                margin: 5px 0;
                border-radius: 10px;
                max-width: 60%;
                word-wrap: break-word;
                display: inline-block;
            }
            .message-timestamp {
                display: block;
                font-size: 0.8em;
                colrgb(0, 0, 0)gray;
                text-align: right; 
            }
            
            .message.chatmate {
                background-color: #f1f1f1;
                align-self: flex-start;
                text-align: left;
                margin-left: 0;
            }
            
            .message.user {
                background-color: #fc8f00;
                align-self: flex-end;
                text-align: right;
                margin-right: 0;
            }
            
            #messageContainer {
                display: flex;
                flex-direction: column;
                overflow-y: auto;
                padding: 15px;
                height: 400px;
                border: 1px solid #ddd;
                border-radius: 10px;
                background: #fff;
            }
            </style>


    @section('scripts')
    @endsection

@endsection
    