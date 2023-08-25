@extends('agents.inc.master')

@section('title', 'Dashboard')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Commissions</strong> List</h1>
        <p>This is a list of all commissions</p>

        <!-- Display success or error messages if needed -->
        <!-- You can add your success/error message display code here -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"></h5>
                    </div>
                    <div class="card-body">
                        <!-- Add the button to add a new commission here if needed -->

                        <!-- Add more content related to managing commissions if needed -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Commissions List</h5>
                <h6 class="card-subtitle text-muted">List showing all the commissions</h6>
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Commission</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Agent ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through the $commissions data -->
                        @foreach($commissions as $commission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $commission->transaction_id }}</td>
                            <td>{{ $commission->amount }}</td>
                            <td>{{ $commission->commission }}</td>
                            <td>{{ $commission->type }}</td>
                            <td>{{ $commission->date }}</td>
                            <td>{{ $commission->agent_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
@endsection
