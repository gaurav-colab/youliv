<nav id="sidebar">
            <div class="sidebar-header">
                 <a href="{{url('admin/dashboard')}}">
				<img class="c-sidebar-brand-full" src="{{ url('public/assets/brand/youliv_logo.png') }}" width="200" alt="Youliv"></a>
				
            </div>

            <ul class="list-unstyled components">
               <li>
                    <a href="{{url('admin/dashboard')}}">Dashboard</a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Property List</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{url('admin/add_property')}}">Add New Property</a>
                        </li>
                        <li>
                            <a href="{{url('admin/property_list')}}">View Properties</a>
                        </li>                        
                    </ul>
                </li>
                
                <li>
                    <a href="#property_owners" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Property Owners</a>
                    <ul class="collapse list-unstyled" id="property_owners">
                        <li>
                            <a href="{{url('admin/add_propery_owner')}}">Add Property Owner</a>
                        </li>
                        <li>
                            <a href="{{url('admin/property_owner_list')}}">View Property Owners</a>
                        </li>
                      
                    </ul>
                </li>
				 <li>
                    <a href="#area_managers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Area Managers</a>
                    <ul class="collapse list-unstyled" id="area_managers">
                        <li>
                            <a href="{{url('admin/add_area_manager')}}">Add Area Manager</a>
                        </li>
                        <li>
                            <a href="{{url('admin/area_manager_list')}}">View Area Managers</a>
                        </li>
                      
                    </ul>
                </li>
				 <li>
                    <a href="#requests" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Requests</a>
                    <ul class="collapse list-unstyled" id="requests">
                        <li>
                            <a href="{{url('admin/inventory_management')}}">Inventory Management Request</a>
                        </li>
                        <li>
                            <a href="{{url('admin/owner_payment_detail_approval')}}">Owner Payment Detail Approval</a>
                        </li>
						<li>
                            <a href="{{url('admin/property_add_request')}}">Property Add Request</a>
                        </li>
						<li>
                            <a href="{{url('admin/property_lead_request')}}">Property Lead</a>
                        </li>
                      
                    </ul>
                </li>
				<li>
                    <a href="#sectors" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Sectors</a>
                    <ul class="collapse list-unstyled" id="sectors">
                        <li>
                            <a href="{{url('admin/city_list')}}">Add Sectors</a>
                        </li>                       
                      
                    </ul>
                </li>
                <li>
                    <a href="{{url('admin/user_list')}}">View Users</a>
                </li>
                <li>
                    <a href="{{url('admin/property_schedule_list')}}">Property Schedules</a>
                </li>				
				<li>
                    <a href="{{url('admin/site_setting')}}">Site Setting</a>
                </li>
				<li>
                    <form action="{{url('admin/logout')}}" method="POST"> @csrf <button type="submit" class="btn btn-ghost-dark btn-block" style="text-align: left;padding-left: 10px;color:white;">Logout
                </button></form>
                </li>
            </ul>
        </nav>