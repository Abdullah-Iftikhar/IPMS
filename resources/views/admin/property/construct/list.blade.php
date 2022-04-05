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
                            <a href="">Construct Property</a>
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
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <p class="float-left">
                                        <strong class="font-size-large">Total Construct Properties: <span
                                                class="text-info">{{$propertiesCounter}}</span></strong>
                                    </p>
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="society" placeholder="Society Name"
                                               value="{{isset($_GET['society'])?$_GET['society']:old('society')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="plot_number" placeholder="Plot/H #"
                                               value="{{isset($_GET['plot_number'])?$_GET['plot_number']:old('plot_number')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="block" placeholder="Block"
                                               value="{{isset($_GET['block'])?$_GET['block']:old('block')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="phase" placeholder="Phase"
                                               value="{{isset($_GET['phase'])?$_GET['phase']:old('phase')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="plot_type" class="form-control">
                                            <option selected disabled>Plot Type</option>
                                            <option value="Commercial"
                                                    @if(isset($_GET['plot_type']) && $_GET['plot_type'] == "Commercial") selected @endif>
                                                Commercial
                                            </option>
                                            <option value="Residential"
                                                    @if(isset($_GET['plot_type']) && $_GET['plot_type'] == "Residential") selected @endif>
                                                Residential
                                            </option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="property_type" required class="form-control">
                                            <option selected disabled>Property Type</option>
                                            <option value="plot"
                                                    @if(isset($_GET['property_type']) && $_GET['property_type'] == "plot") selected @endif>
                                                Plot
                                            </option>
                                            <option value="home"
                                                    @if(isset($_GET['property_type']) && $_GET['property_type'] == "home") selected @endif>
                                                Home
                                            </option>
                                            <option value="plaza"
                                                    @if(isset($_GET['property_type']) && $_GET['property_type'] == "plaza") selected @endif>
                                                Plaza
                                            </option>
                                            <option value="flat"
                                                    @if(isset($_GET['property_type']) && $_GET['property_type'] == "flat") selected @endif>
                                                Flat
                                            </option>
                                            <option value="farmhouse"
                                                    @if(isset($_GET['property_type']) && $_GET['property_type'] == "farmhouse") selected @endif>
                                                Farmhouse
                                            </option>
                                            <option value="upper portion"
                                                    @if(isset($_GET['property_type']) && $_GET['property_type'] == "upper portion") selected @endif>
                                                Upper Portion
                                            </option>
                                            <option value="lower portion"
                                                    @if(isset($_GET['property_type']) && $_GET['property_type'] == "lower portion") selected @endif>
                                                Lower Portion
                                            </option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="area" required class="form-control">
                                            <option selected disabled>Area</option>
                                            <option value="marla" @if(isset($_GET['property_for']) && $_GET['property_for'] == "marla") selected @endif>Marla</option>
                                            <option value="canal" @if(isset($_GET['property_for']) && $_GET['property_for'] == "canal") selected @endif>Canal</option>
                                            <option value="acre" @if(isset($_GET['property_for']) && $_GET['property_for'] == "acre") selected @endif>Acre</option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="number" name="area_size" placeholder="Area Size"
                                               value="{{isset($_GET['area_size'])?$_GET['area_size']:old('area_size')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="number" name="rate" placeholder="Price/Rate"
                                               value="{{isset($_GET['rate'])?$_GET['rate']:old('rate')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="property_for" required class="form-control">
                                            <option selected disabled>Property For</option>
                                            <option value="buy"
                                                    @if(isset($_GET['property_for']) && $_GET['property_for'] == "buy") selected @endif>
                                                Buy
                                            </option>
                                            <option value="sell"
                                                    @if(isset($_GET['property_for']) && $_GET['property_for'] == "sell") selected @endif>
                                                Sell
                                            </option>
                                            <option value="rent"
                                                    @if(isset($_GET['property_for']) && $_GET['property_for'] == "rent") selected @endif>
                                                Rent
                                            </option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="owner_name" placeholder="Owner Name"
                                               value="{{isset($_GET['owner_name'])?$_GET['owner_name']:old('owner_name')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="owner_number" placeholder="Owner Number"
                                               value="{{isset($_GET['owner_number'])?$_GET['owner_number']:old('owner_number')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="id_card" placeholder="id_card"
                                               value="{{isset($_GET['id_card'])?$_GET['id_card']:old('id_card')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                    <small class="clear-filter">
                                        <a href="{{route('admin.property.construction')}}">Clear Filter</a>
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
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Society</th>
                                                <th>Plot #</th>
                                                <th>Phase</th>
                                                <th>Area</th>
                                                <th>Area Size</th>
                                                <th>Expense</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($properties as $key=>$property)
                                                {{--                                                @dd($property->getConstructionDetail, $property->getConstructionDetail->getExpensive)--}}
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$property->society}}</td>
                                                    <td>
                                                        <a href="{{route('admin.property.construction.detail', $property->id)}}">
                                                            {{$property->plot_no}}
                                                            - {{$property->block}}
                                                        </a>
                                                    </td>
                                                    <td>{{$property->phase}}</td>
                                                    <td>{{$property->area}}</td>
                                                    <td>{{$property->area_size}}</td>
                                                    <td>{{isset($property->getConstructionDetail)?isset($property->getConstructionDetail->getExpensive)?number_format($property->getConstructionDetail->getExpensive->sum('price')):0:0}}</td>
                                                    <td>{{$property->created_at->format('d-m-Y')}}</td>
                                                    <td class="@if(isset($property->getConstructionDetail) && $property->getConstructionDetail->status === 'completed') text-success @endif">{{isset($property->getConstructionDetail)?$property->getConstructionDetail->status:"-"}}</td>
                                                    <td>
                                                        <span class="dropdown option_list">
                                                            <button id="btnSearchDrop" type="button"
                                                                    class="btn btn-sm btn-icon btn-pure font-medium-2 table-drop-menu"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ft-more-vertical"></i>
                                                            </button>
                                                            <span aria-labelledby="btnSearchDrop"
                                                                  class="dropdown-menu mt-1 dropdown-menu-right"
                                                                  x-placement="bottom-end"
                                                                  style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(55px, 27px, 0px);">

                                                                @if(isset($property->getConstructionDetail) && $property->getConstructionDetail->status != 'completed')
                                                                    <a href="{{route('admin.add.property.material', $property->id)}}"
                                                                       class="dropdown-item edit edit_option"
                                                                       title="Edit the value">
                                                                        <i class="ft-plus-circle"></i>
                                                                    Add Material
                                                                </a>

                                                                    <a href="{{route('admin.construction.completed', $property->id)}}"
                                                                       class="dropdown-item edit edit_option"
                                                                       title="Edit the value">
                                                                        <i class="ft-check"></i>
                                                                    Mark As Complete
                                                                </a>
                                                                @endif


                                                                <form
                                                                    action="{{route('admin.property.delete', $property->id)}}"
                                                                    method="post">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <a href="javascript:void(0);"
                                                                       class="dropdown-item delete delete_option"
                                                                       title="Danger! this action will delete the record from database">
                                                                         <i class="ft-trash-2"></i> Delete</a>
                                                                </form>
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center">No Record Found.</p>
                                    @endif
                                </div>
                                @php
                                    $arra = array();
                                       if (isset($_GET['society'])) {
                                           $arra['society'] = trim($_GET['society']);
                                       }

                                       if (isset($_GET['plot_number'])) {
                                           $arra['plot_number'] = trim($_GET['plot_number']);
                                       }

                                       if (isset($_GET['block'])) {
                                           $arra['block'] = trim($_GET['block']);
                                       }

                                       if (isset($_GET['phase'])) {
                                           $arra['phase'] = trim($_GET['phase']);
                                       }

                                       if (isset($_GET['plot_type'])) {
                                           $arra['plot_type'] = trim($_GET['plot_type']);
                                       }

                                       if (isset($_GET['property_type'])) {
                                           $arra['property_type'] = trim($_GET['property_type']);
                                       }

                                       if (isset($_GET['area'])) {
                                           $arra['area'] = trim($_GET['area']);
                                       }
                                        if (isset($_GET['area_size'])) {
                                           $arra['area_size'] = trim($_GET['area_size']);
                                       }

                                       if (isset($_GET['rate'])) {
                                           $arra['rate'] = trim($_GET['rate']);
                                       }
                                       if (isset($_GET['property_for'])) {
                                           $arra['property_for'] = trim($_GET['property_for']);
                                       }
                                       if (isset($_GET['owner_name'])) {
                                           $arra['owner_name'] = trim($_GET['owner_name']);
                                       }
                                       if (isset($_GET['owner_number'])) {
                                           $arra['owner_number'] = trim($_GET['owner_number']);
                                       }
                                       if (isset($_GET['id_card'])) {
                                           $arra['id_card'] = trim($_GET['id_card']);
                                       }
                                @endphp
                                @include('include.pagination',['paginator' => $properties->appends($arra)])
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
