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
                            <a href="">Property</a>
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
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                   <div class="row">
                                       <div class="col-10">
                                           <fieldset class="form-group">
                                               <input type="text" name="name" placeholder="name"
                                                      value="{{isset($_GET['name'])?$_GET['name']:old('name')}}"
                                                      class="form-control"
                                                      id="basicInput">
                                           </fieldset>
                                           <small class="clear-filter">
                                               <a href="{{route('admin.property.iteration.list')}}">Clear Filter</a>
                                           </small>
                                       </div>
                                       <div class="col-2">
                                           <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                       </div>
                                   </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <a href="{{route('admin.property.iteration.add')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a>
                                </div>

                            </div>
                        </form>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="table-responsive">
                                    @if(count($iterations) > 0)
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($iterations as $key=>$iteration)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$iteration->name}}</td>
                                                    <td>{{$iteration->created_at->format('d-m-Y')}}</td>
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

                                                                <a href="{{route('admin.property.iteration.edit', $iteration->id)}}"
                                                                   class="dropdown-item edit edit_option"
                                                                   title="Edit the value">
                                                                        <i class="ft-edit-2"></i>
                                                                    Edit
                                                                </a>

                                                                <form
                                                                    action="{{route('admin.property.iteration.destroy', $iteration->id)}}"
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
                                       if (isset($_GET['name'])) {
                                           $arra['name'] = trim($_GET['name']);
                                       }
                                @endphp
                                @include('include.pagination',['paginator' => $iterations->appends($arra)])
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
