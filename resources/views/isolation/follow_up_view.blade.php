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
            <div class="card card-warning"> 
            <!-- collapsed-card -->
                <div class="card-header">
                    <h3 class="card-title">{{ $action }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach ($patientFollowup as $groups)
                        <button class="accordion">Followup <?=$i?></button>


                   

                            
                        <div class="panel">

                        <?php 
                   // var_dump($i);die();  
                      if($i==1){
?>
                        <div class="col-md">
                        <label>Blood Investigation : </label>
                        <label>{{$groups->followup_blood_inv}}</label>
                    </div>
                    <div class="col-md"> 
                        <label>HRCT : </label>
                        <label>{{$groups->followup_hrct}}</label>
                    </div>
                    <div class="col-md">
                        Chest X-Ray : <label>{{$groups->followup_chest_x_ray}}</label>
                    </div>
                    <div class="col-md">
                    <b>Referring Doctor Details : </b>
                        <p style="margin: 0 0;">
                            <lable>Name : </lable><label>{{$groups->followup_ref_doc_name}}</label>
                        </p>
                        <p>
                            <lable> Contact No : </lable><label>{{$groups->followup_ref_doc_cont_no}}</label>
                        </p>
                    </div>
                    <div class="col-md">
                        <b>Attending Doctor / Consultant / Physician Details : </b>
                        <p style="margin: 0 0;">
                            <lable>Name : </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                        </p>
                        <p>
                            <lable> Contact No : </lable><label>{{$groups->followup_atnd_doc_cont_no}}</label>
                        </p>
                    </div>

                    
                    <div class="col-md">
                        <b>Remark : </b><label>{{$groups->followup_hosp_name}}</label>        
                    </div>

                    <div class="col-md">
                        <b>Hospital Detais : </b>
                             <div >
                            <lable>Name : </lable><label>{{$groups->followup_hosp_name}}</label>
                        </div>
                        <div >
                            <lable> Contact No : </lable><label>{{$groups->followup_hosp_cont_no}}</label>
                            </div>
                    </div>

<?php
                        }
                    
                           ?>


                            

                            <div class="col-md">
                                <b> Details </b>
                                <p style="margin: 0 0;">
                                    <lable>Test Invistigation Advised : </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Visit Date : </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Advice Given : </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Breathlessness : </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Chest Pain: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>

                                <p style="margin: 0 0;">
                                    <lable> SPO2: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Pulse: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>

                                <p style="margin: 0 0;">
                                    <lable> RR: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>

                                <p style="margin: 0 0;">
                                    <lable> Fever: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>

                                <p style="margin: 0 0;">
                                    <lable> Cough: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Diarrhea: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Comorbility: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                                <p style="margin: 0 0;">
                                    <lable> Call Status: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>

                                <p >
                                    <lable> Close Call: </lable><label>{{$groups->followup_atnd_doc_name}}</label>
                                </p>
                            </div>

                            

                            
                        </div>
                        <?php $i++ ?>
                        @endforeach

                    </div>
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
<script src="{{ url('/')}}/resources/custom/inc_map_here.js"></script>
<style>
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: #900808 !important;
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

.active, .accordion:hover {
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