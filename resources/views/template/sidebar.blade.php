<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #005073;">
  <!-- Brand Logo -->
  <!-- <a href="index3.html" class="brand-link">
    <img src="resources/images/spero_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
    <span class="brand-text font-weight-light">TDD</span>
  </a> -->
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ url('/')}}/resources/images/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <?php
    $clg_group = Auth::user()->clg_group; 
    if($clg_group == 'UG-ISO'){

      ?> 
      
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
        <li class="nav-item has-treeview menu-open">
         
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
           
          </ul>
        </li>
        <li class="nav-item has-treeview menu-open">
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('patient.list')}}" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Patient List</p>
              </a>
            </li>
          </ul>
        </li>
        

      </ul>
      
      <?php
     } else {
      ?>
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
       <li class="nav-item has-treeview menu-open">
        
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('dash.dashboard') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Dashboard</p>
             </a>
           </li>
          
         </ul>
       </li>
       <li class="nav-item has-treeview menu-open">
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('patient.list')}}" class="nav-link">
               <i class="fa fa-users nav-icon"></i>
               <p>Patient List11</p>
             </a>
           </li>
         </ul>
       </li>
       <li class="nav-item has-treeview menu-open">
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('hospital.list')}}" class="nav-link">
               <i class="fa fa-hospital nav-icon"></i>
               <p>Hospital List</p>
             </a>
           </li>
         </ul>
       </li>
       
       <li class="nav-item has-treeview menu-open">
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('feedback.list')}}" class="nav-link">
               <i class="fa fa-book  nav-icon"></i>
               <p>Feedback</p>
             </a>
           </li>
         </ul>
       </li>
       <li class="nav-item has-treeview menu-open">
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{route('user.list')}}" class="nav-link">
               <i class="fa fa-user nav-icon"></i>
               <p>User List</p>
             </a>
           </li>
         </ul>
       </li>
     </ul>
      <?php

    }
    ?>

      
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>