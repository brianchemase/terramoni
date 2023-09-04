@extends('agents.inc.master')

@section('title', 'Promotions List')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Promotions</strong> List</h1>
        <p>This is a list of all promotions</p>

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
                        <h5 class="card-title mb-0">Promotions</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPromotionModal">
                            <i class="fa fa-gift" aria-hidden="true"></i> Create New Promotion
                        </button>
                        @include('agents.modals.createpromotion')
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><strong>Promotions List</strong></h5>
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Notes</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->promo_id }}</td>
                            <td>{{ $promotion->promo_name }}</td>
                            <td>{{ $promotion->promo_notes }}</td>
                            <td>{{ $promotion->promo_start_date }}</td>
                            <td>{{ $promotion->promo_end_date }}</td>
                            <td>
                                <a href="{{ route('promotions.edit', $promotion->promo_id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('promotions.destroy', $promotion->promo_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this promotion?')">Delete</button>
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
