@extends('agents.inc.master')

@section('title', 'Dashboard')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Basic Commission Matrices</strong> List</h1>
        <p>This is a list of basic commission matrices</p>
        
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <strong>{{ $message }}</strong>
            </div>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </strong>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Basic Commission Matrices</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicCommissionModal">
                            <i class="fa fa-users" aria-hidden="true"></i> Create New Basic Commission Matrix
                        </button>
                        @include('agents.modals.createbasiccommatrix')
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><strong>Basic Commission Matrices List</strong></h5>
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Agent Role</th>
                            <th>Agent Type</th>
                            <th>Agent Tier Level</th>
                            <th>Transaction Type</th>
                            <th>Min Transaction Amount</th>
                            <th>Max Transaction Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($basicCommissionMatrices as $matrix)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <!-- Modify the fields below to match your actual data structure -->
                            <td>{{ $matrix->agent_role }}</td>
                            <td>{{ $matrix->agent_type }}</td>
                            <td>{{ $matrix->agent_tier_level }}</td>
                            <td>{{ $matrix->transaction_type }}</td>
                            <td>{{ $matrix->min_trans_amount }}</td>
                            <td>{{ $matrix->max_trans_amount }}</td>
                            
                            <td>
                                
                                <a href="{{ route('basiccommissionmatrix.edit', $matrix->cr_id) }}" class="btn btn-sm btn-primary">Edit</a>
                                
                                <form action="{{ route('basiccommissionmatrix.destroy', $matrix->cr_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this matrix?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
