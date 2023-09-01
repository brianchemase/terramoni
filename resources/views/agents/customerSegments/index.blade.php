@extends('agents.inc.master')

@section('title', 'Customer Segments List')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Customer Segments</strong> List</h1>
        <p>This is a list of all customer segments</p>
        
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
                        <h5 class="card-title mb-0">Customer Segments</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCustomerSegmentModal">
                            <i class="fa fa-users" aria-hidden="true"></i> Create New Customer Segment
                        </button>
                        @include('agents.modals.createcustomersegment')
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><strong>Customer Segments List</strong></h5>
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
                        @foreach($customerSegments as $customerSegment)
                        <tr>
                            <td>{{ $customerSegment->cs_id }}</td>
                            <td>{{ $customerSegment->cs_name }}</td>
                            <td>{{ $customerSegment->cs_notes }}</td>
                            <td>
                                <a href="{{ route('customerSegments.edit', $customerSegment->cs_id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('customerSegments.destroy', $customerSegment->cs_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer segment?')">Delete</button>
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
