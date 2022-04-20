@extends('layouts.layout')

@section('dashboard.content-view')
    <!-- BEGIN: Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Rented Property</a>
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
                            <div class="col-md-12 col-lg-12 col-sm-12 text-right">
                                <a href="{{route('admin.property.rented')}}" class="btn btn-primary">Add Rent</a>
                                <a href="{{route('admin.property.rented')}}" class="btn btn-dark">Back</a>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                <h2 class="text-info">Property Detail</h2>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <strong>Society Name:</strong> &nbsp; {{$property->society}}
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Phase:</strong> &nbsp; {{$property->phase}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>H/Plot #:</strong> &nbsp; {{$property->plot_no}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Block:</strong> &nbsp; {{$property->block}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Marla:</strong> &nbsp; {{$property->marla}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Plot Type:</strong> &nbsp; {{$property->plot_type}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Property Type:</strong> &nbsp; {{$property->property_type}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Rate:</strong> &nbsp; {{number_format($property->rate)}} (PKR)
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Property For:</strong> &nbsp; {{$property->property_for}}
                            </div>
                        </div>

                        @if(isset($property->owner_name) && isset($property->owner_number) && isset($property->id_card))
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                    <h2 class="text-info">External Owner Detail</h2>
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Owner Name</strong> &nbsp; {{$property->owner_name}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Owner Mobile Number:</strong> &nbsp; {{$property->owner_number}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Owner CNIC:</strong> &nbsp; {{$property->id_card}}
                                </div>
                            </div>
                        @endif

                        @if(isset($property->getRentDetail))
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                    <h2 class="text-info">Rental Detail</h2>
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Rented By:</strong> &nbsp; {{isset($property->getRentDetail->getUser)?$property->getRentDetail->getUser->name:"User Deleted"}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Rental Name:</strong> &nbsp; {{$property->getRentDetail->name}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>ID Card:</strong> &nbsp; {{$property->getRentDetail->id_card}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Advance Amount:</strong> &nbsp; {{$property->getRentDetail->advance_amount}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Monthly Rent:</strong> &nbsp; {{$property->getRentDetail->monthly_rent}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Commission:</strong> &nbsp; {{$property->getRentDetail->commission}}
                                </div>
                            </div>
                        @endif

                        @if(isset($property->getRentDetail->getImages) && count($property->getRentDetail->getImages) > 0)
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                    <h2 class="text-info">Images</h2>
                                </div>
                                @foreach($property->getRentDetail->getImages as $image)
                                    <div class="col-md-6 col-lg-6 col-sm-12 mt-1">
                                        <img class="w-100" src="{{asset('public/rent_property/'.$image->image)}}" alt="">
                                    </div>
                                @endforeach
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

