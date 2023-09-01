@extends('agents.inc.master')

@section('title', 'Edit Customer Segment')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Customer Segment</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Customer Segment</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('customerSegments.update', [$customerSegment->cs_id]) }}">
                            @csrf
                            @method('PUT')

                            <!-- ROW 1 -->
                            <div class="col-md-4">
                                <label for="cs_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="cs_name" name="cs_name" value="{{ $customerSegment->cs_name }}" required>
                            </div>
                            <div class="col-md-8">
                                <label for="cs_notes" class="form-label">Notes</label>
                                <input type="text" class="form-control" id="cs_notes" name="cs_notes" value="{{ $customerSegment->cs_notes }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Customer Segment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
