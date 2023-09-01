@extends('agents.inc.master')

@section('title', 'Edit Transaction Type')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Transaction Type</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Transaction Type</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('transactionTypes.update', [$transactionType->tt_id]) }}">
                            @csrf
                            @method('PUT')

                            <!-- ROW 1 -->
                            <div class="col-md-6">
                                <label for="tt_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="tt_name" name="tt_name" value="{{ $transactionType->tt_name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tt_notes" class="form-label">Notes</label>
                                <input type="text" class="form-control" id="tt_notes" name="tt_notes" value="{{ $transactionType->tt_notes }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Transaction Type</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
