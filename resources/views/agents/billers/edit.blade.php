@extends('agents.inc.master')

@section('title', 'Edit Biller')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Biller</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Biller</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('billers.update', [$biller->biller_id]) }}">
                            @csrf
                            @method('PUT')

                            <!-- ROW 1 -->
                            <div class="col-md-4">
                                <label for="biller_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="biller_name" name="biller_name" value="{{ $biller->biller_name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="biller_cat_id" class="form-label">Category ID</label>
                                <input type="number" class="form-control" id="biller_cat_id" name="biller_cat_id" value="{{ $biller->biller_cat_id }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="biller_code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="biller_code" name="biller_code" value="{{ $biller->biller_code }}" required>
                            </div>

                            <!-- ROW 2 -->
                            <div class="col-md-4">
                                <label for="biller_url" class="form-label">URL</label>
                                <input type="text" class="form-control" id="biller_url" name="biller_url" value="{{ $biller->biller_url }}">
                            </div>
                            <div class="col-md-8">
                                <label for="biller_note" class="form-label">Notes</label>
                                <input type="text" class="form-control" id="biller_note" name="biller_note" value="{{ $biller->biller_note }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Biller</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
