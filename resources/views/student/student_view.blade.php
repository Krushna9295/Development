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
                    <a class="fas fa-backward" href="{{ route('student.list') }}"> Go back</a>
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
            @if(!isset($student->pk_id) && $action == "Add New Student")
            <form method="post" id="student_form" name="" class="form-horizontal" action="javascript:void(0)">
            @elseif($action == "Update Student")
            <form method="post" id="student_update_form" name="modalFormData" class="form-horizontal" action="javascript:void(0)">
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
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="stud_first_name" name="stud_first_name" placeholder="Student First Name" value="{{ isset($student) ? $student->stud_first_name : '' }}" {{$disabled}} >
                            <span class="text-danger error-text stud_first_name_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="stud_middle_name" id="stud_middle_name" placeholder="Student Middle Name"value="{{ isset($student) ? $student->stud_middle_name : '' }}" {{$disabled}}>
                            <span class="text-danger p-1">{{ $errors->first('title') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="stud_last_name" id="stud_last_name" placeholder="Student Last Name"value="{{ isset($student) ? $student->stud_last_name : '' }}" {{$disabled}}>
                            <span class="text-danger error-text stud_last_name_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>DOB</label>
                            <input type="date" class="form-control" onchange="ageCalculator()" name="stud_dob" id="stud_dob" placeholder="Student DOB" value="{{ isset($student) ? $student->stud_dob : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Age</label>
                            <input type="text" class="form-control" name="stud_age" id="stud_age" placeholder="Student Age" value="{{ isset($student) ? $student->stud_age : '' }}" {{$disabled}}>
                            <span class="text-danger error-text stud_age_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="stud_gender" id="stud_gender" {{$disabled}}>
                                <option value="">Select Gender</option>
                                <option value="male" @if(isset($student)) {{ ($student->stud_gender == 'male') ? 'selected' : ''}} @endif>Male</option>
                                <option value="female" @if(isset($student)) {{ ($student->stud_gender == 'female') ? 'selected' : ''}} @endif>Female</option>
                                <option value="other" @if(isset($student)) {{ ($student->stud_gender == 'other') ? 'selected' : ''}} @endif>Other</option>
                            </select>
                            <span class="text-danger error-text stud_gender_err"></span>                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Father Occupation</label>
                            <input type="text" class="form-control" name="stud_father_occupation" id="stud_father_occupation" placeholder="Father Occupation" style="width: 100%;" value="{{ isset($student) ? $student->stud_father_occupation : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Adhaar No</label>
                            <input type="text" class="form-control" name="stud_adhar_no" id="stud_adhar_no" placeholder="Adhaar No" style="width: 100%;" value="{{ isset($student) ? $student->stud_adhar_no : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Insurance No</label>
                            <input type="text" class="form-control" name="stud_ins_no" id="stud_ins_no" placeholder="Insurance No" style="width: 100%;" value="{{ isset($student) ? $student->stud_ins_no : '' }}" {{$disabled}}>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(255 193 7);"/>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Deworming History</label></br>
                                <input type="radio" id="yes" name="deworning" id="deworning" value="Yes" style="width: 20%;"  @if(isset($student)) {{ ($student->deworning == 'Yes') ? 'checked' : ''}} @endif ><label for="yes" style="width: 20%;">Yes</label>
                                <input type="radio" id="no" name="deworning" id="deworning" value="No" style="width: 20%;" @if(isset($student)) {{ ($student->deworning == 'No') ? 'checked' : ''}} @endif ><label for="no" style="width: 20%;">No</label><br/>
                                <span class="text-danger error-text deworning_err"></span>                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>School Name</label>
                            <select id="stud_school_id" name="stud_school_id" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select State</option>
                                @foreach ($school as $groups)
                                <option  value="{{ $groups->pk_id }}"  @if(isset($student)){{($groups->pk_id == $student->stud_school_id) ? 'selected' : ''}} @endif> {{{ $groups->school_name }}}</option>
                                @endforeach
                            </select>   
                            <!-- <input type="text" class="form-control" name="stud_school_id" id="stud_school_id" placeholder="School Name" style="width: 100%;" value="{{ isset($student) ? $student->school_name : '' }}" {{$disabled}}> -->
                            <span class="text-danger error-text stud_school_id_err"></span>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(255 193 7);"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Address</label></br>
                            <!-- <input type="text" name="incient[place]" style="" id="inc_map_address" class="form-control form-control-sm" placeholder="Type Incidence Address Here*" value="<?php if(isset($post['inc_address'])){ echo $post['inc_address'];}  ?>" TABINDEX="11" data-ignore="ignore" data-state="yes" data-dist="yes" data-thl="yes" data-city="yes" data-rel="incient" data-auto="inc_auto_addr"> -->
                            <input type="text" class="form-control" name="stud_address" id="stud_address" placeholder="Address" style="width: 100%;" value="{{ isset($student) ? $student->stud_address : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>State</label>
                            <select id="state" name="stud_state" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select State</option>
                                @foreach ($state as $groups)

                                <option  value="{{ $groups->st_code }}"  @if(isset($student)){{($groups->st_code == $student->stud_state) ? 'selected' : ''}} @endif> {{{ $groups->st_name }}}</option>
                            
                                @endforeach
                            </select>                            
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>District</label>
                                <select id="district" name="stud_district" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select District</option>
                                    @foreach ($district as $groups)
                                    <option  value="{{ $groups->dst_code }}"  @if(isset($student)){{($groups->dst_code == $student->dst_code) ? 'selected' : ''}} @endif> {{{ $groups->dst_name }}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahsil</label>
                                <select name="stud_tahsil"  id="tahsil" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select Tahsil</option>
                                @foreach ($tahsil as $groups)

                                <option  value="{{ $groups->thl_code }}"  @if(isset($student)){{($groups->thl_code == $student->thl_code) ? 'selected' : ''}} @endif> {{{ $groups->thl_name }}}</option>
                            
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>City</label>
                            <select name="stud_city"  id="city" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select City</option>
                                @foreach ($city as $groups)

                                <option  value="{{ $groups->cty_id }}"  @if(isset($student)){{($groups->cty_name == $student->cty_name) ? 'selected' : ''}} @endif> {{{ $groups->cty_name }}}</option>
                            
                                @endforeach
                                </select>                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Area/Location</label>
                            <input type="text" class="form-control" name="stud_area" id="stud_area" placeholder="Area/Location" style="width: 100%;" value="{{ isset($student) ? $student->stud_area : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Landmark</label>
                            <input type="text" class="form-control" name="stud_landmark" id="stud_landmark" placeholder="Landmark" style="width: 100%;" value="{{ isset($student) ? $student->stud_landmark : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Lane/Street</label>
                            <input type="text" class="form-control" name="stud_lane_street" id="stud_lane_street" placeholder="Lane/Street" style="width: 100%;" value="{{ isset($student) ? $student->stud_lane_street : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>House Number</label>
                            <input type="text" class="form-control" name="stud_house_no" id="stud_house_no" placeholder="House Number" style="width: 100%;" value="{{ isset($student) ? $student->stud_house_no : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" class="form-control" name="stud_pincode" id="stud_pincode" placeholder="Pincode" style="width: 100%;" value="{{ isset($student) ? $student->stud_pincode : '' }}" {{$disabled}}>
                            </div>
                        </div>
                    </div>
                    @if($action != "View Student")
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<!-- <script src="{{ url('/')}}/resources/custom/inc_map_here.js"></script> -->
<style>
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: #900808 !important;
    }
</style>
<script>
// $(document).ready(function() {
//     initIncidentMap();
// });
    $(".btn-submit").click(function(e){
        e.preventDefault();
        if($('#student_form').serialize()!=""){
            var form = $('#student_form');
            $url = "{{ route('student.store') }}";
        }else if($('#student_update_form').serialize()!=""){
            var form = $('#student_update_form');
            <?php if(isset($student->pk_id)){ ?>
                $url = "{{action( 'App\Http\Controllers\StudentController@update',"$student->pk_id" )}}";
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
                    window.location.href = "{{route('student.list')}}"
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
    function ageCalculator(){
        var today = new Date();
        var birthDate = new Date($('#stud_dob').val());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age = age - 1;
        }
        $('#stud_age').val(age)
    }
// }); 
</script>