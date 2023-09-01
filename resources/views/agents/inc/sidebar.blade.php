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

					

					@can('view-admin-dashboard')
					<li class="sidebar-item {{ Route::currentRouteName() === 'admindash' ? 'active' : '' }}">
					<!-- <li class="sidebar-item "> -->
						<a class="sidebar-link" href="{{route('admindash')}}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>
					@endcan					
					

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

                    

					<!-- <li class="sidebar-item {{ Route::currentRouteName() === 'blankpage' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('blankpage')}}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Reports</span>
                        </a>
					</li> -->

					<li class="sidebar-item">
						<a data-target="#pages" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="layout"></i> <span class="align-middle">Reports</span>
						</a>
						<ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="#">Overview Report</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">State Count Report </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Charge Back Report </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Disputes </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('posterminalslist')}}">Terminal Report </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Performance Report </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Tickets </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">System Monitor </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('totaltrans')}}">Transaction Summary </a></li>
													
						</ul>
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

					<li class="sidebar-item {{ Route::currentRouteName() === 'complianceaggregatorsstab' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('complianceaggregatorsstab')}}">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Aggregators Pending</span>
                        </a>
					</li>

					<!-- <li class="sidebar-item {{ Route::currentRouteName() === 'complianceformpage' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('complianceformpage')}}">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">KYC Review (Form)</span>
                        </a>
					</li> -->



					<li class="sidebar-header">
						Settings
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'AllUsers' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('AllUsers')}}">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Manage Users</span>
							
						</a>
					</li>


					<li class="sidebar-item {{ Route::currentRouteName() === 'allcommissions' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('allcommissions')}}">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Commissions </span>				
						</a>
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'commissionmatrix' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('commissionmatrix')}}">
							<i class="align-middle" data-feather="key"></i> <span class="align-middle">Commission Matrix</span>
							
						</a>
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'transactionTypes' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('transactionTypes')}}">
							<i class="align-middle" data-feather="transaction"></i> <span class="align-middle">Transaction Types</span>
							
						</a>
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'agentTypes' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('agentTypes')}}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Agent Types</span>
							
						</a>
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'agentTiers' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('agentTiers')}}">
							<i class="align-middle" data-feather="tiers"></i> <span class="align-middle">Agent Tiers</span>
							
						</a>
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'customerSegments' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('customerSegments')}}">
							<i class="align-middle" data-feather="customers"></i> <span class="align-middle">Customer Segments</span>
							
						</a>
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'billers' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('billers')}}">
							<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Biller</span>
							
						</a>
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'permissionsmatrix' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('permissionsmatrix')}}">
							<i class="align-middle" data-feather="key"></i> <span class="align-middle">Access Matrix</span>
							
						</a>
					</li>

					<li class="sidebar-item">
						<a data-target="#roles" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="layout"></i> <span class="align-middle">Role Based Access Matrix</span>
						</a>
						<ul id="roles" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item menu-drop {{ Route::currentRouteName() === 'AllRoles' ? 'active' : ''}}"><a class="sidebar-link" href="{{route('AllRoles')}}">Roles</a></li>
							<li class="sidebar-item menu-drop {{ Route::currentRouteName() === 'AllPermissions' ? 'active' : ''}}"><a class="sidebar-link" href="{{route('AllPermissions')}}">Permissions</a></li>
							<li class="sidebar-item menu-drop {{ Route::currentRouteName() === 'AssignRole' ? 'active' : ''}}"><a class="sidebar-link" href="{{route('AssignRole')}}">Assign permission(s) to role</a></li>
							<!-- <li class="sidebar-item"><a class="sidebar-link" href="#">Disputes </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Terminal Report </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Performance Report </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">Tickets </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="#">System Monitor </a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('totaltrans')}}">Transaction Summary </a></li> -->
													
						</ul>
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