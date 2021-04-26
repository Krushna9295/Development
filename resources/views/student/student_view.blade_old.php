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
            @if(!isset($student->id) && $action == "Add New Student")
            <form method="post" id="" name="" class="form-horizontal" action="{{route( 'student.store' )}}">
            @elseif($action == "Update Student")
            <form method="post" id="" name="modalFormData" class="form-horizontal" action="{{action( 'App\Http\Controllers\StudentController@update',$student->id )}}">
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
                            <input type="text" class="form-control select2" id="stu_fname" name="stu_fname" placeholder="Student First Name" style="width: 100%;" value="{{ isset($student) ? $student->stu_fname : '' }}" {{$disabled}} >
                            <span class="text-danger error-text">{{ $errors->has('stu_fname') ?  $errors->first('stu_fname') : '' }}</span>
                            <!-- @if ($errors->has('stu_fname'))
                                <span class="text-danger">{{ $errors->first('stu_fname') }}</span>
                            @endif -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="stu_mname" id="stu_mname" placeholder="Student Middle Name" style="width: 100%;" value="{{ isset($student) ? $student->stu_mname : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="stu_lname" id="stu_lname" placeholder="Student Last Name" style="width: 100%;" value="{{ isset($student) ? $student->stu_lname : '' }}" {{$disabled}}>
                            <!-- <span class="text-danger error-text stu_lname_err"></span> -->
                            <span class="text-danger error-text">{{ $errors->has('stu_lname') ?  $errors->first('stu_lname') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>DOB</label>
                            <input type="text" class="form-control" name="stu_dob" id="stu_dob" placeholder="Student DOB" style="width: 100%;" value="{{ isset($student) ? $student->stu_dob : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Age</label>
                            <input type="text" class="form-control" name="stu_age" id="stu_age" placeholder="Student Age" style="width: 100%;" value="{{ isset($student) ? $student->stu_age : '' }}" {{$disabled}}>
                            <!-- <span class="text-danger error-text stu_age_err"></span> -->
                            <span class="text-danger error-text">{{ $errors->has('stu_age') ?  $errors->first('stu_age') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="stu_gender" id="stu_gender" style="width: 100%;">
                                <option value="">Select Gender</option>
                                <option value="male" @if(isset($student)) {{ ($student->stu_gender == 'male') ? 'selected' : ''}} @endif>Male</option>
                                <option value="female" @if(isset($student)) {{ ($student->stu_gender == 'female') ? 'selected' : ''}} @endif>Female</option>
                                <option value="other" @if(isset($student)) {{ ($student->stu_gender == 'other') ? 'selected' : ''}} @endif>Other</option>
                            </select>
                            <span class="text-danger error-text">{{ $errors->has('stu_gender') ?  $errors->first('stu_gender') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Father Occupation</label>
                            <input type="text" class="form-control" name="stu_f_occupation" id="stu_f_occupation" placeholder="Father Occupation" style="width: 100%;" value="{{ isset($student) ? $student->stu_occupation : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Adhaar No</label>
                            <input type="text" class="form-control" name="stu_adhar_no" id="stu_adhar_no" placeholder="Adhaar No" style="width: 100%;" value="{{ isset($student) ? $student->stu_adhar_no : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Insurance No</label>
                            <input type="text" class="form-control" name="stu_insu_no" id="stu_insu_no" placeholder="Insurance No" style="width: 100%;" value="{{ isset($student) ? $student->stu_insu_no : '' }}" {{$disabled}}>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(255 193 7);"/>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <!-- @if(isset($student)) {{ $student->stu_deworming_his  }}@endif -->
                            <label>Deworming History</label></br>
                                <input type="radio" id="yes" name="stu_deworming_his" id="stu_deworming_his" value="Yes" style="width: 20%;"  @if(isset($student)) {{ ($student->stu_deworming_his == 'Yes') ? 'checked' : ''}} @endif ><label for="yes" style="width: 20%;">Yes</label>
                                <input type="radio" id="no" name="stu_deworming_his" id="stu_deworming_his" value="No" style="width: 20%;" @if(isset($student)) {{ ($student->stu_deworming_his == 'No') ? 'checked' : ''}} @endif ><label for="no" style="width: 20%;">No</label><br/>
                                <span class="text-danger error-text">{{ $errors->has('stu_deworming_his') ?  $errors->first('stu_deworming_his') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>School Name</label>
                            <input type="text" class="form-control" name="stu_school_id" id="stu_school_id" placeholder="School Name" style="width: 100%;" value="{{ isset($student) ? $student->stu_school_id : '' }}" {{$disabled}}>
                            <!-- <span class="text-danger error-text stu_school_id_err"></span> -->
                            <span class="text-danger error-text">{{ $errors->has('stu_school_id') ?  $errors->first('stu_school_id') : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(255 193 7);"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Address</label></br>
                            <input type="text" class="form-control" name="stu_address" id="stu_address" placeholder="Address" style="width: 100%;" value="{{ isset($student) ? $student->stu_address : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="stu_state" id="stu_state" placeholder="State" style="width: 100%;" value="{{ isset($student) ? $student->stu_state : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>District</label>
                            <input type="text" class="form-control" name="stu_district" id="stu_district" placeholder="District" style="width: 100%;" value="{{ isset($student) ? $student->stu_district : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="stu_city" id="stu_city" placeholder="City" style="width: 100%;" value="{{ isset($student) ? $student->stu_city : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Area/Location</label>
                            <input type="text" class="form-control" name="stu_area" id="stu_area" placeholder="Area/Location" style="width: 100%;" value="{{ isset($student) ? $student->stu_area : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Landmark</label>
                            <input type="text" class="form-control" name="stu_landmark" id="stu_landmark" placeholder="Landmark" style="width: 100%;" value="{{ isset($student) ? $student->stu_landmark : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Lane/Street</label>
                            <input type="text" class="form-control" name="stu_lane_street" id="stu_lane_street" placeholder="Lane/Street" style="width: 100%;" value="{{ isset($student) ? $student->stu_lane_street : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>House Number</label>
                            <input type="text" class="form-control" name="stu_house_no" id="stu_house_no" placeholder="House Number" style="width: 100%;" value="{{ isset($student) ? $student->stu_house_no : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" class="form-control" name="stu_pincode" id="stu_pincode" placeholder="Pincode" style="width: 100%;" value="{{ isset($student) ? $student->stu_pincode : '' }}" {{$disabled}}>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<style>
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: #900808 !important;
    }
</style>