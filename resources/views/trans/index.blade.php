@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="mb-3" align="right">
                        <a class="btn btn-success" href="{{ route('trans.create') }}">Tambah</a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $index => $data)
                            <tr>
                                <td>{{ $index += 1 }}</td>
                                <td><a href="{{ route('trans.show', $data->id) }}">{{ $data->order_code }}</a></td>
                                <td>{{ $data->customer->name }}</td>
                                <td>{{ $data->order_end_date }}</td>
                                <td>{{ $data->status_text }}</td>
                                <td>
                                    <a href="{{ route('print_invoice', $data->id) }}" class="btn btn-success btn-sm"
                                        name="print">Print</a>
                                    {{-- <a href="{{ route('trans.show', $data->id) }}" class="btn btn-primary btn-sm"
                                        name="show">Show</a> --}}
                                    <form action="{{ route('trans.destroy', $data->id) }}" method="post"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confrim('Yakin ingin delete?')"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
