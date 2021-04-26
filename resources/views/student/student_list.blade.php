@include('template.header')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">
    @include('template.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('student.create') }}" role="button">Add New Student</a>
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
        <!-- <section class="content">
            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn btn-primary" href="{{ route('student.create') }}" role="button">Add New Student</a>
                </div>
            </div>
        </section></br> -->
        <!-- /.content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Fisrt Name</th>
                                        <th>Last Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($studentData as $groups)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $groups->stud_first_name }}</td>
                                        <td>{{ $groups->stud_last_name }}</td>
                                        <td>
                                            <a href="{{ route('student.edit',$groups->pk_id) }}" title="edit">
                                                <i class="fa fa-edit text-blue fa-sm"></i>
                                            </a>
                                            <a href="{{ route('student.view',$groups->pk_id) }}" title="show">
                                                <i class="fa fa-eye text-green fa-sm"></i>
                                            </a>
                                            <a  onclick="if(confirm('Do you want to delete this student?'))event.preventDefault(); document.getElementById('delete-{{$groups->pk_id}}').submit();" href="{{ route('student.destroy',$groups->pk_id) }}" title="delete">
                                                <i class="fa fa-trash text-red fa-sm"></i>
                                            </a>
                                            <form id="delete-{{$groups->pk_id}}" method="post" action="{{route('student.destroy',$groups->pk_id)}}" style="display:none;">
                                            @csrf
                                            {{ method_field('PATCH') }}
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>; -->
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