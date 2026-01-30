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
                 class="collapse {{ Route::is('properties.create') || Route::is('properties.index') || Route::is('price-level.index') || Route::is('properties.edit') || Route::is('properties.show') ? 'in' : '' }}">

                 <li
                     class="{{ Route::is('properties.index') || Route::is('properties.edit') ? 'active' : '' }}">
                     <a href="{{ route('properties.index') }}">All Property</a>
                 </li>

                 <li class="{{ Route::is('properties.create') ? 'active' : '' }}">
                     <a href="{{ route('properties.create') }}">Create Property</a>
                 </li>
             </ul>
         </li>

         @if(auth()->user()->hasRole('superadmin'))
         <li class="{{ Route::is('admin.query.index') ? 'active' : '' }}">
             <a href="{{ route('admin.query.index') }}"
                 aria-expanded="{{ Route::is('admin.query.index') ? 'true' : 'false' }}">
                 <i class="fa fa-question-circle"></i>
                 <span>All Queries</span>
             </a>
         </li>
         @endif
     </ul>
 </div>