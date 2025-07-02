@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <form action="{{ route('trans.update', $trans->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="">No Pesanan</label>
                                <input value="{{ $trans->order_code }}" type="text" name="name" id=""
                                    class="form-control" readonly>

                                <label for="">Tanggal Selesai</label>
                                <input value="{{ $trans->order_end_date }}" type="text" name="phone" id=""
                                    class="form-control">

                                <label for="">Status</label>
                                <textarea name="address" id="" class="form-control">{{ $trans->order_status }}</textarea>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
