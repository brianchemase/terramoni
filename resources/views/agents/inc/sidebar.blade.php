<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{route('musicdash')}}">
                    <!-- <img src="{{asset('logo/sisdologo.png')}}" alt="Ndururumo" width="50" height="60"> -->
                    <span class="align-middle">TerraMoni </span>
                </a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						System Tabs
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="{{route('musicdash')}}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					
					

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{route('agentstab')}}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Agents</span>
                        </a>
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{route('aggregatorslist')}}">
                            <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Aggregators</span>
                        </a>
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{route('posterminalslist')}}">
                            <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">POS Terminal</span>
                        </a>
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{route('blankpage')}}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Reports</span>
                        </a>
					</li>

				

				


					<li class="sidebar-header">
						Other
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{route('blankpage')}}">
                            <i class="align-middle" data-feather="award"></i> <span class="align-middle">Compliance</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{route('blankpage')}}">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Settings</span>
                        </a>
					</li>


                   

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="power"></i> <span class="align-middle">Signout</span>
                        </a>
					</li>
				</ul>

				
			</div>
		</nav>