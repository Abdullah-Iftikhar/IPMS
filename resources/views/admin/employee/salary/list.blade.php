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
                            <a href="">Employee</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Salary List</a>
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
                        <form action="{{route('admin.salaries.add')}}" method="post" class="mb-2">
                            @csrf
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="employee" class="form-control" id="">
                                            <option selected disabled>Choose Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('employee'))
                                            <div class="error"
                                                 style="color:red">{{$errors->first('employee')}}</div>
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="number" step="any" name="salary" placeholder="Salary"
                                               value="{{old('salary')}}"
                                               class="form-control"
                                               id="basicInput">
                                        @if($errors->has('salary'))
                                            <div class="error"
                                                 style="color:red">{{$errors->first('salary')}}</div>
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <button type="submit" class="btn btn-info">Add Salary</button>
                                </div>
                            </div>
                        </form>

                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="employee" class="form-control" id="">
                                            <option selected disabled>Choose Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}"
                                                        @if(isset($_GET['employee']) && $_GET['employee'] !='' && $_GET['employee'] == $employee->id) selected @endif>{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="number" name="cnic" placeholder="search by CNIC"
                                               value="{{isset($_GET['cnic'])?$_GET['cnic']:old('cnic')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="number" step="any" name="salary" placeholder="search by salary"
                                               value="{{isset($_GET['salary'])?$_GET['salary']:old('salary')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                    <small class="clear-filter">
                                        <a href="{{route('admin.salaries.list')}}">Clear Filter</a>
                                    </small>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-2">
                            <div class="col-12">

                                <div class="table-responsive">
                                    @if(count($salaries) > 0)
                                        <table id="custom-table"
                                               class="table table-striped table-bordered file-export">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>CNIC</th>
                                                <th>Salary</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($salaries as $key=>$salary)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{isset($salary->getEmployee)?$salary->getEmployee->name:"Not Found"}}</td>
                                                    <td>{{isset($salary->getEmployee)?$salary->getEmployee->cnic:"Not Found"}}</td>
                                                    <td>{{number_format($salary->salary, 2)}}</td>
                                                    <td>{{$salary->created_at->format('d-M-Y')}}</td>
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

                                                                <form
                                                                    action="{{route('admin.salaries.delete', $salary->id)}}"
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
                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <div class="d-flex">
                                                        <strong>
                                                            Total Amount:
                                                            <span class="text-info">
                                                                            {{isset($salaries)?number_format($salaries->sum('salary'), 2):0}}
                                                                        </span>
                                                            (PKR)
                                                        </strong>
                                                    </div>
                                                </th>
                                                <th></th>
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
                                {{--                                       if (isset($_GET['employee'])) {--}}
                                {{--                                           $arra['employee'] = trim($_GET['employee']);--}}
                                {{--                                       }--}}
                                {{--                                       if (isset($_GET['salary'])) {--}}
                                {{--                                           $arra['salary'] = trim($_GET['salary']);--}}
                                {{--                                       }--}}
                                {{--                                @endphp--}}
                                {{--                                @include('include.pagination',['paginator' => $salaries->appends($arra)])--}}
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
