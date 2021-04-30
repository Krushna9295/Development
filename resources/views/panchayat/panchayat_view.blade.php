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
                    <a class="fas fa-backward" href="{{ route('panchayat.list') }}"> Go back</a>
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
            @if(!isset($panchayat->id) && $action == "Add New Panchayat")
            <form method="post" id="panchayat_form" name="" class="form-horizontal" >
            @elseif($action == "Update Panchayat")
            <form method="post" id="panchayat_update_form" name="modalFormData" class="form-horizontal" >
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Panchayat Name</label>
                                <input type="text" class="form-control select2" id="panchayat_name" name="panchayat_name" placeholder="panchayat Name" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->panchayat_name : '' }}" {{$disabled}} >
                                <span class="text-danger error-text panchayat_name_err"></span>                           
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="panchayat_contact_no" id="panchayat_contact_no" placeholder="Contact Number" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->panchayat_contact_no : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text panchayat_contact_no_err"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text" class="form-control" name="hp_register_no" id="hp_register_no" placeholder="Registration No" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_register_no : '' }}" {{$disabled}} autocomplete="off">
                            </div>
                            <span class="text-danger error-text hp_register_no_err"></span>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="text" class="form-control" name="hp_email" id="hp_email" placeholder="Email ID" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_email : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text hp_email_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>panchayat URL</label>
                                <input type="text" class="form-control" name="hp_url" id="hp_url" placeholder="https://www.yourwebsite.com" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_url : '' }}"  {{$disabled}} autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Radius for Geo-fencing</label>
                                <input type="text" class="form-control" name="hp_geo_fence" id="hp_geo_fence" placeholder="Radius for Geo-fencing" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_geo_fence : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text hp_geo_fence_err"></span>
                            </div>
                        </div>
                    </div>
                    <!-- <hr style="border-top: 2px solid rgb(255 193 7);"/> -->
                    
                    <hr style="border-top: 2px solid rgb(255 193 7);"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label></br>
                                <input type="text" class="form-control" name="hp_address" id="hp_address" onFocus="geocoding_add(hp_address, hp_lat, hp_long)"  placeholder="Address" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_address : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text hp_address_err"></span>                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>State</label>
                                
                                <select id="state" name="hp_state" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select State</option>
                                @foreach ($state as $groups)

                                <option  value="{{ $groups->st_code }}"  @if(isset($panchayat)){{($groups->st_code == $panchayat->hp_state) ? 'selected' : ''}} @endif> {{{ $groups->st_name }}}</option>
                            
                                @endforeach
                                </select>
                                <span class="text-danger error-text hp_state_err"></span>
                             
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>District</label>
                                <select id="district" name="hp_district" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select District</option>
                                @foreach ($district as $groups)
                                <option  value="{{ $groups->dst_code }}"  @if(isset($panchayat)){{($groups->dst_code == $panchayat->hp_district) ? 'selected' : ''}} @endif> {{{ $groups->dst_name }}}</option>
                                @endforeach
                                </select>
                                <span class="text-danger error-text hp_district_err"></span>                    
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahsil</label>
                                <select name="hp_tahsil"  id="tahshil" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select Tahsil</option>
                                @foreach ($tahsil as $groups)

                                <option  value="{{ $groups->thl_code }}"  @if(isset($panchayat)){{($groups->thl_code == $panchayat->hp_tahsil) ? 'selected' : ''}} @endif> {{{ $groups->thl_name }}}</option>
                            
                                @endforeach
                                </select>
                                <span class="text-danger error-text hp_tahsil_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>City</label>
                                <select name="hp_city"  id="city" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select City</option>
                                @foreach ($city as $groups)

                                <option  value="{{ $groups->cty_id }}"  @if(isset($panchayat)){{($groups->cty_id == $panchayat->hp_city) ? 'selected' : ''}} @endif> {{{ $groups->cty_name }}}</option>
                            
                                @endforeach
                                </select>
                                <span class="text-danger error-text hp_city_err"></span> 
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label>Area/Location</label>
                                <input type="text" class="form-control" name="hp_area" id="hp_area" placeholder="Area/Location" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_area : '' }}" {{$disabled}} autocomplete="off">
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Landmark</label>
                                <input type="text" class="form-control" name="hp_landmark" id="hp_landmark" placeholder="Landmark" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_landmark : '' }}" {{$disabled}} autocomplete="off">
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                            <label>Lane/Street</label>
                            <input type="text" class="form-control" name="hp_lane_street" id="	hp_lane_street" placeholder="Lane/Street" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_lane_street : '' }}" {{$disabled}}>
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>House No</label>
                            <input type="text" class="form-control" name="hp_house_no" id="	hp_house_no" placeholder="Lane/Street" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_house_no : '' }}" {{$disabled}}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" class="form-control" name="hp_pincode" id="hp_pincode" placeholder="Pincode" style="width: 100%;" value="{{ isset($panchayat) ? $panchayat->hp_pincode : '' }}" {{$disabled}} autocomplete="off">
                            </div>
                        </div> -->
                    </div>
                    @if($action != "View panchayat")
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
        if($('#panchayat_form').serialize()!=""){
            var form = $('#panchayat_form');
            $url = "{{ route('panchayat.store') }}";
        }else if($('#panchayat_update_form').serialize()!=""){
            var form = $('#panchayat_update_form');
            <?php if(isset($panchayat->hp_id)){ ?>
                $url = "{{action( 'App\Http\Controllers\panchayatController@update',"$panchayat->hp_id" )}}";
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
                    window.location.href = "{{route('panchayat.list')}}"
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