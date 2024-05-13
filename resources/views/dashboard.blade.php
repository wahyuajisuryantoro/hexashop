@extends('layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <!-- Total Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pendapatan <i class="fas fa-coins fa-4x float-right"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- New Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pesanan Baru (24jam Terakhir) <i class="fas fa-shopping-cart fa-4x float-right"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $newOrdersCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Status Order with Icon -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Status Order <i class="fas fa-info-circle fa-4x float-right"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <ul class="list-unstyled">
                                    @foreach ($orderStatuses as $status)
                                        <li>{{ $status->status }}: {{ $status->count }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Selling Products with Icon -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Produk Terlaris <i class="fas fa-star fa-4x float-right"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <ul class="list-unstyled">
                                    @foreach ($topSellingProducts as $product)
                                        <li>{{ $product->name }}: {{ $product->total_sold }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newly Added Products with Icon -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Produk Baru Ditambahkan <i class="fas fa-plus-circle fa-4x float-right"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <ul class="list-unstyled">
                                    @foreach ($newlyAddedProducts as $product)
                                        <li>{{ $product->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Categories with Icon -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Kategori Produk <i class="fas fa-tags fa-4x float-right"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <ul class="list-unstyled">
                                    @foreach ($productCategories as $category)
                                        <li>{{ $category->category }}: {{ $category->count }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pendapatan Bulanan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @foreach ($monthlyRevenue as $revenue)
                                    <p>{{ $revenue->year }}-{{ $revenue->month }}: Rp.
                                        {{ number_format($revenue->total, 0, ',', '.') }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Annual Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pendapatan Tahunan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @foreach ($annualRevenue as $revenue)
                                    <p>{{ $revenue->year }}: Rp. {{ number_format($revenue->total, 0, ',', '.') }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
