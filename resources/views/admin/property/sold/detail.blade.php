@extends('layouts.layout')

@section('dashboard.content-view')
    <!-- BEGIN: Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Sold Property</a>
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
                        <div class="row mb-3">
                            @if(isset($property->getSoldDetail))
                                <div class="col-md-3 col-lg-3 xol-sm-12 text-left">
                                    <strong>Amount:</strong>&nbsp; <span
                                        class="text-info">{{number_format($property->getSoldDetail->amount)}}</span>
                                </div>

                                <div class="col-md-3 col-lg-3 xol-sm-12 text-left">
                                    <strong>Remaining Amount:</strong>&nbsp; <span
                                        class="text-info">{{isset($property->getSoldDetail->getSoldIteration->last()->remaining)?number_format($property->getSoldDetail->getSoldIteration->last()->remaining):"-"}}</span>
                                </div>

                                <div class="col-md-3 col-lg-3 xol-sm-12 text-left">
                                    <strong>Profit Amount:</strong>&nbsp; <span
                                        class="text-info">{{number_format($property->getSoldDetail->amount - $property->rate)}}</span>
                                </div>
                            @endif
                            <div class="col-md-3 col-lg-3 xol-sm-12 text-right">
                                <a href="{{route('admin.sold.property.iteration',$property->getSoldDetail->id)}}"
                                   class="btn btn-info">Add Iteration</a>
                                <a href="{{route('admin.property.sold')}}" class="btn btn-dark">Back</a>
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
                                <strong>Area:</strong> &nbsp; {{$property->area}}
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <strong>Area Size:</strong> &nbsp; {{$property->area_size}}
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
                            <div class="row mb-3">
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

                        @if(isset($property->getSoldDetail))
                            <div class="row mb-3">
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                    <h2 class="text-info">Purchaser Detail</h2>
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Sold By:</strong>
                                    &nbsp; {{isset($property->getSoldDetail->getUser)?$property->getSoldDetail->getUser->name:"User Deleted"}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Purchaser Name:</strong> &nbsp; {{$property->getSoldDetail->name}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>ID Card:</strong> &nbsp; {{$property->getSoldDetail->id_card}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Sold Amount:</strong> &nbsp; {{$property->getSoldDetail->amount}}
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Commission:</strong>
                                    &nbsp; {{isset($property->getSoldDetail->commission)?$property->getSoldDetail->commission:0}}
                                </div>
                            </div>
                        @endif

                        @if(isset($property->getSoldDetail->getImages) && count($property->getSoldDetail->getImages) > 0)
                            <div class="row mb-3">
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                    <h2 class="text-info">Images</h2>
                                </div>
                                @foreach($property->getSoldDetail->getImages as $image)
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <img class="w-100" src="{{asset('public/sold_property/'.$image->image)}}"
                                             alt="">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <!-- File export table -->
                                <section id="file-export">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <div class="table-responsive">
                                                <table id="custom-table"
                                                       class="table table-striped table-bordered file-export">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>
                                                            <div class="row mb-3 justify-content-center">
                                                                <div class="col-md-12 text-center">
                                                                    <h4 class="text-info">Property Detail</h4>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 col-sm-12">
                                                                    <strong>Society Name:</strong> <span
                                                                        class="text-info">{{$property->society}}</span>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Phase:</strong> <span
                                                                        class="text-info">{{$property->phase}}</span>
                                                                </div>

                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>H/Plot #:</strong> <span
                                                                        class="text-info"> {{$property->plot_no}}</span>
                                                                </div>

                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Block:</strong> <span
                                                                        class="text-info">{{$property->block}}</span>
                                                                </div>

                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Area:</strong> <span
                                                                        class="text-info">{{$property->area}}</span>
                                                                </div>

                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Area Size:</strong> <span
                                                                        class="text-info">{{$property->area_size}}</span>
                                                                </div>

                                                                <div class="col-md-12 col-lg-12 col-sm-12">
                                                                    <strong>Plot Type:</strong> <span
                                                                        class="text-info">{{$property->plot_type}}</span>
                                                                </div>

                                                                <div class="col-md-12 col-lg-12 col-sm-12">
                                                                    <strong>Property Type:</strong> <span
                                                                        class="text-info">{{$property->property_type}}</span>
                                                                </div>

                                                                <div class="col-md-12 col-lg-12 col-sm-12">
                                                                    <strong>Property For:</strong> <span
                                                                        class="text-info">{{$property->property_for}}</span>
                                                                </div>
                                                            </div>

                                                            {{--                                                            @if(isset($property->owner_name) && isset($property->owner_number) && isset($property->id_card))--}}
                                                            {{--                                                                <div class="row mb-3">--}}
                                                            {{--                                                                    <div class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">--}}
                                                            {{--                                                                        <h4 class="text-info">External Owner Detail</h4>--}}
                                                            {{--                                                                    </div>--}}

                                                            {{--                                                                    <div class="col-md-4 col-lg-4 col-sm-12">--}}
                                                            {{--                                                                        <strong>Owner Name</strong> <span class="text-info"> {{$property->owner_name}} </span>--}}
                                                            {{--                                                                    </div>--}}

                                                            {{--                                                                    <div class="col-md-4 col-lg-4 col-sm-12">--}}
                                                            {{--                                                                        <strong>Owner Mobile Number:</strong> <span class="text-info">{{$property->owner_number}}</span>--}}
                                                            {{--                                                                    </div>--}}

                                                            {{--                                                                    <div class="col-md-4 col-lg-4 col-sm-12">--}}
                                                            {{--                                                                        <strong>Owner CNIC:</strong> <span class="text-info">{{$property->id_card}}</span>--}}
                                                            {{--                                                                    </div>--}}
                                                            {{--                                                                </div>--}}
                                                            {{--                                                            @endif--}}

                                                        </th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>
                                                            @if(isset($property->getSoldDetail))
                                                                <div class="row mb-3 justify-content-center">
                                                                    <div
                                                                        class="col-md-12 col-lg-12 col-sm-12 text-center mt-2">
                                                                        <h4 class="text-info">Purchaser Detail</h4>
                                                                    </div>

                                                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                                                        <strong>Sold By:</strong>
                                                                        &nbsp; {{isset($property->getSoldDetail->getUser)?$property->getSoldDetail->getUser->name:"User Deleted"}}
                                                                    </div>

                                                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                                                        <strong>Purchaser Name:</strong>
                                                                        &nbsp; {{$property->getSoldDetail->name}}
                                                                    </div>

                                                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                                                        <strong>ID Card:</strong>
                                                                        &nbsp; {{$property->getSoldDetail->id_card}}
                                                                    </div>

                                                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                                                        <strong>Sold Amount:</strong>
                                                                        &nbsp; {{$property->getSoldDetail->amount}}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </th>
                                                        <th></th>
                                                    </tr>

                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Start Date</th>
                                                        <th>Next Date</th>
                                                        <th>Amount</th>
                                                        <th>Remaining</th>
                                                        <th>Description</th>
                                                        <th>Created Date</th>
                                                    </tr>
                                                    @if(count($property->getSoldDetail->getSoldIteration))
                                                        @foreach($property->getSoldDetail->getSoldIteration as $iteration)
                                                            <tr>
                                                                <td>{{isset($iteration->getEntity)?$iteration->getEntity->name:"-"}}</td>
                                                                <td>{{isset($iteration->start_date)?$iteration->start_date:"-"}}</td>
                                                                <td>{{isset($iteration->next_date)?$iteration->next_date:"-"}}</td>
                                                                <td>{{isset($iteration->amount)?number_format($iteration->amount,2):"-"}}</td>
                                                                <td>{{isset($iteration->remaining)?number_format($iteration->remaining,2):"-"}}</td>
                                                                <td>{{isset($iteration->description)?$iteration->description:"-"}}</td>
                                                                <td>{{$iteration->created_at->format('d-M-Y')}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>
                                                            <div class="d-flex">
                                                                <strong>
                                                                    Total Amount:
                                                                    <span class="text-info">
                                                                        {{isset($property->getSoldDetail->amount)?number_format($property->getSoldDetail->amount):0}}
                                                                    </span>
                                                                    (PKR)
                                                                </strong>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="d-flex">
                                                                <strong>
                                                                    Remaining Amount:
                                                                    <span class="text-info">
                                                                        {{isset($property->getSoldDetail->getSoldIteration->last()->remaining)?number_format($property->getSoldDetail->getSoldIteration->last()->remaining):"-"}}
                                                                    </span>
                                                                    (PKR)
                                                                </strong>
                                                            </div>
                                                        </th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- File export table -->
                            </div>
                        </div>

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

