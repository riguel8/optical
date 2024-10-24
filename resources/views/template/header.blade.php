<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/m.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

    <title>Delin Optical</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/Dlogo-small.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/pe7/pe-icon-7.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simpleline/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" >
    <link rel="stylesheet" href="{{ asset('assets/lib/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}">

    <style>
        .section-padding {
            padding-top: 10px;
        }

        .logo-img img {
            max-width: 150px;
            height: auto;
        }
        .sticky-top {
            position: sticky;
            top: 0;
            z-index: 1030;
            background-color: #fff; 
            width: 100%; 
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); 
        }

        html {
            scroll-behavior: smooth;
        }

        .productset {
            max-height: 400px; 
            overflow: hidden; 
            text-align: center; 
        }

        .productsetimg img {
            max-height: 300px; 
            object-fit: cover; 
            width: 100%; 
        }

        .productsetcontent {
            padding: 10px; 
        }

        .swiper-pagination {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .swiper-pagination-bullet {
            background-color: #637381;
            border: 2px solid white;
            border-radius: 50%;
            width: 14px;
            height: 14px;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .swiper-pagination-bullet-active {
            background-color:#212b36;
            opacity: 1;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #212b36;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatbotModalLabel">Chat with our Assistant</h5>
                    <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-7 col-xl-12 chat-cont-right">
                        <div class="card mb-0">
                            <div class="card-header msg_head">
                                <div class="d-flex bd-highlight">
                                    <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                      <i class="fas fa-chevron-left"></i>
                                  </a>
                                  <div class="img_cont">
                                      <img class="rounded-circle user_img" src="{{ asset("assets/img/Dlogo-small.png") }}" alt="">
                                  </div>
                                  <div class="user_info">
                                      <span><strong id="receiver_name">Delin Optical</strong></span>
                                      <p class="mb-0">Chatbot</p>
                                  </div>
                              </div>
                          </div>
                          <div class="card-body msg_card_body chat-scroll">
                              <ul class="list-unstyled" id="chat-messages">

                              </ul>
                          </div>
                          <div class="card-footer">
                              <div class="input-group">
                                <div class="btn" role="group">
                                  <button type="button" class="btn btn-outline-success" onclick="sendMessage('Book an Appointment')">Book an Appointment</button>
                                  <button type="button" class="btn btn-outline-primary" onclick="sendMessage('What are the available hours for today?')">Available Hours Today</button>  
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


<!-- Add Appointment Modal -->
<div class="modal fade" role="dialog" tabindex="-1" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Book an Appointment</h4>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="appointmentDate" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" name="appointment_date" id="appointmentDate" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="appointmentTime" class="form-label">Appointment Time</label>
                            <input type="time" class="form-control" name="appointment_time" id="appointmentTime" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
