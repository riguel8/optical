@extends('template.admin.layout')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Chatbot</h4>
                <h6>List of chatbot question and response</h6>
            </div>
            <div class="page-btn">
                <a data-bs-target="#addModal" data-bs-toggle="modal" class="btn btn-added">
                    <img src="{{ asset("assets/img/icons/plus.svg")}}" alt="img">Add Question and Response
                </a>
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
                                <th>#</th>
                                <th>Question</th>
                                <th>Response</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chatbots as $chatbot)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ Str::limit($chatbot->Question, 50, '...') }}</td>
                                    <td>{{ Str::limit($chatbot->Response, 50, '...') }}</td>
                                    <td>
                                        <!-- <a class="me-3" href="#"><img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img"></a> -->
                                        <a class="me-3 edit-chatbot" data-id="{{ $chatbot->ChatbotID }}" href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        </a>
                                        <a class="me-3 btn-delete" data-id="{{ $chatbot->ChatbotID }}" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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

<!-- Add Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">Add new Question and Response</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form id="addForm" method="POST" action="{{ route('admin.chatbot.store') }}">
                    @csrf
                    <input type="hidden" id="chatbot_id" name="ChatbotID" value="">
                    <div class="form-floating mb-3">
                        <textarea style="height: 100px" class="form-control" id="question" placeholder="Enter Question" name="Question" rows="3" required></textarea>
                        <label for="question">Question?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea style="height: 150px" class="form-control" id="response" placeholder="Enter Response" name="Response" rows="3" required></textarea>
                        <label for="response">Response</label>
                    </div>

                    <div class="mt-auto d-flex justify-content-end gap-2">
                        <button class="btn btn-lg btn-submit w-100" type="submit">Submit</button>
                        <button class="btn btn-lg btn-cancel w-100" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">Edit Question and Response</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form method="POST" action="" id="editChatbotForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="chatbot_id" name="ChatbotID">
                    <div class="form-floating mb-3">
                        <textarea style="height: 100px" class="form-control" id="edit_question" placeholder="Enter Question" name="Question" required>{{ old('Question') }}</textarea>
                        <label for="edit_question">Question?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea style="height: 150px" class="form-control" id="edit_response" placeholder="Enter Response" name="Response" required>{{ old('Response') }}</textarea>
                        <label for="edit_response">Response</label>
                    </div>
                    <div class="mt-auto d-flex justify-content-end gap-2">
                        <button class="btn btn-lg btn-submit w-100" type="submit">Submit</button>
                        <button class="btn btn-lg btn-cancel w-100" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    @section('scripts')

        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/admin/chatbot/create.js') }}"></script>
        <script src="{{ asset('assets/js/admin/chatbot/update.js') }}"></script>
        <script src="{{ asset('assets/js/admin/chatbot/delete.js') }}"></script>

    @endsection

@endsection
