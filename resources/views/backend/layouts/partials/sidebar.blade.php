 <!-- sidebar menu area start -->
 @php
 $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar" id="sidebar">
     <button id="sidebarToggle">☰</button>

     <div class="profile">
         <img src="{{url('/assets/img/logo.webp')}}" alt="Logo" width="100px" height="100px">
         <!-- <p>Administrator</p> -->
         <span class="status online"></span> Online
     </div>
     <ul class="metismenu" id="menu">
         @if ($usr->can('dashboard.view'))
         <li class="active">
             <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
             <ul class="collapse">
                 <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a
                         href="{{ route('admin.dashboard') }}">Dashboard</a></li>
             </ul>
         </li>
         @endif

         @if ($usr->can('role.create') || $usr->can('role.view') || $usr->can('role.edit') ||
         $usr->can('role.delete'))
         <li>
             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                     Roles & Permissions
                 </span></a>
             <ul
                 class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                 @if ($usr->can('role.view'))
                 <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}">
                     <a href="{{ route('admin.roles.index') }}">All Roles</a>
                 </li>
                 @endif
                 @if ($usr->can('role.create'))
                 <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a
                         href="{{ route('admin.roles.create') }}">Create Role</a></li>
                 @endif
             </ul>
         </li>
         @endif

         @if ($usr->can('admin.create') || $usr->can('admin.view') || $usr->can('admin.edit') ||
         $usr->can('admin.delete'))
         <li>
             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                     Admins
                 </span></a>
             <ul
                 class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">

                 @if ($usr->can('admin.view'))
                 <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}">
                     <a href="{{ route('admin.admins.index') }}">All Admins</a>
                 </li>
                 @endif

                 @if ($usr->can('admin.create'))
                 <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a
                         href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                 @endif
             </ul>
         </li>
         @endif
         <li>
             <a href="javascript:void(0)" aria-expanded="true">
                 <i class="fa fa-tags"></i>
                 <span>Location</span>
             </a>
             <ul class="collapse {{ Route::is('admin.states.index') || Route::is('admin.cities.index') ? 'in' : '' }}">

                 <li class="{{ Route::is('admin.states.index') ? 'active' : '' }}">
                     <a href="{{ route('admin.states.index') }}">States</a>
                 </li>
                 <li class="{{ Route::is('admin.cities.index') ? 'active' : '' }}">
                     <a href="{{ route('admin.cities.index') }}">Cities</a>
                 </li>
             </ul>
         </li>

         <li>
             <a href="javascript:void(0)" aria-expanded="true">
                 <i class="fa fa-tags"></i>
                 <span>Categories</span>
             </a>
             <ul
                 class="collapse {{ Route::is('admin.category.create') || Route::is('admin.category.index') || Route::is('admin.category.edit') || Route::is('admin.category.show') ? 'in' : '' }}">

                 <li
                     class="{{ Route::is('admin.category.index') || Route::is('admin.category.edit') ? 'active' : '' }}">
                     <a href="{{ route('admin.category.index') }}">All Category</a>
                 </li>

                 <li class="{{ Route::is('admin.category.create') ? 'active' : '' }}">
                     <a href="{{ route('admin.category.create') }}">Create Category</a>
                 </li>
             </ul>
         </li>

         <li>
             <a href="javascript:void(0)" aria-expanded="true">
                 <i class="fa fa-tags"></i>
                 <span>Sub Categories</span>
             </a>
             <ul
                 class="collapse {{ Route::is('admin.subcategories.create') || Route::is('admin.subcategories.index') || Route::is('admin.subcategories.edit') || Route::is('admin.subcategories.show') ? 'in' : '' }}">

                 <li
                     class="{{ Route::is('admin.subcategories.index') || Route::is('admin.subcategories.edit') ? 'active' : '' }}">
                     <a href="{{ route('admin.subcategories.index') }}">All Sub Sub Category</a>
                 </li>

                 <li class="{{ Route::is('admin.subcategories.create') ? 'active' : '' }}">
                     <a href="{{ route('admin.subcategories.create') }}">Create Sub Sub Category</a>
                 </li>
             </ul>
         </li>

         <li>
             <a href="javascript:void(0)" aria-expanded="true">
                 <i class="fa fa-cubes"></i>
                 <span>Properties</span>
             </a>
             <ul
                 class="collapse {{ Route::is('admin.properties.create') || Route::is('admin.properties.index') || Route::is('admin.price-level.index') || Route::is('admin.properties.edit') || Route::is('admin.properties.show') ? 'in' : '' }}">

                 <li
                     class="{{ Route::is('admin.properties.index') || Route::is('admin.properties.edit') ? 'active' : '' }}">
                     <a href="{{ route('admin.properties.index') }}">All Property</a>
                 </li>

                 <li class="{{ Route::is('admin.properties.create') ? 'active' : '' }}">
                     <a href="{{ route('admin.properties.create') }}">Create Property</a>
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