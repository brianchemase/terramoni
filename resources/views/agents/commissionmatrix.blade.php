@extends('agents.inc.master')

@section('title', 'Dashboard')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Commission Matrices</strong> List</h1>
            <p>This is a list of all commission matrices</p>

            <!-- Button to toggle between the two tables -->
            <button id="toggleButton" class="btn btn-primary">
                Show Basic Commission Matrices
            </button>

            <!-- Start with the basic commission matrices table visible -->
            <div id="basicCommissionTable">
                @include('agents.basiccommissionmatrix.index')
            </div>

            <!-- Initially, hide the advanced commission matrices table -->
            <div id="advancedCommissionTable" style="display: none;">
                @include('agents.commissionMatrix.index')
            </div>
        </div>
    </main>
    
    
    <script>
        // Function to toggle between the tables
        function toggleTables() {
            var basicTable = document.getElementById('basicCommissionTable');
            var advancedTable = document.getElementById('advancedCommissionTable');
            
            // Toggle the visibility of the tables
            if (basicTable.style.display === 'none') {
                basicTable.style.display = 'block';
                advancedTable.style.display = 'none';
                document.getElementById('toggleButton').textContent = 'Show Advanced Commission Matrices';
            } else {
                basicTable.style.display = 'none';
                advancedTable.style.display = 'block';
                document.getElementById('toggleButton').textContent = 'Show Basic Commission Matrices';
            }
        }
        
        // Add a click event listener to the toggle button
        document.getElementById('toggleButton').addEventListener('click', toggleTables);
    </script>
@endsection
