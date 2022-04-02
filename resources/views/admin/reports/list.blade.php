@extends('layouts.layout')
@push('dashboard.scripts-head')
@endpush
@section('dashboard.content-view')
    <!-- BEGIN: Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">@if($key == "sold") Sold @endif @if($key == "rent") Rent @endif Report</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">List</a>
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
                <div class="card-content collpase show">
                    <div class="card-body card-dashboard">
                        <form action="" method="get">
                            @php
                                $month = date('m');
                                $day = date('d');
                                $year = date('Y');
                                $today = $year . '-' . $month . '-' . $day;
                            @endphp
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="date" name="start_date"
                                               value="{{isset($_GET['start_date'])?$_GET['start_date']:old('start_date')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="date" name="end_date"
                                               value="{{isset($_GET['end_date'])?$_GET['end_date']:old('end_date')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                    <small class="clear-filter">
                                        <a href="{{route('admin.report.index', $key)}}">Clear Filter</a>
                                    </small>
                                </div>

                                <div class="col-2">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="table-responsive">
                                    @if(count($properties) > 0)
                                        <table class="table table-striped table-bordered file-export">
                                            <thead>
                                            <tr>
                                                <th>Property Detail</th>
                                                <th>Property Rate</th>
                                                <th>
                                                    @if(isset($key) && $key === 'rent') Advance Amount @endif
                                                    @if(isset($key) && $key === 'sold') Sold Amount @endif
                                                </th>
                                                <th>Person Detail</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $total = 0;
                                            @endphp

                                            @foreach($properties as $property)
                                                @php
                                                    if(isset($key) && $key == "rent" && isset($property->getRentDetail)) {
                                                         $total = $total + $property->getRentDetail->advance_amount;
                                                    }

                                                    if(isset($key) && $key == "sold" && isset($property->getSoldDetail)) {
                                                         $total = $total + $property->getSoldDetail->amount;
                                                    }
                                                @endphp

                                                <tr>
                                                    <td>
                                                        <a href="{{route('admin.property.detail', $property->id)}}">
                                                            {{$property->plot_no}}
                                                        </a>, {{$property->block}}, {{$property->phase}}
                                                        , {{$property->society}}
                                                    </td>
                                                    <td>{{$property->rate}}</td>
                                                    <td>
                                                        @if(isset($key) && $key === 'rent')
                                                            {{isset($property->getRentDetail)?number_format($property->getRentDetail->advance_amount): 0}}
                                                        @endif

                                                        @if(isset($key) && $key === 'sold')
                                                            {{isset($property->getSoldDetail)?number_format($property->getSoldDetail->amount) : 0}}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if(isset($key) && $key === 'rent')
                                                            @if(isset($property->getRentDetail))
                                                                <strong>Name:</strong> {{$property->getRentDetail->name}}
                                                                <br>
                                                                <strong>ID
                                                                    Card:</strong> {{$property->getRentDetail->id_card}}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif

                                                        @if(isset($key) && $key === 'sold')
                                                            @if(isset($property->getSoldDetail))
                                                                <strong>Name:</strong> {{$property->getSoldDetail->name}}
                                                                <br>
                                                                <strong>ID
                                                                    Card:</strong> {{$property->getSoldDetail->id_card}}
                                                            @else
                                                                -
                                                            @endif
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>
                                                    <div class="d-flex">
                                                        <strong>
                                                            Expense:
                                                            <span class="text-info">
                                                                {{isset($properties)?number_format($properties->sum('rate')):0}}
                                                            </span>
                                                            (PKR)
                                                        </strong>
                                                    </div>
                                                </th>
                                                <th>
                                                    <strong>
                                                        @if(isset($key) && $key === 'rent') Total Advance Amount: @endif
                                                        @if(isset($key) && $key === 'sold') Total Sold Amount: @endif
                                                        <span class="text-info">{{number_format($total)}}</span>
                                                        (PKR)
                                                    </strong>
                                                </th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    @else
                                        <p class="text-center">No Record Found.</p>
                                    @endif
                                </div>
                                {{--                                @php--}}
                                {{--                                    $arra = array();--}}
                                {{--                                       if (isset($_GET['start_date'])) {--}}
                                {{--                                           $arra['start_date'] = trim($_GET['start_date']);--}}
                                {{--                                       }--}}

                                {{--                                       if (isset($_GET['end_date'])) {--}}
                                {{--                                           $arra['end_date'] = trim($_GET['end_date']);--}}
                                {{--                                       }--}}
                                {{--                                @endphp--}}
                                {{--                                @include('include.pagination',['paginator' => $properties->appends($arra)])--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- Alert animation end -->
    </div>
    <!-- END: Content-->

@stop

@push('dashboard.scripts-footer')
    <!-- BEGIN: Page Vendor JS-->
    <script src="https://unpkg.com/promise-polyfill" type="text/javascript"></script>
    <script src="{{asset('assets/dashboard/app-assets/vendors/js/extensions/sweetalert2.all.js')}}"
            type="text/javascript"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{asset('assets/dashboard/assets/js/scripts.js')}}" type="text/javascript"></script>
@endpush
