@extends('agents.inc.master')

@section('title', 'Edit Agent Type')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Agent Type</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Agent Type</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('agentTypes.update', $agentType) }}">
                            @csrf
                            @method('PUT')

                            <!-- ROW 1 -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $agentType->name }}" required>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Agent Type</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
