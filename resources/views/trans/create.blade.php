@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <form action="{{ route('trans.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="" class="form-label">No Pesanan</label>
                                <input value="{{ $orderCode }}" type="text" name="order_code" id=""
                                    class="form-control" readonly>
                                <div class="mt-3 mb-3">
                                    <label for="" class="form-label">Pelanggan</label>
                                    <select name="id_customer" id="" class="form-control">
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3 mb-3">
                                    <label for="" class="form-label">Paket</label>
                                    <select name="" id="id_service" class="form-control">
                                        <option value="">Pilih Paket</option>
                                        @foreach ($services as $service)
                                            <option data-price="{{ $service->price }}" value="{{ $service->id }}">
                                                {{ $service->service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3 mb-3">
                                    <label for="" class="form-label">End Order</label>
                                    <input type="date" name="order_end_date" id="" class="form-control">
                                </div>


                                <label for="" class="form-label">Catatan</label>
                                <textarea name="note" id="" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="mt-3 mb-3">
                            <div align="right" class="mb-3">
                                <button type="button" class="btn btn-primary addRow">Tambah Row</button>
                            </div>
                            <table class="table table-bordered" id="myTable">
                                <thead></thead>
                                <tr>
                                    <th>No</th>
                                    <th>Paket</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            <p>
                                <strong>Grand Total : Rp <span id="grandTotal"></span></strong>
                            <div class="mb-3">
                                <input type="hidden" name="grand_total" id="grandTotalInput" value=0>
                            </div>
                            </p>
                        </div>
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
