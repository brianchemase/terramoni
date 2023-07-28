<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{route('agentsdash')}}">
                    <img src="{{asset('logo/tsp-logo.png')}}" alt="TeraLogo" width="50" height="60">
                    <span class="align-middle">TerraMoni </span>
                </a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						MAIN
					</li>

					<li class="sidebar-item {{ Route::currentRouteName() === 'agentsdash' ? 'active' : '' }}">
					<!-- <li class="sidebar-item "> -->
						<a class="sidebar-link" href="{{route('agentsdash')}}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>
				

                    

					<li class="sidebar-item {{ Route::currentRouteName() === 'agentsblankpage' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('agentsblankpage')}}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Reports</span>
                        </a>
					</li>

					<li class="sidebar-header">
						POS DEVICES
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() === 'allocatedterminals' ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('allocatedterminals')}}">
                            <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Inventory</span>
                        </a>
					</li>

				



					<li class="sidebar-header">
						Settings
					</li>
					
					<li class="sidebar-item {{ Route::currentRouteName() === 'complianceagentstab' ? 'active' : '' }}">
						<a data-target="#compliance" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="award"></i> <span class="align-middle">Settings</span>
						</a>
						<ul id="compliance" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="#">Change Password (Under Construction)</a></li>
							
							
						</ul>
					</li>
					

                   

					
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