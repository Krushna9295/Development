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
                        <a class="fas fa-backward" href="{{ route('user.list') }}"> Go back</a>
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
            @if(!isset($user->id) && $action == "Register New User")
            <form method="post" id="users_form" name="" class="form-horizontal" action="javascript:void(0)" enctype="multipart/form-data">
            @elseif($action == "Update User")
            <form method="post" id="users_update_form" name="modalFormData" class="form-horizontal" action="javascript:void(0)">
            @method('PATCH')
            @else
                <form method="post"  name="modalFormData" class="form-horizontal" action="">
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
                
                <!-- <h3 style= "text-align:center">hi</h3> -->
                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control select2" id="clg_first_name" name="clg_first_name" placeholder="First Name" style="width: 100%;" value="{{ isset($user) ? $user->clg_first_name : '' }}" {{$disabled}} >
                                <span class="text-danger error-text clg_first_name_err"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" name="clg_mid_name" id="clg_mid_name" placeholder="Middle Name" style="width: 100%;" value="{{ isset($user) ? $user->clg_mid_name : '' }}" {{$disabled}} autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="clg_last_name" id="clg_last_name" placeholder="Last Name" style="width: 100%;" value="{{ isset($user) ? $user->clg_last_name : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text clg_last_name_err"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="clg_mobile_no" id="clg_mobile_no" placeholder="Mobile Number" style="width: 100%;" value="{{ isset($user) ? $user->clg_mobile_no : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text clg_mobile_no_err"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email ID</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email ID" style="width: 100%;" value="{{ isset($user) ? $user->email : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text email_err"></span>
                            </div>
                        </div>
                      
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="clg_dob" id="clg_dob" placeholder="Date of Birth" style="width: 100%;" value="{{ isset($user) ? $user->clg_dob : '' }}"  {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text clg_dob_err"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <input type="date" class="form-control" name="clg_joining_date" id="clg_joining_date" placeholder="Joining Date" style="width: 100%;" value="{{ isset($user) ? $user->clg_joining_date : '' }}" {{$disabled}} autocomplete="off">
                                <span class="text-danger error-text clg_joining_date_err"></span>                               
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Group</label>
                                <select id="mySelect" name="clg_group" class="form-control" {{$disabled}} onchange="myFunction()">
                                <option value="">Select Area</option>
                                @foreach ($groups as $groups)

                                <option  value="{{ $groups->gcode }}"  @if(isset($user)){{($groups->gcode == $user->clg_group) ? 'selected' : ''}} @endif> {{{ $groups->ugname }}}</option>
                            
                                @endforeach
                                </select>
                                <span class="text-danger error-text clg_group_err"></span>                                
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ref ID</label>
                                <input type="text" class="form-control select2" id="clg_ref_id" name="clg_ref_id" placeholder="Colleague ref id" style="width: 100%;" value="{{ isset($user) ? $user->clg_ref_id : '' }}" {{$disabled}}  >
                                <span class="text-danger error-text clg_ref_id_err"></span>                           
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control select2" id="password" name="clg_password" placeholder="Password" style="width: 100%;" value="{{ isset($user) ? $user->password : '' }}" {{$disabled}} >
                                <span class="text-danger error-text clg_password_err"></span>
                            </div>
                        </div>
                        

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User Gender</label>

                                <select name="clg_gender" class="form-control" {{$disabled}}>
                                <option value="">Select User Gender</option>
                            
                                <option value="male" @if(isset($user)){{("male" == $user->clg_gender) ? 'selected' : ''}} @endif> Male</option>
                                <option value="female" @if(isset($user)){{("female" == $user->clg_gender) ? 'selected' : ''}} @endif>Female</option>
                                <option value="other" @if(isset($user)){{("other" == $user->clg_gender) ? 'selected' : ''}} @endif>Other</option>
                                
                                </select>
                                <span class="text-danger error-text clg_gender_err"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Marital Status</label>

                                <select name="clg_marital_status" class="form-control" {{$disabled}}>
                                <option value="">Select Marital Status</option>
                                <option value="Married" @if(isset($user)){{("Married" == $user->clg_marital_status) ? 'selected' : ''}} @endif>Married</option>
                                <option value="Unmarried" @if(isset($user)){{("Unmarried" == $user->clg_marital_status) ? 'selected' : ''}} @endif> Unmarried</option>
                                </select>
                                <span class="text-danger error-text clg_marital_status_err"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Address</label></br>
                            <input type="text" class="form-control" name="clg_address" id="inc_map_address" placeholder="Address" style="width: 100%;" value="{{ isset($user) ? $user->clg_address : '' }}" {{$disabled}}>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                            <label>State</label>
                            <select id="state" name="clg_state" class="form-control" {{$disabled}} >
                                <option value="">Select State</option>
                                @foreach ($state as $groups)

                                <option  value="{{ $groups->st_code }}"  @if(isset($user)){{($groups->st_code == $user->clg_state) ? 'selected' : ''}} @endif> {{{ $groups->st_name }}}</option>
                            
                                @endforeach
                            </select>                            
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>District</label>
                                <select id="district" name="clg_district" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select District</option>
                                    @foreach ($district as $groups)
                                    <option  value="{{ $groups->dst_code }}"  @if(isset($user)){{($groups->dst_code == $user->clg_district) ? 'selected' : ''}} @endif> {{{ $groups->dst_name }}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tahsil</label>
                                <select name="clg_tahsil"  id="tahshil" class="form-control" {{$disabled}} autocomplete="off">
                                <option value="">Select Tahsil</option>
                                @foreach ($tahsil as $groups)

                                <option  value="{{ $groups->thl_code }}"  @if(isset($user)){{($groups->thl_code == $user->clg_tahsil) ? 'selected' : ''}} @endif> {{{ $groups->thl_name }}}</option>
                            
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>City</label>
                                <select name="clg_city"  id="city" class="form-control" {{$disabled}} autocomplete="off">
                                    <option value="">Select City</option>
                                    @foreach ($city as $groups)

                                    <option  value="{{ $groups->cty_id }}"  @if(isset($user)){{($groups->cty_id == $user->clg_city) ? 'selected' : ''}} @endif> {{{ $groups->cty_name }}}</option>
                                
                                    @endforeach
                                    </select>                            
                            </div>
                        </div>
                    </div>
                                
                    @if($action != "View User")
                    <div class="row">
                        <div class="offset-md-6 col-md-2">
                            <div class="form-group btn-group">
                            <input type="Submit" class="form-control btn btn-primary left btn-submit" placeholder="Submit" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
             
            </div>
            </form>
        </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

     @include('template.footer')
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
</body>
</html>
<script>
function myFunction() {
  //var x = document.getElementById("mySelect").value;
 var clg_gp_name = $("#mySelect :selected").val();

// alert(clg_gp_name);
 let _url1 = base_url+`/fetch_clg_ref_id/${clg_gp_name}`;

                $.ajax({
                    type: 'GET',
                    url: _url1,
                    data: {gcode: clg_gp_name},
                    dataType: 'json',
                    success: function (data) {
                        if(data){
                            $('#clg_ref_id').val(data);
                        } 
                    }
                });
//  alert(y);
//   document.getElementById("demo").innerHTML = "You selected: " + x;
}
</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<style>
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: #900808 !important;
    }
</style>
<script>
      @include("layouts.laracrud")
</script>
<script>
    $(".btn-submit").click(function(e){
        
        e.preventDefault();
        if($('#users_form').serialize()!=""){
            var form = $('#users_form');
            $url = "{{ route('user.store') }}";
        }else if($('#users_update_form').serialize()!=""){
            var form = $('#users_update_form');
            <?php if(isset($user->id)){ ?>
                $url = "{{action('App\Http\Controllers\UserController@update',"$user->id" )}}";
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
                    window.location.href = "{{route('user.list')}}"
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
