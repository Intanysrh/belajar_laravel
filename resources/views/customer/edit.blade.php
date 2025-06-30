@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <form action="{{ route('customer.update', $customer->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input value="{{ $customer->name }}" type="text" name="name" id=""
                                class="form-control">

                            <label for="">Phone</label>
                            <input value="{{ $customer->phone }}" type="text" name="phone" id=""
                                class="form-control">

                            <label for="">Address</label>
                            <textarea name="address" id="" class="form-control">{{ $customer->address }}</textarea>
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
