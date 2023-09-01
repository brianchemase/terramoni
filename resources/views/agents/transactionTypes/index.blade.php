@extends('agents.inc.master')

@section('title', 'Transaction Types List')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Transaction Types</strong> List</h1>
        <p>This is a list of all transaction types</p>
        
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
                        <h5 class="card-title mb-0">Transaction Types</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTransactionTypeModal">
                            <i class="fa fa-users" aria-hidden="true"></i> Create New Transaction Type
                        </button>
                        @include('agents.modals.createtransactiontypes')
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><strong>Transaction Types List</strong></h5>
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactionTypes as $transactionType)
                        <tr>
                            <td>{{ $transactionType->tt_id }}</td>
                            <td>{{ $transactionType->tt_name }}</td>
                            <td>{{ $transactionType->tt_notes }}</td>
                            <td>
                                <a href="{{ route('transactionTypes.edit', $transactionType->tt_id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('transactionTypes.destroy', $transactionType->tt_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this transaction type?')">Delete</button>
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
