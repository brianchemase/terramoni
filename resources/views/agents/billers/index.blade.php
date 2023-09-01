@extends('agents.inc.master')

@section('title', 'Billers List')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Billers</strong> List</h1>
        <p>This is a list of all billers</p>
        
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
                        <h5 class="card-title mb-0">Billers</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBillerModal">
                            <i class="fa fa-users" aria-hidden="true"></i> Create New Biller
                        </button>
                        @include('agents.modals.createbillers')
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><strong>Billers List</strong></h5>
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category ID</th>
                            <th>Code</th>
                            <th>URL</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($billers as $biller)
                        <tr>
                            <td>{{ $biller->biller_id }}</td>
                            <td>{{ $biller->biller_name }}</td>
                            <td>{{ $biller->biller_cat_id }}</td>
                            <td>{{ $biller->biller_code }}</td>
                            <td>{{ $biller->biller_url }}</td>
                            <td>{{ $biller->biller_note }}</td>
                            <td>
                                <a href="{{ route('billers.edit', $biller->biller_id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('billers.destroy', $biller->biller_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this biller?')">Delete</button>
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
