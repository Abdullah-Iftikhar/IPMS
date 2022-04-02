@extends('layouts.layout')
@section('dashboard.content-view')
    <!-- BEGIN: Content-->

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Settings</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Profile</a>
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
                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <form action="{{route('admin.update.profile')}}" method="post">
                                                    @csrf
                                                    <fieldset class="form-group">
                                                        <input type="text" name="name"
                                                               value="{{auth()->user()->name}}"
                                                               placeholder="Write your name" class="form-control"
                                                               id="basicInput" required>
                                                        @if($errors->has('name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <input type="email" name="email"
                                                               value="{{auth()->user()->email}}"
                                                               placeholder="Write your email" class="form-control"
                                                               id="basicInput" required>
                                                        @if($errors->has('email'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('email')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <input type="password" name="password"
                                                               value="{{old('password')}}"
                                                               placeholder="write new password" class="form-control"
                                                               id="basicInput">
                                                        @if($errors->has('password'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('password')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <button type="submit" class="btn btn-success">Update
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

