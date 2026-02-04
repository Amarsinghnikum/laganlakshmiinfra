 <!-- sidebar menu area start -->
 @php
 $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar" id="sidebar">
     <button id="sidebarToggle">☰</button>

     <div class="profile">
         <img src="{{url('/assets/img/logo.webp')}}" alt="Logo" width="100px" height="100px">

         <span class="status online"></span> Online
     </div>
     <ul class="metismenu" id="menu">

         <li class="active">
             <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
             <ul class="collapse">
                 <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a
                         href="{{ route('admin.dashboard') }}">Dashboard</a></li>
             </ul>
         </li>

         <li>
             <a href="javascript:void(0)" aria-expanded="true">
                 <i class="fa fa-cubes"></i>
                 <span>Properties</span>
             </a>
             <ul
                 class="collapse {{ Route::is('user.properties.create') || Route::is('user.properties.index') || Route::is('price-level.index') || Route::is('user.properties.edit') || Route::is('user.properties.show') ? 'in' : '' }}">

                 <li class="{{ Route::is('user.properties.index') || Route::is('user.properties.edit') ? 'active' : '' }}">
                     <a href="{{ route('user.properties.index') }}">All Property</a>
                 </li>

                 <li class="{{ Route::is('user.properties.create') ? 'active' : '' }}">
                     <a href="{{ route('user.properties.create') }}">Create Property</a>
                 </li>
             </ul>
         </li>

         <!-- Leads / Enquiries -->
         <li class="">
             <a href="#"
                 aria-expanded="false">
                 <i class="fa fa-phone"></i>
                 <span>Leads / Enquiries</span>
             </a>
         </li>

         <!-- Profile -->
         <li class="">
             <a href="#"
                 aria-expanded="false">
                 <i class="fa fa-user"></i>
                 <span>My Profile</span>
             </a>
         </li>

         <!-- Change Password -->
         <li class="">
             <a href="#"
                 aria-expanded="false">
                 <i class="fa fa-lock"></i>
                 <span>Change Password</span>
             </a>
         </li>

        <!-- Logout -->
        <li class="nav-item">
            <a href="{{ route('logout') }}"
            class="nav-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
            </a>
        </li>

        <!-- Logout Form (outside menu) -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
     </ul>
 </div>