@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <form action="{{ route('service.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Service Name</label>
                            <input type="text" name="service_name" id="" class="form-control">

                            <label for="">Price</label>
                            <input type="number" name="price" id="" class="form-control">

                            <label for="">Description</label>
                            <textarea name="description" id="" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
