@include('template.header')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">
    @include('template.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User List</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('user.create') }}" role="button">Add New User</a>
                    </div>
                </div>
            </div>
        </section>
        @if (Session::has("success"))
        <div class="container-fluid">
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ Session::get("success") }}
            </div>
        </div>
        @endif
       
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>
                        </div>
                       
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Clg Ref Id</th>
                                        <th>User Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Group</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($userData as $groups)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $groups->clg_ref_id }}</td>
                                        <td>{{ $groups->clg_first_name }}</td>
                                        <td>{{ $groups->clg_mobile_no }}</td>
                                        <td>{{ $groups->email }}</td>
                                        <td>{{ $groups->clg_group }}</td>
                                        <td>{{ $groups->clg_status }}</td>
                                        <td>
                                            <a href="{{ route('user.edit',$groups->id) }}" title="edit">
                                                <i class="fa fa-edit text-blue fa-sm"></i>
                                            </a>
                                            <a href="{{ route('user.view',$groups->id) }}" title="show">
                                                <i class="fa fa-eye text-green fa-sm"></i>
                                            </a>
                                            <a  onclick="if(confirm('Do you want to delete this user..?'))event.preventDefault(); document.getElementById('delete-{{$groups->id}}').submit();" href="{{ route('user.destroy',$groups->id) }}" title="delete">
                                                <i class="fa fa-trash text-red fa-sm"></i>
                                            </a>
                                            <form id="delete-{{$groups->id}}" method="post" action="{{route('user.destroy',$groups->id)}}" style="display: none;">
                                            @csrf
                                            {{ method_field('PATCH') }}
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                     
                    </div>
                </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<style>
    .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: #900808 !important;
    }
</style>
<script>
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    }); 
</script>