@extends('layouts.layout')

@section('dashboard.content-view')
    <!-- BEGIN: Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Property Iteration</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">
                                @if(isset($iteration) && $iteration) Edit @else Create @endif
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
                                                    action="{{isset($iteration)?route('admin.property.iteration.update', $iteration->id):route('admin.property.iteration.store')}}"
                                                    method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="from-data">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <fieldset class="form-group">
                                                                    <label>Name <span class="text-danger">*</span></label>
                                                                    <input type="text" name="name" required
                                                                           value="{{isset($iteration)?$iteration->name:old('name')}}"
                                                                           class="form-control"
                                                                           id="basicInput">
                                                                    @if($errors->has('name'))
                                                                        <div class="error"
                                                                             style="color:red">{{$errors->first('name')}}</div>
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center border-top-black">
                                                        <fieldset class="form-group center mt-2">
                                                            <a href="{{route('admin.property.iteration.list')}}"
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

