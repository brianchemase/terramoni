<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{route('admindash')}}">
                    <img src="{{asset('logo/tsp-logo.png')}}" alt="TeraLogo" width="50" height="60">
                    <span class="align-middle">TerraMoni </span>
                </a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						MAIN
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'admindash' ? 'active' : '' }}">
					<!-- <li class="sidebar-item "> -->
						<a class="sidebar-link" href="{{route('admindash')}}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					
					

					<li class="sidebar-item {{ Route::currentRouteName() === 'agentstab' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('agentstab')}}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Agents</span>
                        </a>
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'aggregatorslist' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('aggregatorslist')}}">
                            <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Aggregators</span>
                        </a>
					</li>

                    

					<li class="sidebar-item {{ Route::currentRouteName() === 'blankpage' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('blankpage')}}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Reports</span>
                        </a>
					</li>

					<li class="sidebar-header">
						POS DEVICES
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'posterminalslist' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('posterminalslist')}}">
                            <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Inventory</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'agentsposallocation' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('agentsposallocation')}}">
                            <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Allocations</span>
                        </a>
					</li>


					<li class="sidebar-header">
						COMPLIANCE
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'complianceagentstab' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('complianceagentstab')}}">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Agents Pending</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'complianceagentstab' ? 'active' : '' }}">
						<a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Aggregators Pending</span>
                        </a>
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'complianceformpage' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('complianceformpage')}}">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">KYC Review (Form)</span>
                        </a>
					</li>



					<li class="sidebar-header">
						Settings
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'AllUsers' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('AllUsers')}}">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Manage Users</span>
							
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Configurations (Under Construction)</span>
							
						</a>
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'permissionsmatrix' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('permissionsmatrix')}}">
							<i class="align-middle" data-feather="key"></i> <span class="align-middle">Access Matrix</span>
							
						</a>
					</li>

					
					
					
					<!-- <li class="sidebar-header">
						Allocations
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'agentsposallocation' ? 'active' : '' }}">
						<a data-target="#allocations" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="award"></i> <span class="align-middle"> Allocations</span>
						</a>
						<ul id="allocations" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('agentsposallocation')}}">Agents Allocation</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">POS Allocation</a></li>
							
						</ul>
					</li>


					


					<li class="sidebar-item {{ Route::currentRouteName() === 'blankpage' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('blankpage')}}">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Settings</span>
                        </a>
					</li> -->


                   

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="power"></i> <span class="align-middle">Signout</span>
                        </a>
					</li> -->

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('logout') }}"
										onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
										<i class="align-middle" data-feather="power"></i>	{{ __('Signout') }}
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
						</li>

				</ul>

				
			</div>
		</nav>