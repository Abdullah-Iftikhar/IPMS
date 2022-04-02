@extends('layouts.layout')

@section('dashboard.content-view')
    <!-- BEGIN: Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Construction</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Material</a>
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
                                    <div class="col-md-12 col-sm-12 text-right">
                                        <a href="{{route('admin.property.construction')}}" class="btn btn-dark">Back</a>
                                    </div>
                                    <div class="col-xl-8 col-md-8 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <form
                                                    action="{{route('admin.post.property.material')}}"
                                                    method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="from-data">
                                                        <div class="row">
                                                            <input type="hidden" name="property_id" value="{{$property->id}}">
                                                            <input type="hidden" name="construction_id" value="{{$construction->id}}">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Materials</label>
                                                                    <select name="material" id="" class="form-control">
                                                                        <option selected disabled>Choose One</option>
                                                                        @foreach($materials as $material)
                                                                            <option value="{{$material->id}}" @if(old('material') == $material->id) selected @endif>{{$material->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if($errors->has('material'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('material')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="description"  class="form-control" cols="30"
                                                                              rows="10" required>{{old('description')}}</textarea>
                                                                    @if($errors->has('description'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('description')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Amount</label>
                                                                    <input type="number" step="any" name="amount" required
                                                                           value="{{old('account')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('account'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('account')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center border-top-black">
                                                        <fieldset class="form-group center mt-2">
                                                            <a href="{{route('admin.property.construction')}}"
                                                               class="btn btn-primary">View All</a>
                                                            <button type="submit" class="btn btn-success">submit</button>
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

