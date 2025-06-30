@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <form action="{{ route('service.update', $service->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="" class="form-label">Service Name</label>
                            <input type="text" name="service_name" id="" class="form-control"
                                value="{{ $service->service_name }}">

                            <label for="" class="form-label">Price</label>
                            <input type="number" name="price" id="" class="form-control"
                                value="{{ $service->price }}" required>

                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" class="form-control">{{ $service->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
