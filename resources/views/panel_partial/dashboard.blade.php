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
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-success border-top-3 rounded-0">
                                    <div class="card-header">
                                        <span class="font-size-large">Total Properties</span>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                {{isset($totalProperties)?$totalProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-success border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Total Properties Amount</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <span class="font-size-large">{{isset($totalPropertiesPrice)?number_format($totalPropertiesPrice):0}} (PKR)</span>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-info border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Active Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                {{isset($activeProperties)?$activeProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-info border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Active Properties Amount</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                                <span class="font-size-large">
                                                    {{isset($activePropertiesPrice)?number_format($activePropertiesPrice):0}} (PKR)
                                                </span>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-pink border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Sold Properties Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                {{isset($soldProperties)?$soldProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-pink border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Sold Properties Amount</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                                <span class="font-size-large">
                                                    {{isset($soldPropertiesPrice)?number_format($soldPropertiesPrice):0}} (PKR)
                                                </span>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-purple border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Rented Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                {{isset($rentProperties)?$rentProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-purple border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Rented Properties Amount</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                                <span class="font-size-large">
                                                    {{isset($rentPropertiesPrice)?number_format($rentPropertiesPrice):0}} (PKR)
                                                </span>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-red border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Construct Properties</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                            <h4 class="font-large-1 text-bold-400">
                                                {{isset($constructProperties)?$constructProperties:0}}
                                            </h4>
                                        </div>
                                        <div class="card-footer p-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card pull-up border-top-red border-top-3 rounded-0">
                                    <div class="card-header">
                                        <h4 class="card-title">Construct Properties Amount</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body p-1">
                                                <span class="font-size-large">
                                                    {{isset($constructPropertiesPrice)?number_format($constructPropertiesPrice):0}} (PKR)
                                                </span>
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
