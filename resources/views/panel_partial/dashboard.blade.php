@extends('layouts.layout')
@push('dashboard.scripts-head')
@endpush
@section('dashboard.content-view')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-footer text-center p-1">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card pull-up border-top-success border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title" style="font-weight: 500;">Total Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                <i class="la la-cart-arrow-down mr-1"></i>
                                                {{isset($totalProperties)?$totalProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card pull-up border-top-info border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title" style="font-weight: 500;">Active Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                <i class="la la-cart-arrow-down mr-1"></i>
                                                {{isset($activeProperties)?$activeProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card pull-up border-top-pink border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title" style="font-weight: 500;">Sold Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                <i class="la la-cart-arrow-down mr-1"></i>
                                                {{isset($soldProperties)?$soldProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card pull-up border-top-purple border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title" style="font-weight: 500;">Rented Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                <i class="la la-cart-arrow-down mr-1"></i>
                                                {{isset($rentProperties)?$rentProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card pull-up border-top-red border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title" style="font-weight: 500;">Construct Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                <i class="la la-cart-arrow-down mr-1"></i>
                                                {{isset($constructProperties)?$constructProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard.scripts-footer')
@endpush
