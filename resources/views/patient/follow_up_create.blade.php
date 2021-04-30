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
            @if($action == "Follow Up")
            <form method="post" id="patient_followup_form" name="" class="form-horizontal" action="javascript:void(0)">
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
                    <input type="hidden" name="patientId" value="{{$patient->pk_id}}">
                    <div class="row">
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
                    <lable class="lableColor">Blood Invistigation</lable><br/>
                    <div class="row" id="dynamic_field">
                        <div class="col-md-1">
                            <div class="form-group">
                            <input type="checkbox" class="" name="followup_blood_inv[]" id="followup_blood_inv" placeholder="Pincode" value="D-dimer" >                           
                            <label>D-dimer</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                            <input type="checkbox" class="" name="followup_blood_inv[]" id="followup_blood_inv" placeholder="Pincode" value="Sr.Creat" >                           
                            <label>Sr.Creat</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                            <input type="checkbox" class="" name="followup_blood_inv[]" id="followup_blood_inv" placeholder="Pincode" value="CRP" >                           
                            <label>CRP</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                            <input type="checkbox" class="" name="followup_blood_inv[]" id="followup_blood_inv" placeholder="Pincode" value="RFT" >                           
                            <label>RFT</label>
                            </div>
                        </div> 
                        <div class="col-md-1">
                            <div class="form-group">
                            <input type="checkbox" class="" name="followup_blood_inv[]" id="followup_blood_inv" placeholder="Pincode" value="Blood Sugar" >                           
                            <label>Blood Sugar</label>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>HRCT</label>
                                <input type="text" class="form-control" name="followup_hrct" id="ptn_hrct" placeholder="HRCT" style="width: 100%;" value="">
                                <div id="slider-range7" style="margin: 7px;"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Chest X-Ray</label>
                                <select name="followup_chest_x_ray"  id="followup_chest_x_ray" class="form-control" autocomplete="off">
                                    <option value="">Select Chest X-Ray</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                             
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(0 160 230);"/>
                    <div class="row" id="dynamic_field">
                        <div class="col-md-3">
                            <lable class="">Referring Doctor Details : </lable>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="followup_ref_doc_name" id="followup_ref_doc_name" placeholder="Name" value="">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="followup_ref_doc_cont_no" id="followup_ref_doc_cont_no" placeholder="Contact No." value="">
                        </div>
                    </div><hr>
                    <div class="row" id="dynamic_field">
                        <div class="col-md-3">
                            <lable class="">Attending Doctor / Consultant / Physician Details22 : </lable>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="followup_atnd_doc_name" id="followup_atnd_doc_name" placeholder="Name" value="">
                            <span class="text-danger error-text followup_atnd_doc_name_err"></span>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="followup_atnd_doc_cont_no" id="followup_atnd_doc_cont_no" placeholder="Contact No." value="">
                        </div>
                    </div><hr>
                    <div class="row" id="dynamic_field">
                        <div class="col-md-3">
                            <lable class="">Hospital Details : </lable>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="followup_hosp_name" id="followup_hosp_name" placeholder="Name" value="">
                            <span class="text-danger error-text followup_hosp_name_err"></span>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="followup_hosp_cont_no" id="followup_hosp_cont_no" placeholder="Contact No." value="">
                        </div>
                    </div>
                    <hr style="border-top: 2px solid rgb(0 160 230);"/>
                    <div class="row" id="dynamic_field">
                        <div class="col-md-1">
                            <lable class="">Patient Status : </lable>
                        </div>
                        <div class="col-md-2">
                            <select name="followup_status"  id="followup_status" class="form-control" autocomplete="off">
                                <option value="">Select Patient Status</option>
                                <option value="discharge">Discharge</option>
                                <option value="death">Death</option>
                                <option value="followup">Followup</option>
                            </select>   
                            <span class="text-danger error-text followup_status_err"></span>
                        </div>
                        <div class="col-md-1">
                            <lable class="">Remark : </lable>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="followup_remark" id="followup_remark" placeholder="Remark" value="">   
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
<script>
    $(".btn-submit").click(function(e){
        e.preventDefault();
        if($('#patient_followup_form').serialize()!=""){
            var form = $('#patient_followup_form');
            $url = "{{ route('patient.follow_up_store') }}";
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
</script>
<style>
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
</style>