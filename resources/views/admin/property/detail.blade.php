@extends('layouts.layout')

@section('dashboard.content-view')
    <!-- BEGIN: Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Property</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">
                                Detail
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{--    main content--}}
    <div class="content-body">
        <!-- Alert animation start -->
        <section id="configuration">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{\Illuminate\Support\Facades\URL::previous()}}" class="btn btn-dark">Back</a>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                <h2 class="text-info">Property Detail</h2>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <strong>Society Name:</strong> &nbsp; {{isset($property->society)?$property->society:"-"}}
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Phase:</strong> &nbsp; {{isset($property->phase)?$property->phase:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>H/Plot #:</strong> &nbsp; {{isset($property->plot_no)?$property->plot_no:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Block:</strong> &nbsp; {{isset($property->block)?$property->block:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Area:</strong> &nbsp; {{isset($property->area)?$property->area:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Area Size:</strong> &nbsp; {{isset($property->area_size)?$property->area_size:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Plot Type:</strong> &nbsp; {{isset($property->plot_type)?$property->plot_type:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Property Type:</strong> &nbsp; {{isset($property->property_type)?$property->property_type:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Rate:</strong> &nbsp; {{isset($property->rate)?number_format($property->rate):0}} (PKR)
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Property For:</strong> &nbsp; {{isset($property->property_for)?$property->property_for:"_"}}
                            </div>
                        </div>

                        @if(isset($property->owner_name) && isset($property->owner_number) && isset($property->id_card))
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                <h2 class="text-info">External Owner Detail</h2>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Owner Name</strong> &nbsp; {{isset($property->owner_name)?$property->owner_name:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Owner Mobile Number:</strong> &nbsp; {{isset($property->owner_number)?$property->owner_number:"-"}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Owner CNIC:</strong> &nbsp; {{isset($property->id_card)?$property->id_card:"-"}}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Alert animation end -->
    </div>
    <!-- END: Content-->
@endsection

@push('dashboard.scripts-footer')
@endpush

