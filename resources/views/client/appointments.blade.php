@include('template.client.header')

    @include('template.client.navbar')
    @include('template.client.sidebar')

    <div class="page-wrapper">
        <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
            
            <div class="col-lg-12 col-md-8">
                <div class="card bg-white">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>  
        </div>
    </div>


@include('template.client.footer')