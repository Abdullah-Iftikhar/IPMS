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
                            <a href="">Bank Accounts</a>
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
                        <form action="{{route('admin.bank.account.save')}}" method="post" class="mb-2">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="bank" id="" class="form-control">
                                            <option selected disabled>Choose One Bank</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{$bank->id}}" @if(old('bank') == $bank->id) selected @endif>{{$bank->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('bank'))
                                            <div class="error"
                                                 style="color:red">{{$errors->first('bank')}}</div>
                                        @endif
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="account_title" placeholder="Account Title"
                                               value="{{old('account_title')}}"
                                               class="form-control"
                                               id="basicInput">
                                        @if($errors->has('account_title'))
                                            <div class="error"
                                                 style="color:red">{{$errors->first('account_title')}}</div>
                                        @endif
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="account_number" placeholder="Account Number"
                                               value="{{old('account_number')}}"
                                               class="form-control"
                                               id="basicInput">
                                        @if($errors->has('account_number'))
                                            <div class="error"
                                                 style="color:red">{{$errors->first('account_number')}}</div>
                                        @endif
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="number" name="amount" placeholder="Amount"
                                               value="{{old('amount')}}"
                                               class="form-control"
                                               id="basicInput">
                                        @if($errors->has('amount'))
                                            <div class="error"
                                                 style="color:red">{{$errors->first('amount')}}</div>
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <button type="submit" class="btn btn-info">Add Account</button>
                                </div>
                            </div>
                        </form>

                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <select name="bank" id="" class="form-control">
                                            <option selected disabled>Choose One Bank</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{$bank->id}}" @if(isset($_GET['bank']) && $_GET['bank'] == $bank->id) selected @endif>{{$bank->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="account_title" placeholder="search by account title"
                                               value="{{isset($_GET['account_title'])?$_GET['account_title']:old('account_title')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="account_number" placeholder="search by account number"
                                               value="{{isset($_GET['account_number'])?$_GET['account_number']:old('account_number')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <fieldset class="form-group">
                                        <input type="text" name="amount" placeholder="search by amount"
                                               value="{{isset($_GET['amount'])?$_GET['amount']:old('amount')}}"
                                               class="form-control"
                                               id="basicInput">
                                    </fieldset>
                                    <small class="clear-filter">
                                        <a href="{{route('admin.bank.account.list')}}">Clear Filter</a>
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
                                    @if(count($accounts) > 0)
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Bank</th>
                                                <th>Acc Title</th>
                                                <th>Acc Number</th>
                                                <th>Balance</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($accounts as $key=>$account)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{isset($account->getBank)?$account->getBank->name : "-"}}</td>
                                                    <td>{{$account->acc_title}}</td>
                                                    <td>
                                                        <a href="{{route('admin.bank.account.transactions', $account->acc_number)}}">{{$account->acc_number}}</a>
                                                    </td>
                                                    <td>{{number_format($account->amount, 2)}}</td>
                                                    <td>{{$account->created_at->diffForHumans()}}</td>
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

                                                                <form action="{{route('admin.bank.account.delete', $account->id)}}"
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
                                       if (isset($_GET['bank'])) {
                                           $arra['bank'] = trim($_GET['bank']);
                                       }

                                        if (isset($_GET['account_title'])) {
                                            $arra['account_title'] = trim($_GET['account_title']);
                                        }

                                        if (isset($_GET['account_number'])) {
                                            $arra['account_number'] = trim($_GET['account_number']);
                                        }

                                        if (isset($_GET['amount'])) {
                                            $arra['amount'] = trim($_GET['amount']);
                                        }
                                @endphp
                                @include('include.pagination',['paginator' => $accounts->appends($arra)])
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
