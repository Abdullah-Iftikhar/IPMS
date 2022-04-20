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
                            <a href="#">Iteration</a>
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
                                                    action="{{route('admin.sold.property.post.iteration', $soldProperty->id)}}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="from-data">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Iteration Type</label>
                                                                    <select name="iteration" id="" class="form-control">
                                                                        <option selected disabled>Choose One</option>
                                                                        @foreach($iterations as $iteration)
                                                                            <option
                                                                                value="{{$iteration->id}}">{{$iteration->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if($errors->has('iteration'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('iteration')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Start Date</label>
                                                                    <input type="date" name="start_date" required
                                                                           class="form-control"
                                                                           value="{{old('start_date')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('start_date'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('start_date')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Next Date</label>
                                                                    <input type="date" name="next_date" required
                                                                           class="form-control"
                                                                           value="{{old('next_date')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('next_date'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('next_date')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Bank</label>
                                                                    <select name="bank" id="" class="form-control">
                                                                        <option selected disabled>Cash</option>
                                                                        @foreach($banks as $bank)
                                                                            <option
                                                                                value="{{$bank->id}}">{{$bank->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if($errors->has('iteration'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('iteration')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Amount</label>
                                                                    <input type="number"  title="remaining amount is {{isset($remainingAmount)?$remainingAmount:0}}" onkeyup="if(this.value > {{isset($remainingAmount)?$remainingAmount:""}}) this.value = null;"  name="amount" required
                                                                           class="form-control"
                                                                           value="{{old('amount')}}"
                                                                           id="basicInput">
                                                                    @if($errors->has('amount'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('amount')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control" id="" cols="30"
                                                                              rows="10"></textarea>
                                                                    @if($errors->has('description'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('description')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row justify-content-center border-top-black">
                                                        <fieldset class="form-group center mt-2">
                                                            <a href="{{\Illuminate\Support\Facades\URL::previous()}}"
                                                               class="btn btn-primary">Back</a>
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

