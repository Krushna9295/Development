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
                    <a class="fas fa-backward" href="{{ route('patient.list') }}"> Go back</a>
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
            @if(!isset($patient->pk_id) && $action == "Add New Patient")
            <form method="post" id="patient_form" name="" class="form-horizontal" action="javascript:void(0)">
            @elseif($action == "Update Patient")
            <form method="post" id="patient_update_form" name="modalFormData" class="form-horizontal" action="javascript:void(0)">
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
                                <label>Patient Name</label>
                                <input type="text" class="form-control" id="ptn_name" name="ptn_name" placeholder="Patient Name" value="{{ isset($patient) ? $patient->ptn_first_name : '' }}" {{$disabled}} >
                                <span class="text-danger error-text ptn_name_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="ptn_gender" id="ptn_gender" {{$disabled}}>
                                <option value="">Select Gender</option>
                                <option value="male" @if(isset($patient)) {{ ($patient->ptn_gender == 'male') ? 'selected' : ''}} @endif>Male</option>
                                <option value="female" @if(isset($patient)) {{ ($patient->ptn_gender == 'female') ? 'selected' : ''}} @endif>Female</option>
                                <option value="other" @if(isset($patient)) {{ ($patient->ptn_gender == 'other') ? 'selected' : ''}} @endif>Other</option>
                            </select>
                            <span class="text-danger error-text ptn_gender_err"></span>                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="text" class="form-control" name="ptn_contact_no" id="ptn_contact_no" placeholder="Mobile" value="{{ isset($patient) ? $patient->ptn_age : '' }}" {{$disabled}}>
                                <span class="text-danger error-text ptn_contact_no_err"></span>  
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text" class="form-control" name="ptn_age" id="ptn_age" placeholder="Age" value="{{ isset($patient) ? $patient->ptn_age : '' }}" {{$disabled}}>
                                <span class="text-danger error-text ptn_age_err"></span>
                            </div>
                        </div>
                   </div>
                    <hr style="border-top: 2px solid rgb(0 160 230);"/>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Address</label></br>
                            <!-- <input type="text" name="incient[place]" style="" id="inc_map_address" class="form-control form-control-sm" placeholder="Type Incidence Address Here*" value="<?php if(isset($post['inc_address'])){ echo $post['inc_address'];}  ?>" TABINDEX="11" data-ignore="ignore" data-state="yes" data-dist="yes" data-thl="yes" data-city="yes" data-rel="incient" data-auto="inc_auto_addr"> -->
                            <input type="text" class="form-control" name="ptn_address" id="inc_map_address" placeholder="Address" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_address : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>State</label>
                            <select id="state" name="ptn_state" class="form-control" {{$disabled}} >
                                <option value="">Select State</option>
                                @foreach ($state as $groups)

                                <option  value="{{ $groups->st_code }}"  @if(isset($patient)){{($groups->st_code == $patient->ptn_state) ? 'selected' : ''}} @endif> {{{ $groups->st_name }}}</option>
                            
                                @endforeach
                            </select>                            
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>District</label>
                                <select id="district" name="ptn_district" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select District</option>
                                    @foreach ($district as $groups)
                                    <option  value="{{ $groups->dst_code }}"  @if(isset($patient)){{($groups->dst_code == $patient->dst_code) ? 'selected' : ''}} @endif> {{{ $groups->dst_name }}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tahsil</label>
                                <select name="ptn_tahsil"  id="tahshil" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select Tahsil</option>
                                @foreach ($tahsil as $groups)

                                <option  value="{{ $groups->thl_code }}"  @if(isset($patient)){{($groups->thl_code == $patient->thl_code) ? 'selected' : ''}} @endif> {{{ $groups->thl_name }}}</option>
                            
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>City</label>
                                <select name="ptn_city"  id="city" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select City</option>
                                    @foreach ($city as $groups)

                                    <option  value="{{ $groups->cty_id }}"  @if(isset($patient)){{($groups->cty_name == $patient->cty_name) ? 'selected' : ''}} @endif> {{{ $groups->cty_name }}}</option>
                                
                                    @endforeach
                                    </select>                            
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(0 160 230);"/>
                    <lable class="lableColor">Covid Information</lable><br/>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Covid Test</label>
                                <select name="ptn_covid_test"  id="covid_test" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select Covid Test</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-md-2 covidTest" style="display:none">
                            <div class="form-group">
                                <label>Report</label>
                                <select name="ptn_report"  id="ptn_report" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select Report</option>
                                    <option value="RAT">RAT</option>
                                    <option value="RT PCR">RT PCR</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-md-2 covidTest" style="display:none">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="datetime-local" class="form-control" name="ptn_report_date" id="ptn_report_date" placeholder="Pincode" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                          
                            </div>
                        </div>
                        <div class="col-md-2 covidTest" style="display:none">
                            <div class="form-group" >
                                <label>Center Name</label>
                                <select name="ptn_report_center_name"  id="ptn_report_center_name" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select Report</option>
                                    <option value="RAT">RAT</option>
                                    <option value="RT PCR">RT PCR</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date of On Set illness</label>
                                <input type="datetime-local" class="form-control" name="ptn_date_set_illness" id="ptn_date_set_illness" placeholder="Pincode" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                                                    
                            </div>
                        </div>
                    </div>
                    <lable class="lableColor">On Examination</lable><br/>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Puls Rate </label>
                                <input type="text" class="form-control" name="ptn_puls_rate" id="ptn_puls_rate" placeholder="Puls Rate" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>
                                <div id="slider-range1" style="margin: 7px;"></div>                 
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>BP Systolic</label>
                                <input type="text" class="form-control" name="ptn_bp_systolic" id="ptn_bp_systolic" placeholder="BP Systolic" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>
                                <div id="slider-range2" style="margin: 7px;"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>BP Diastolic</label>
                                <input type="text" class="form-control" name="ptn_bp_diastolic" id="ptn_bp_diastolic" placeholder="BP Diastolic" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>
                                <div id="slider-range3" style="margin: 7px;"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>SPO2</label>
                                <input type="text" class="form-control" name="ptn_spo2" id="ptn_spo2" placeholder="SPO2" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                          
                                <div id="slider-range4" style="margin: 7px;"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" >
                                <label>RR</label>
                                <input type="text" class="form-control" name="ptn_rr" id="ptn_rr" placeholder="RR" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                                                     
                                <div id="slider-range5" style="margin: 7px;"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" >
                                <label>Temperature</label>
                                <input type="text" class="form-control" name="ptn_temp" id="ptn_temp" placeholder="Temperature" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                                                     
                                <div id="slider-range6" style="margin: 7px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Other Comorbidity</label>
                                <select name="ptn_other_comorbidity"  id="ptn_other_comorbidity" class="form-control" {{$disabled}} autocomplete="off" >
                                    <option value="">Other Comorbidity</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                             
                            </div>
                        </div>
                        <div class="col-md-2 ptn_comorbidity" style="display:none">
                            <div class="form-group">
                                <label>Select Comorbidity</label>
                                <select name="ptn_comorbidity"  id="ptn_comorbidity" class="form-control" {{$disabled}} autocomplete="off" >
                                    <option value="">Select Comorbidity</option>
                                    @foreach ($comorbidity as $groups)
                                    <option value="{{$groups->com_id}}">{{$groups->com_name}}</option>
                                    @endforeach
                                </select>                             
                            </div>
                        </div>
                        <div class="col-md-2 ptn_comorbidity_other_remark" style="display:none">
                            <div class="form-group">
                                <label>Comorbidity Other Remark</label>
                                <input type="text" class="form-control" placeholder="Remark" name="ptn_comorbidity_other_remark" id="ptn_comorbidity_other_remark">                             
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>HRCT</label>
                                <input type="text" class="form-control" name="ptn_hrct" id="ptn_hrct" placeholder="HRCT" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>
                                <div id="slider-range7" style="margin: 7px;"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Chest X-Ray</label>
                                <select name="ptn_x_ray"  id="ptn_x_ray" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select Chest X-Ray</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                             
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>ECG</label>
                                <select name="ptn_ecg"  id="ptn_ecg" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select ECG</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                             
                            </div>
                        </div>
                    </div>
                    <hr>
                    <lable class="lableColor">Blood Invistigation</lable> <button type="button" name="add" id="add" class="btn btn-success" style="line-height: 0.5;border-radius: 46.25rem;">+</button><br/>
                    <hr>
                    <div class="row" id="dynamic_field">
                        <!-- <div class="col-md-2">
                            <div class="form-group">
                                <input type="date" class="form-control" name="addmore[][date]" placeholder="Pincode" style="width: 100%;" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            </div>
                        </div> -->
                        <!-- <div class="col-md-10">
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>CBC</label> &nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>HB</label> &nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>Blood Group</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>CRP</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>D - dimer</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>Serum (Sr.) Ferrtin</label>
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>LDH</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>LFT</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>RFT</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>Blood Sugar</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>IL 6</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>Lipid Profile</label>&nbsp;&nbsp;
                            <input type="checkbox" class="" name="ptn_pincode" id="ptn_pincode" placeholder="Pincode" value="{{ isset($patient) ? $patient->ptn_pincode : '' }}" {{$disabled}}>                           
                            <label>CPK-MB</label> -->
                        <!-- </div> -->
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Oral Medicine</label>
                                <select name="ptn_oral_medicine[]"  id="ptn_oral_medicine" class="form-control selectpicker" multiple="multiple" {{$disabled}} data-live-search="true">
                                    <option value="">Select Oral Medicine</option>
                                    @foreach ($medicine as $groups)
                                    <option value="{{$groups->med_id}}">{{$groups->med_name}}</option>
                                    @endforeach
                                </select>                             
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Injectable</label>
                                <select name="ptn_injectable[]"  id="ptn_injectable" class="form-control selectpicker" multiple="multiple" {{$disabled}} autocomplete="off">
                                    <option value="">Select Injectable</option>
                                    @foreach ($injectable as $groups)
                                    <option value="{{$groups->inj_id}}">{{$groups->inj_name}}</option>
                                    @endforeach
                                </select>                             
                            </div>
                        </div>
                        
                    </div>
                    @if($action != "View patient")
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="{{ url('/')}}/resources/custom/inc_map_here.js"></script>
<style>
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: #900808 !important;
    }
</style>
<script>
    $(document).ready(function() {
        map_autocomplete();
    });
    $(".btn-submit").click(function(e){
        // $('#')
        e.preventDefault();
        if($('#patient_form').serialize()!=""){
            var form = $('#patient_form');
            $url = "{{ route('patient.store') }}";
        }else if($('#patient_update_form').serialize()!=""){
            var form = $('#patient_update_form');
            <?php if(isset($patient->pk_id)){ ?>
                $url = "{{action( 'App\Http\Controllers\PatientController@update',"$patient->pk_id" )}}";
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
                // console.log(data);
                if($.isEmptyObject(data.error)){
                    window.location.href = "{{route('patient.list')}}"
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
        var birthDate = new Date($('#ptn_dob').val());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age = age - 1;
        }
        $('#ptn_age').val(age)
    }
    $("#covid_test").on('change',function(e){
        $covidTest = $("#covid_test").val();
        if($covidTest == 'yes'){
            $('.covidTest').show();
        }else{
            $('.covidTest').hide();
        }
    });
    $("#ptn_other_comorbidity").on('change',function(e){
        $covidTest = $("#ptn_other_comorbidity").val();
        if($covidTest == 'yes'){
            $('.ptn_comorbidity').show();
        }else{
            $('.ptn_comorbidity').hide();
        }
    });
    $("#ptn_comorbidity").on('change',function(e){
        var ptn_comorbidity = $("#ptn_comorbidity").val();
        // alert(ptn_comorbidity)
        if(ptn_comorbidity == 6){ //other no is 6 in database
            $(".ptn_comorbidity_other_remark").show();
        }else{
            $(".ptn_comorbidity_other_remark").hide();
        }
    });
// }); 
</script>
<script type="text/javascript">
    $(document).ready(function(){      
      var i=1;  
   
      $('#add').click(function(){  
        //    i++;  
           var div = '<div class="row dynamic-added" id="row'+i+'" style="margin-left:0px">'
                        +'<div class="col-md-2">'
                          +'<div class="form-group">'
                            +'<input type="datetime-local" class="form-control" name="ptn_invistigation['+i+'][][date]" placeholder="Pincode" style="width: 100%;">'
                           +'</div>'
                        +'</div>'
                        +'<div class="col-md-10">'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="CBC" {{$disabled}}>'                          
                            +'<div class="label">CBC</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="HB" {{$disabled}}>'                                         
                            +'<div class="label">HB</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="CRP" {{$disabled}}>'                           
                            +'<div class="label">CRP</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="D-dimer" {{$disabled}}>'                           
                            +'<div class="label">D - dimer</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="Serum Ferrtin" {{$disabled}}>'                           
                            +'<div class="label">Serum Ferrtin</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="LDH" {{$disabled}}>'                          
                            +'<div class="label">LDH</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="LFT" {{$disabled}}>'                           
                            +'<div class="label">LFT</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="RFT" {{$disabled}}>'                           
                            +'<div class="label">RFT</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="Blood Sugar" {{$disabled}}>'                           
                            +'<div class="label">Blood Sugar</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="IL 6" {{$disabled}}>'                           
                            +'<div class="label">IL 6</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="Lipid Profile" {{$disabled}}>'                           
                            +'<div class="label">Lipid Profile</div></label>'
                            +'<label class="lableMargin"><input type="checkbox" class="" name="ptn_invistigation['+i+'][][inv]" id="" placeholder="" value="CPK-MB" {{$disabled}}>'                           
                            +'<div class="label">CPK-MB</div></label>&nbsp;&nbsp;&nbsp;&nbsp;'
                            +'<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" style="line-height: 0.5;border-radius: 46.25rem;">-</button><hr/>'
                        +'</div>'
                    +'</div>';
           $('#dynamic_field').append(div);  
           i++;
      });
  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
  
    });  
</script>
<!--Range Slider css and Js-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--End Range Slider css and Js-->
<script>
    $(function() {
        $( "#slider-range1" ).slider({
        range: true,
        min: 0,
        max: 200,
        //   values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#ptn_puls_rate" ).val(ui.values[ 1 ] );
        }
        });
        $( "#ptn_puls_rate" ).val();
    });
    $(function() {
        $( "#slider-range2" ).slider({
        range: true,
        min: 40,
        max: 300,
        //   values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#ptn_bp_systolic" ).val(ui.values[ 1 ] );
        }
        });
        $( "#ptn_bp_systolic" ).val();
    });
    $(function() {
        $( "#slider-range3" ).slider({
        range: true,
        min: 0,
        max: 130,
        //   values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#ptn_bp_diastolic" ).val(ui.values[ 1 ] );
        }
        });
        $( "#ptn_bp_diastolic" ).val();
    });
    $(function() {
        $( "#slider-range4" ).slider({
        range: true,
        min: 0,
        max: 100,
        //   values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#ptn_spo2" ).val(ui.values[ 1 ] );
        }
        });
        $( "#ptn_spo2" ).val();
    });
    $(function() {
        $( "#slider-range5" ).slider({
        range: true,
        min: 0,
        max: 40,
        //   values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#ptn_rr" ).val(ui.values[ 1 ] );
        }
        });
        $( "#ptn_rr" ).val();
    });
    $(function() {
        $( "#slider-range6" ).slider({
        range: true,
        min: 94,
        max: 108,
        //   values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#ptn_temp" ).val(ui.values[ 1 ] );
        }
        });
        $( "#ptn_temp" ).val();
    });
    $(function() {
        $( "#slider-range7" ).slider({
        range: true,
        min: 0,
        max: 25,
        //   values: [ 75, 300 ],
        slide: function( event, ui ) {
            $( "#ptn_hrct" ).val(ui.values[ 1 ] );
        }
        });
        $( "#ptn_hrct" ).val();
    });
    $(function () {
        $('select').selectpicker();
    });
    
</script>

<style>
label {
    display: inline-block;
    text-align: center;
}
.lableMargin{
    margin-right: 25px;
}
.ui-slider-horizontal {
    height: .6em !important;
}
.ui-slider-horizontal .ui-slider-handle {
    top: -.2em !important;
}
.ui-slider .ui-slider-handle {
    width: .9em;
    height: 0.9em;
}
.btn-light {
    border-color: #ced4da !important;
    background-color: #fff;
}
</style>