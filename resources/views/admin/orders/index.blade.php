@extends('layouts.admin')
@php
    function getStatusColor($status) {
        switch ($status) {
            case 'pending':
                return 'bg-warning';
            case 'processing':
                return 'bg-primary';
            case 'completed':
                return 'bg-success';
            case 'rejected':
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }
@endphp
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pemesan</th>
                            <th>Image URL</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @foreach ($order->orderDetails as $detail)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td><img src="{{ asset($detail->product->image_url) }}" alt="product-image" style="width: 100px;"></td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->product->category }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->price * $detail->quantity, 2) }}</td>
                                    <td>
                                        <div class="card {{ getStatusColor($detail->status) }} text-white shadow">
                                            <div class="card-body">
                                                {{ ucfirst($detail->status) }}
                                            </div>
                                        </div>                                        
                                    </td>
                                    <td>
                                        <form action="{{ route('order_details.updateStatus', ['detailId' => $detail->id]) }}" method="POST">
                                            @csrf
                                            <select name="status" class="custom-select" onchange="this.form.submit()">
                                                <option value="pending" {{ $detail->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $detail->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ $detail->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="rejected" {{ $detail->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </form>
                                    </td>                           
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
