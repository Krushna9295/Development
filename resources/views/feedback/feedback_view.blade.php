@include('template.header')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">
    @include('template.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ $action }}</h2>
                </div>
                <div class=" col-sm-6 form-group text-right">
                    <a class="fas fa-backward" href="{{ route('feedback.list') }}"> Go back</a>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if (Session::has("success"))
        <div class="container-fluid">
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ Session::get("success") }}
            </div>
        </div>
        @endif
        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            @if($action == "Feedback")
            <form method="post" id="feedback_form" name="" class="form-horizontal" >
            @elseif($action == "Update feedback")
            <form method="post" id="feedback_update_form" name="modalFormData" class="form-horizontal" >
            @method('PATCH')
            @else
                <form method="post" id="" name="modalFormData" class="form-horizontal" action="">
            @endif
            @csrf
            <div class="card card-warning"> 
            <!-- collapsed-card -->
                <div class="card-header">
                    <h3 class="card-title">{{ $action }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="patientId" value="{{$patient->pk_id}}">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Patient Name : </label> <lable>{{$patient->ptn_name}}</lable>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Patient Contact No : </label> <lable>{{$patient->ptn_contact_no}}</lable>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Patient Age : </label> <lable>{{$patient->ptn_age}}</lable>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Patient Gender : </label> <lable>{{$patient->ptn_gender}}</lable>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(0 160 230);"/>
                    <lable class="lableColor">Feedback Details </lable>
                    @if(isset($ans))
                    @foreach ($ans as $groups)
                    <div class="row" id="dynamic_field">
                        <div class="col-md-3">
                            <lable class="">{{$groups->ques_name}} : </lable>
                        </div>
                        <div class="col-md-1">
                            <label>Excellent</label>
                            <input type="radio" name="" id="followup_ref_doc_name" placeholder="Name" value='excellent' @if(isset($ans)) {{ ($groups->feed_ans == 'excellent') ? 'checked' : ''}} @endif {{$disabled}}>
                        </div>
                        <div class="col-md-1">
                            <label>Good</label>
                            <input type="radio" name="" id="followup_ref_doc_cont_no" placeholder="Contact No." value="good" @if(isset($ans)) {{ ($groups->feed_ans == 'good') ? 'checked' : ''}} @endif {{$disabled}}>
                        </div>
                        <div class="col-md-1">
                            <label>Average</label>
                            <input type="radio" name="" id="followup_ref_doc_cont_no" placeholder="Contact No." value="average" @if(isset($ans)) {{ ($groups->feed_ans == 'average') ? 'checked' : ''}} @endif {{$disabled}}>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if(!isset($ans))
                    @foreach ($ques as $groups)
                    <div class="row" id="dynamic_field">
                        <div class="col-md-3">
                            <lable class="">{{$groups->ques_name}} : </lable>
                        </div>
                        <div class="col-md-1">
                            <label>Excellent</label>
                            <input type="radio" name="ptn_feed_ques[{{$groups->ques_id}}]" id="followup_ref_doc_name" placeholder="Name" value='excellent'>
                        </div>
                        <div class="col-md-1">
                            <label>Good</label>
                            <input type="radio" name="ptn_feed_ques[{{$groups->ques_id}}]" id="followup_ref_doc_cont_no" placeholder="Contact No." value="good">
                        </div>
                        <div class="col-md-1">
                            <label>Average</label>
                            <input type="radio" name="ptn_feed_ques[{{$groups->ques_id}}]" id="followup_ref_doc_cont_no" placeholder="Contact No." value="average">
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <hr>
                    <div class="row" id="dynamic_field">
                        <div class="col-md-3">
                            <lable class="">Remark Summery : </lable>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="ptn_feed_remark" id="ptn_feed_remark" placeholder="Remark" value="{{ isset($patient_feed) ? $patient_feed->ptn_feed_remark : '' }}" {{$disabled}}>
                            <span class="text-danger error-text ptn_feed_remark_err"></span>
                        </div>
                    </div><br/>
                    @if($action != "View Feedback")
                    <div class="row">
                        <div class="offset-md-6 col-md-2">
                            <div class="form-group btn-group">
                            <input type="Submit" class="form-control btn btn-primary left btn-submit" placeholder="Submit" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            </form>
        </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
     @include('template.footer')
</div>
<!-- ./wrapper -->
<!-- Page script -->
<meta name="csrf-token" content="{{ csrf_token() }}">
</body>
</html>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<style>
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: #900808 !important;
    }
</style>
<script>
    $(".btn-submit").click(function(e){
        e.preventDefault();
        if($('#feedback_form').serialize()!=""){
            var form = $('#feedback_form');
            $url = "{{ route('feedback.store') }}";
        }else if($('#feedback_update_form').serialize()!=""){
            var form = $('#feedback_update_form');
            <?php if(isset($feedback->hp_id)){ ?>
                $url = "{{action( 'App\Http\Controllers\FeedbackController@update',"$feedback->hp_id" )}}";
            <?php }?>
        }
        var formData = form.serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $url,
            type:'POST',
            data: formData,
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    window.location.href = "{{route('feedback.list')}}"
                }else{
                    printErrorMsg(data.error);
                }
            }
        });
    }); 
    function printErrorMsg (msg) {
        $.each( msg, function( key, value ) {
        console.log(value);
            $('.'+key+'_err').text(value);
        });
    }
</script>