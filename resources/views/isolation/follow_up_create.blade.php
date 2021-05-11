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
                    <form method="post" id="isolation_followup_form" name="" class="form-horizontal" action="javascript:void(0)">
                        @elseif($action == "Update Patient")
                        <form method="post" id="isolation_update_form" name="modalFormData" class="form-horizontal" action="javascript:void(0)">
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
                                        <!-- krishna   -->
                                    <div class="card-body">
                                        <input type="hidden" name="patientId" value="{{$patient->pk_id}}">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>ICMR ID: </label>
                                                    <lable>{{$patient->icmr_id}}</lable>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Patient Name : </label>
                                                    <lable>{{$patient->ptn_name}}</lable>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" id="No">
                                                    <label>Patient Contact No : </label>
                                                    <lable>{{$patient->ptn_contact_no}}</lable>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group" id="age">
                                                    <label>Patient Age : </label>
                                                    <lable>{{$patient->ptn_age}}</lable>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group" id="gender">
                                                    <label>Patient Gender : </label>
                                                    <lable>{{$patient->ptn_gender}}</lable>
                                                </div>
                                                <style>
                                                    /* #gender {
                                                        position: relative;
                                                        left: 420px;
                                                    }

                                                    #No {
                                                        position: relative;
                                                        left: 100px;
                                                    }

                                                    #age {
                                                        position: relative;
                                                        left: 250px;
                                                    } */
                                                </style>
                                            </div>
                                        </div>
                                        <hr style="border-top: 2px solid rgb(0 160 230);" />
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Call Status</label>
                                                    <select name="iso_followup_call_status" id="iso_followup_call_status" onchange="changeFunc1();" class="form-control" autocomplete="off">
                                                        <option value="">Select Status</option>
                                                        <option value="1">Call Answered</option>
                                                        <option value="2">Call Not Answered</option>
                                                        <option value="3">Call Not Connect</option>
                                                        <option value="4">Othert</option>
                                                    </select>
                                                    <span class="text-danger error-text iso_followup_call_status_err"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="display:none" id="iso_call_status_other_div">
                                                <div class="form-group">
                                                    <label>Call Status Other</label>
                                                    <input type="text" class="form-control" name="iso_call_status_other" id="iso_call_status_other" placeholder="Call Status Other">
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="iso_followup_call_not_con_div">
                                                <div class="form-group">
                                                    <label>Call Not Connected Reason</label>
                                                    <select name="iso_followup_call_not_con" id="iso_followup_call_not_con" onchange="changeFunc2();" class="form-control" autocomplete="off">
                                                        <option value="">Select Status</option>
                                                        <option value="1">Switch Off</option>
                                                        <option value="2">Not Reachable</option>
                                                        <option value="3">Wrong Number</option>
                                                        <option value="4">Othert</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="iso_followup_call_not_con_div_other">
                                                <div class="form-group">
                                                    <label>Call Not Connected Other Reason</label>
                                                    <input type="text" class="form-control" name="iso_call_not_con_other_res" placeholder="Reason">
                                                </div>
                                            </div>
                                        </div>
                                        @if(count($patientFollowup) >= 1)
                                        <hr style="border-top: 2px solid rgb(0 160 230);" />
                                        <div class="row">
                                            <?php $i = 1; ?>
                                            @foreach ($patientFollowup as $groups)
                                            <button class="accordion">Followup <?= $i ?></button>
                                            <div class="panel">
                                                <?php
                                                if ($i == 1) { ?>
                                                    <div class="col-md">
                                                        <div class="DInfo">
                                                            <b>Consultant Doctor Details : </b>
                                                            <p style="margin-left:3em">
                                                                <lable>Name : </lable><label>{{$groups->iso_doctor_name}}</label>
                                                            </p>
                                                            <p style="margin-left:3em">
                                                                <lable> Contact No : </lable><label>{{$groups->iso_doctor_cont_no}}</label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-md">
                                                    <div class="Info">
                                                        <b> Details: </b>
                                                        <?php if ($i == 1) { ?>
                                                            <p style="margin-left:2.7em">
                                                                <lable>On Set of Illness Since : </lable><label>{{$groups->iso_on_set_of_illness}}</label>
                                                            </p>
                                                            <p style="margin-left:8em">
                                                                <lable>Test Invistigation Advised : </lable><label>{{$groups->iso_test_inv_advised}}</label>
                                                            </p>
                                                            <!-- <p style="margin: 0 0;">
                                    <lable> No of Visits Date Wise T/T : </lable><label>{{$groups->iso_no_visit_date_wise_t_t}}</label>
                                </p> -->
                                                            <p style="margin-left:8em">
                                                                <lable> T/ T Given or Advice Given : </lable><label>{{$groups->iso_t_t_givenor_adv_given}}</label>
                                                            </p>
                                                            <p style="margin-left:8em">
                                                                <lable> Advice Given Other : </lable><label>{{$groups->iso_t_t_givenor_adv_given_other}}</label>
                                                            </p>
                                                    </div>
                                                    <div class="Info_1">
                                                    <?php } ?>
                                                    <p style="margin-left:6em">
                                                        <lable> Breathlessness : </lable><label>{{$groups->iso_breath}}</label>
                                                    </p>
                                                    <p style="margin-left:12em">
                                                        <lable> Chest Pain: </lable><label>{{$groups->iso_chest_pain}}</label>
                                                    </p>
                                                    <p style="margin-left:15em">
                                                        <lable> SPO2: </lable><label>{{$groups->iso_spo_two}}</label>
                                                    </p>
                                                    <p style="margin-left:25.7em">
                                                        <lable> Pulse: </lable><label>{{$groups->iso_pulse}}</label>
                                                    </p>
                                                    </div>
                                                        <div class="Info_2">
                                                    <p style="margin-left:6em">
                                                        <lable> RR: </lable><label>{{$groups->iso_rr}}</label>
                                                    </p>
                                                    <p style="margin-left:17.7em">
                                                        <lable> Fever: </lable><label>{{$groups->iso_fever}}</label>
                                                    </p>
                                                    <p style="margin-left:16.7em">
                                                        <lable> Cough: </lable><label>{{$groups->iso_cough}}</label>
                                                    </p>
                                                    <p style="margin-left:24.7em">
                                                        <lable> Diarrhea: </lable><label>{{$groups->iso_diarrhea}}</label>
                                                    </p>
                                                    </div>
                                                    <div class="Info_3">
                                                        <p style="margin-left:6em">
                                                            <lable> Comorbility: </lable><label>{{$groups->iso_comorbidity}}</label>
                                                        </p>
                                                        <p style="margin-left:10.4em">
                                                            <lable> Comorbility Other : </lable><label>{{$groups->iso_comorbidity_other}}</label>
                                                        </p>
                                                        <?php $a = $groups->iso_followup_call_status;
                                                        if ($a == '1') {
                                                            $callStatus = 'Call Answered';
                                                        } else if ($a == '2') {
                                                            $callStatus = 'Call Not Answered';
                                                        } else if ($a == '3') {
                                                            $callStatus = 'Call Not Connect';
                                                        } else {
                                                            $callStatus = 'Other';
                                                        }
                                                        ?>
                                                        <p style="margin-left:9.2em">
                                                            <lable> Call Status: </lable><label><?= $callStatus ?></label>
                                                        </p>
                                                        <?php $a = $groups->iso_close_call;
                                                        if ($a == '1') {
                                                            $callClose = 'Call Not Close';
                                                        } else if ($a == '2') {
                                                            $callClose = 'Close Call';
                                                        }
                                                        ?>
                                                        <p style="margin-left:18    .7em">
                                                            <lable> Close Call: </lable><label><?= $callClose ?></label>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <style>
                                            .Info {
                                                display: flex;
                                            }

                                            .DInfo {
                                                display: flex;


                                            }
                                            .Info_1 {
                                                display: flex;
                                                white-space: nowrap;

                                            }
                                            .Info_2 {
                                                display: flex;
                                            }
                                            .Info_3{
                                                display: flex;
                                            }
                                        </style>
                                        <?php $i++ ?>
                                        @endforeach
                                    </div>
                                    @endif
                                    <hr style="border-top: 2px solid rgb(0 160 230);" />
                                    @if(count($patientFollowup) == 0 || count($patientFollowup) < 1) <div class="row showdiv">
                                        <div class="col-md-2">
                                            <label>Oncet Of Illness Since:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="iso_on_set_of_illness" placeholder="Oncet Of Illness Since">
                                        </div>
                                        <div class="col-md-1" id="dd">
                                            <lable class="">Doctor Details : </lable>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="iso_doctor_name" id="iso_doctor_name" placeholder="Doctor Name" value="">
                                            <span class="text-danger error-text iso_doctor_name_err"></span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="iso_doctor_cont_no" id="iso_doctor_cont_no" placeholder="Doctor Contact No." value="">
                                        </div>
                                </div>
                                <hr class="showdiv">
                                @endif
                                <div class="row showdiv">
                                    <div class="col-md-2">
                                        @if(count($patientFollowup) >= 1)
                                        <label>Test/Investigation Doned:</label>
                                        @endif
                                        @if(count($patientFollowup) == 0 || count($patientFollowup) < 1) <label>Test/Investigation Advised:</label>
                                            @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="iso_test_inv_advised" id="iso_test_inv_advised" class="radio" value="yes">&nbsp;&nbsp;<label>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="iso_test_inv_advised" id="iso_test_inv_advised" class="radio" value="no">&nbsp;&nbsp;<label>No</label>
                                        <!-- <select name="iso_test_inv_advised"  id="iso_test_inv_advised" class="form-control" autocomplete="off">
                                <option value="">Select Advised</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select> -->
                                    </div>
                                    <div class="col-md-1.7" id="Gag">
                                        <lable class="">T/T Given or Advice Given: </lable>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <input type="text" class="form-control" name="iso_t_t_givenor_adv_given" id="iso_doctor_name" placeholder="T/T Givenor Advice Given" value=""> -->
                                        <select name="iso_t_t_givenor_adv_given[]" id="iso_t_t_givenor_adv_given" multiple="multiple" class="form-control selectpicker" autocomplete="off">
                                            <option value="">Select Advice Given</option>
                                            <option value="Vitamin C">Vitamin C</option>
                                            <option value="Vitamin B">Vitamin B</option>
                                            <option value="Vitamin Zink">Vitamin Zink</option>
                                            <option value="Paractamol">Paractamol</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1.7" id="Ago">
                                        <lable class="">Advice Given Other: </lable>
                                    </div>
                                    <style>
                                        #Ago,#Gag,#dd{
                                            margin-top: 5px;
                                        }
                                    </style>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="iso_t_t_givenor_adv_given_other" id="iso_t_t_givenor_adv_given_other" placeholder="T/T Givenor Advice Given" value="">
                                    </div>
                                </div>
                                <hr class="showdiv">

                                <div class="row showdiv">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Breathlessness</label><br>
                                            <input type="radio" name="iso_breath" id="iso_breath" class="radio" value="yes">&nbsp;&nbsp;<label>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="iso_breath" id="iso_breath" class="radio" value="no">&nbsp;&nbsp;<label>No</label>
                                            <!-- <select name="iso_breath" id="iso_breath" class="form-control" autocomplete="off">
                                    <option value="">Select Breathlessness</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                              -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Chest Pain</label><br>
                                            <input type="radio" name="iso_chest_pain" class="radio" value="yes">&nbsp;&nbsp;<label>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="iso_chest_pain" class="radio" value="no">&nbsp;&nbsp;<label>No</label>
                                            <!-- <select name="iso_chest_pain" id="iso_chest_pain" class="form-control" autocomplete="off">
                                    <option value="">Select Chest Pain</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                              -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Fever</label><br>
                                            <input type="radio" name="iso_fever" class="radio" value="yes">&nbsp;&nbsp;<label>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="iso_fever" class="radio" value="no">&nbsp;&nbsp;<label>No</label>
                                            <!-- <select name="iso_fever" id="iso_fever" class="form-control" autocomplete="off">
                                    <option value="">Select Fever</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                              -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Cough</label><br>
                                            <input type="radio" name="iso_cough" class="radio" value="yes">&nbsp;&nbsp;<label>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="iso_cough" class="radio" value="no">&nbsp;&nbsp;<label>No</label>
                                            <!-- <select name="iso_cough" id="iso_cough" class="form-control" autocomplete="off">
                                    <option value="">Select Cough</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                              -->
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Diarrhea</label><br>
                                            <input type="radio" name="iso_diarrhea" class="radio" value="yes">&nbsp;&nbsp;<label>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="iso_diarrhea" class="radio" value="no">&nbsp;&nbsp;<label>No</label>
                                            <!-- <select name="iso_diarrhea" id="iso_diarrhea" class="form-control" autocomplete="off">
                                    <option value="">Select Diarrhea</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>                              -->
                                        </div>
                                    </div>
                                    @if(count($patientFollowup) == 0 || count($patientFollowup) < 1) <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Comorbidity</label>
                                            <select name="iso_comorbidity[]" id="iso_comorbidity" multiple="multiple" class="form-control selectpicker" autocomplete="off">
                                                <option value="">Select Comorbidity</option>
                                                <option value="Diabetes">Diabetes</option>
                                                <option value="Asthma">Asthma</option>
                                                <option value="Hypertension">Hypertension</option>
                                                <option value="Cancer">Cancer</option>
                                                <option value="HIV">HIV</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <!-- <input type="text" name="iso_comorbidity" class="form-control" placeholder="Comorbidity">                             -->
                                        </div>
                                </div>
                                @endif
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Comorbidity Other</label>
                                        <input type="text" name="iso_comorbidity_other" class="form-control" placeholder="Comorbidity">
                                    </div>
                                </div>
                </div>
                <hr class="showdiv">
                <div class="row showdiv">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>SPO2</label>
                            <input type="text" class="form-control" name="iso_spo_two" id="iso_spo_two" placeholder="SpO2" style="width: 100%;" value="">
                            <div id="slider-range1" style="margin: 7px;"></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pulse</label>
                            <input type="text" class="form-control" name="iso_pulse" id="iso_pulse" placeholder="Pulse" style="width: 100%;" value="">
                            <div id="slider-range2" style="margin: 7px;"></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>RR</label>
                            <input type="text" class="form-control" name="iso_rr" id="iso_rr" placeholder="RR" style="width: 100%;" value="">
                            <div id="slider-range3" style="margin: 7px;"></div>
                        </div>
                    </div>
                </div>
                <hr class="showdiv">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Remark</label>
                            <input type="text" class="form-control" name="iso_remark" id="iso_remark" placeholder="Remark" style="width: 100%;" value="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Close Call</label>
                            <select name="iso_close_call" id="iso_close_call" class="form-control" autocomplete="off">
                                <option value="">Select Close Call</option>
                                <option value="1">Call Not Close</option>
                                <option value="2">Call Close</option>
                            </select>
                            <span class="text-danger error-text iso_close_call_err"></span>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 2px solid rgb(0 160 230);" />
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
    <style>
        @media only screen and (min-width: 400px) {
            .content{
                max-width: 100% !important;
            }
        }
    </style>
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
    $(document).ready(function() {
        $('#iso_followup_call_not_con_div').hide();
        $('#iso_followup_call_not_con_div_other').hide();
        $('.showdiv').hide();
        //$('#grievance_div').hide();
    });


    function changeFunc1() {
        var iso_followup_call_status = document.getElementById("iso_followup_call_status");
        var selectedValue = iso_followup_call_status.options[iso_followup_call_status.selectedIndex].value;
        if (selectedValue == "3") {
            $('#iso_followup_call_not_con_div').show();
        } else {
            $('#iso_followup_call_not_con_div').hide();
        }
        if (selectedValue == "4") {
            $('#iso_call_status_other_div').show();
        } else {
            $('#iso_call_status_other_div').hide();
        }
        if (selectedValue == "1") {
            $('.showdiv').show();
        } else {
            $('.showdiv').hide();
        }
    }

    function changeFunc2() {
        var iso_followup_call_status = document.getElementById("iso_followup_call_not_con");
        var selectedValue = iso_followup_call_status.options[iso_followup_call_status.selectedIndex].value;
        if (selectedValue == "4") {
            $('#iso_followup_call_not_con_div_other').show();
        } else {
            $('#iso_followup_call_not_con_div_other').hide();
        }
    }


    $(".btn-submit").click(function(e) {
        e.preventDefault();
        if ($('#isolation_followup_form').serialize() != "") {
            var form = $('#isolation_followup_form');
            $url = "{{ route('isolation.follow_up_store') }}";
        } else if ($('#isolation_update_form').serialize() != "") {
            var form = $('#patient_update_form');
            <?php if (isset($patient->pk_id)) { ?>
                $url = "{{action ('App\Http\Controllers\PatientController@update', $patient -> pk_id )}}";
            <?php } ?>
        }
        var formData = form.serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $url,
            type: 'POST',
            data: formData,
            success: function(data) {
                // console.log(data);
                if ($.isEmptyObject(data.error)) {
                    window.location.href = "{{route('patient.list')}}"
                } else {
                    printErrorMsg(data.error);
                }
            }
        });
    });

    function printErrorMsg(msg) {
        $.each(msg, function(key, value) {
            console.log(value);
            $('.' + key + '_err').text(value);
        });
    }
    $(function() {
        $("#slider-range1").slider({
            range: true,
            min: 0,
            max: 94,
            //   values: [ 75, 300 ],
            slide: function(event, ui) {
                $("#iso_spo_two").val(ui.values[1]);
            }
        });
        $("#iso_spo_two").val();
    });
    $(function() {
        $("#slider-range2").slider({
            range: true,
            min: 62,
            max: 90,
            //   values: [ 75, 300 ],
            slide: function(event, ui) {
                $("#iso_pulse").val(ui.values[1]);
            }
        });
        $("#iso_pulse").val();
    });
    $(function() {
        $("#slider-range3").slider({
            range: true,
            min: 0,
            max: 30,
            //   values: [ 75, 300 ],
            slide: function(event, ui) {
                $("#iso_rr").val(ui.values[1]);
            }
        });
        $("#iso_rr").val();
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

    .radio {
        width: 15px;
        height: 15px;
    }
</style>
<style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    .active,
    .accordion:hover {
        background-color: #ccc;
    }

    .accordion:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
    }

    .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }
</style>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>