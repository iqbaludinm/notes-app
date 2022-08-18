
 @if(Auth::user()->hasRole('admin'))
 <div class="h-100" data-simplebar>
     <!--- Sidemenu -->
     <div id="sidebar-menu">

         <ul id="side-menu">

             <li class="menu-title">Menu</li>

             <li>
                 <a href="{{route('dashboard')}}">
                     <i data-feather="home"></i>
                     <span> Dashboard </span>
                 </a>
             </li>

             <li>
                 <a href="#">
                     <i data-feather="home"></i>
                     <span> Notes </span>
                 </a>
             </li>
             <li>
                 <a href="#">
                     <i data-feather="home"></i>
                     <span> Categories </span>
                 </a>
             </li>

             <li>
                 <a href="">
                     <i data-feather="users"></i>
                     <span class="badge badge-success badge-pill float-right"></span>
                     <span> Users </span>
                 </a>
             </li>


         </ul>
     </div>
     <!-- End Sidebar -->

     <div class="clearfix"></div>

 </div>
@endif


<!-- Sidebar -left -->





