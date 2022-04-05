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
                                <div class="col-md-6 text-left">
                                    <strong>Profit Amount:</strong>&nbsp; <span
                                        class="text-info">{{number_format($property->getSoldDetail->amount - $property->rate)}}</span>
                                </div>
                            @endif
                            <div class="col-md-6 text-right">
                                <a href="{{route('admin.sold.property.iteration',$property->getSoldDetail->id)}}" class="btn btn-info">Add Iteration</a>
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
                                                        <th>Type</th>
                                                        <th>Start Date</th>
                                                        <th>Next Date</th>
                                                        <th>Amount</th>
                                                        <th>Description</th>
                                                        <th>Created Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--                                                        @foreach($searchMaterials as $expense)--}}
                                                    {{--                                                            <tr>--}}
                                                    {{--                                                                <td>H # {{$property->plot_no}}-{{$property->block}}--}}
                                                    {{--                                                                    <strong>,</strong> Phase-{{$property->phase}}--}}
                                                    {{--                                                                    <strong>,</strong> {{$property->society}}</td>--}}
                                                    {{--                                                                <td>{{isset($expense->getMaterial)?$expense->getMaterial->name:"-"}}</td>--}}
                                                    {{--                                                                <td>{{number_format($expense->price,2)}}</td>--}}
                                                    {{--                                                                <td>{{$expense->desc}}</td>--}}
                                                    {{--                                                                <td>{{$expense->created_at->format('d-M-Y')}}</td>--}}
                                                    {{--                                                            </tr>--}}
                                                    {{--                                                        @endforeach--}}
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>
                                                            {{--                                                                <div class="d-flex">--}}
                                                            {{--                                                                    <strong>--}}
                                                            {{--                                                                        Total Expense:--}}
                                                            {{--                                                                        <span class="text-info">--}}
                                                            {{--                                                                            {{isset($searchMaterials)?number_format($searchMaterials->sum('price'), 2):0}}--}}
                                                            {{--                                                                        </span>--}}
                                                            {{--                                                                        (PKR)--}}
                                                            {{--                                                                    </strong>--}}
                                                            {{--                                                                </div>--}}
                                                        </th>
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

