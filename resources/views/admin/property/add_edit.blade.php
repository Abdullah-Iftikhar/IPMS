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
                                @if(isset($property) && $property) Edit @else Create @endif
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-md-8 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <form
                                                    action="{{isset($property)?route('admin.property.update', $property->id):route('admin.property.post')}}"
                                                    method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="from-data">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Society Name <span class="text-danger">*</span></label>
                                                                    <input type="text" name="society_name" required
                                                                           value="{{isset($property)?$property->society:old('society_name')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('society_name'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('society_name')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Plot/H # (<strong class="text-info">Optional</strong>)</label>
                                                                    <input type="text" name="plot_number"
                                                                           value="{{isset($property)?$property->plot_no:old('plot_number')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('plot_number'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('plot_number')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Block (<strong class="text-info">Optional</strong>)</label>
                                                                    <input type="text" name="block"
                                                                           value="{{isset($property)?$property->block:old('block')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('block'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('block')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Phase (<strong class="text-info">Optional</strong>)</label>
                                                                    <input type="text" name="phase"
                                                                           value="{{isset($property)?$property->phase:old('phase')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('phase'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('phase')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <label>Plot Type <span class="text-danger">*</span></label>
                                                                <fieldset class="form-group">
                                                                    <div style="display: flex">
                                                                        <div class="form-check mr-4">
                                                                            <input class="form-check-input" type="radio"
                                                                                    @if(isset($property) && $property->plot_type == "Commercial") checked @endif
                                                                                   name="plot_type" id="commercial"
                                                                                   value="Commercial">
                                                                            <label class="form-check-label"
                                                                                   for="commercial">
                                                                                Commercial
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                    @if(isset($property) && $property->plot_type == "Residential") checked @endif
                                                                                   name="plot_type" id="residential"
                                                                                   value="Residential">
                                                                            <label class="form-check-label"
                                                                                   for="residential">
                                                                                Residential
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                @if($errors->has('plot_type'))
                                                                    <div class="error"
                                                                         style="color:red">{{$errors->first('plot_type')}}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Property Type <span class="text-danger">*</span></label>
                                                                    <select name="property_type" required
                                                                            class="form-control">
                                                                        <option selected disabled>Choose One</option>
                                                                        <option value="file" @if(isset($property) && $property->property_type == "file") selected @endif>File</option>
                                                                        <option value="plot" @if(isset($property) && $property->property_type == "plot") selected @endif>Plot</option>
                                                                        <option value="home" @if(isset($property) && $property->property_type == "home") selected @endif>Home</option>
                                                                        <option value="plaza" @if(isset($property) && $property->property_type == "plaza") selected @endif>Plaza</option>
                                                                        <option value="flat" @if(isset($property) && $property->property_type == "flat") selected @endif>Flat</option>
                                                                        <option value="farmhouse" @if(isset($property) && $property->property_type == "farmhouse") selected @endif>Farmhouse</option>
                                                                        <option value="upper portion" @if(isset($property) && $property->property_type == "upper portion") selected @endif>Upper Portion</option>
                                                                        <option value="lower portion" @if(isset($property) && $property->property_type == "lower portion") selected @endif>Lower Portion</option>
                                                                        <option value="land" @if(isset($property) && $property->property_type == "land") selected @endif>Land</option>
                                                                    </select>

                                                                    @if($errors->has('property_type'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('property_type')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Area <span class="text-danger">*</span></label>
                                                                    <select name="area" required
                                                                            class="form-control">
                                                                        <option selected disabled>Choose One</option>
                                                                        <option value="marla" @if(isset($property) && $property->area == "marla") selected @endif>Marla</option>
                                                                        <option value="canal" @if(isset($property) && $property->area == "canal") selected @endif>Canal</option>
                                                                        <option value="acre" @if(isset($property) && $property->area == "acre") selected @endif>Acre</option>
                                                                    </select>
                                                                    @if($errors->has('area'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('area')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Area Size <span class="text-danger">*</span></label>
                                                                    <input type="number" step="any" name="area_size" required
                                                                           value="{{isset($property)?$property->area_size:old('area_size')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('area_size'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('area_size')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Amount (PKR) <span class="text-danger">*</span></label>
                                                                    <input type="number" step="any" name="amount"

                                                                           value="{{isset($property)?$property->rate:old('amount')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('amount'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('amount')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <label>Property For <span class="text-danger">*</span></label>
                                                                <fieldset class="form-group">
                                                                    <div style="display: flex">
                                                                        <div class="form-check mr-4">
                                                                            <input class="form-check-input" type="radio"
                                                                                    @if(isset($property) && $property->property_for == "rent") checked @endif
                                                                                   name="property_for" id="rent"
                                                                                   value="rent">
                                                                            <label class="form-check-label"
                                                                                   for="rent">
                                                                                Rent
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check mr-4">
                                                                            <input class="form-check-input" type="radio"
                                                                                    @if(isset($property) && $property->property_for == "sell") checked @endif
                                                                                   name="property_for" id="sell"
                                                                                   value="sell">
                                                                            <label class="form-check-label"
                                                                                   for="sell">
                                                                                Sell
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                    @if(isset($property) && $property->property_for == "buy") checked @endif
                                                                                   name="property_for" id="buy"
                                                                                   value="buy">
                                                                            <label class="form-check-label"
                                                                                   for="buy">
                                                                                Buy
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                @if($errors->has('property_for'))
                                                                    <div class="error"
                                                                         style="color:red">{{$errors->first('property_for')}}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                For external Owner (<strong
                                                                    class="text-info">Optional</strong>)
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <input type="text" name="owner_name"
                                                                           placeholder="Owner Name"
                                                                           value="{{isset($property)?$property->owner_name:old('owner_name')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('owner_name'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('owner_name')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <input type="text" name="mobile_number"
                                                                           placeholder="Owner Mobile Number"
                                                                           value="{{isset($property)?$property->owner_number:old('owner_name')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('mobile_number'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('mobile_number')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <input type="number" name="id_card"
                                                                           placeholder="Id Card Number"
                                                                           value="{{isset($property)?$property->id_card:old('id_card')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('id_card'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('id_card')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center border-top-black">
                                                        <fieldset class="form-group center mt-2">
                                                            <a href="{{route('admin.property.list')}}"
                                                               class="btn btn-primary">View All</a>
                                                            <button type="submit" class="btn btn-success">submit
                                                            </button>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

