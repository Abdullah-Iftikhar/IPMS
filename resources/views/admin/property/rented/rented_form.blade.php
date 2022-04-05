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
                            <a href="#">Rented</a>
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
                                                <form action="{{route('admin.property.rented.detail', $property->id)}}"
                                                      method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="from-data">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Agent Name</label>
                                                                    <input type="text" required
                                                                           value="{{auth()->user()->name}}"
                                                                           class="form-control" readonly>
                                                                </fieldset>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Name (Sold To)</label>
                                                                    <input type="text" name="name" required
                                                                           class="form-control" value="{{old('name')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('name'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('name')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Phone Number</label>
                                                                    <input type="number" name="phone_number" required
                                                                           class="form-control"
                                                                           value="{{old('phone_number')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('phone_number'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('phone_number')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Id Card</label>
                                                                    <input type="number" name="id_card" required
                                                                           class="form-control"
                                                                           value="{{old('id_card')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('id_card'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('id_card')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Bank Account</label>
                                                                    <select name="bank_account" id=""
                                                                            class="form-control">
                                                                        <option selected value="">Cash</option>
                                                                        @foreach($accounts as $account)
                                                                            <option
                                                                                value="{{$account->id}}">{{$account->acc_title}}
                                                                                ({{$account->acc_number}})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if($errors->has('bank_account'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('bank_account')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Advance Amount</label>
                                                                    <input type="number" name="advance_amount" required
                                                                           class="form-control"
                                                                           value="{{old('advance_amount')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('advance_amount'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('advance_amount')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Monthly Rent</label>
                                                                    <input type="number" name="monthly_rent" required
                                                                           class="form-control"
                                                                           value="{{old('monthly_rent')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('monthly_rent'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('monthly_rent')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Commission Commission</label>
                                                                    <input type="number" step="any"
                                                                           value="{{old('commission')}}"
                                                                           name="commission"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('commission'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('commission')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Pictures - Id card, Agreement etc.
                                                                        &nbsp;<span
                                                                            class="text-info">(<strong>Optional</strong>)</span></label>
                                                                    <input type="file" name="images[]"
                                                                           class="form-control" multiple
                                                                           id="basicInput">
                                                                    @if($errors->has('images'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('images')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Remarks
                                                                        &nbsp;<span
                                                                            class="text-info">(<strong>Optional</strong>)</span>
                                                                    </label>
                                                                    <textarea class="form-control" name="remarks" id=""
                                                                              cols="30"
                                                                              rows="10"></textarea>
                                                                    @if($errors->has('remarks'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('remarks')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center border-top-black">
                                                        <fieldset class="form-group center mt-2">
                                                            <a href="{{route('admin.property.sold')}}"
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

