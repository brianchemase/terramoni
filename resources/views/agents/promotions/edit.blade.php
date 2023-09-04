@extends('agents.inc.master')

@section('title', 'Edit Promotion')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Promotion</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Promotion</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('promotions.update', [$promotion->promo_id]) }}">
                            @csrf
                            @method('PUT')

                            <!-- ROW 1 -->
                            <div class="col-md-6">
                                <label for="promo_name" class="form-label">Promotion Name</label>
                                <input type="text" class="form-control" id="promo_name" name="promo_name" value="{{ $promotion->promo_name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="promo_notes" class="form-label">Promotion Notes</label>
                                <input type="text" class="form-control" id="promo_notes" name="promo_notes" value="{{ $promotion->promo_notes }}">
                            </div>

                            <!-- ROW 2 -->
                            <div class="col-md-6">
                                <label for="promo_start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="promo_start_date" name="promo_start_date" value="{{ $promotion->promo_start_date }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="promo_end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="promo_end_date" name="promo_end_date" value="{{ $promotion->promo_end_date }}" required>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Promotion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
