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
                            <a href="">Account # 2323</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Transactions</a>
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
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>


                        @if (count($transactions) > 0)
                            <div class="row mt-2">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <!-- File export table -->
                                    <section id="file-export">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <div class="table-responsive">
                                                    <table id="custom-table"
                                                           class="table table-striped table-bordered file-export">
                                                        <thead>
                                                        <tr>
                                                            <th>Property Detail</th>
                                                            <th>Property Status</th>
                                                            <th>Transaction</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($transactions as $transaction)
                                                            <tr>
                                                                <td> @if(isset($transaction->getProperty))
                                                                        H # {{$transaction->getProperty->plot_no}}
                                                                        -{{$transaction->getProperty->block}}
                                                                        <strong>,</strong>
                                                                        Phase-{{$transaction->getProperty->phase}}
                                                                        <strong>,</strong> {{$transaction->getProperty->society}}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{isset($transaction->getProperty)?$transaction->getProperty->status:"-"}}
                                                                </td>
                                                                <td>{{number_format($transaction->transaction,2)}}</td>
                                                                <td>{{number_format($transaction->amount,2)}}</td>
                                                                <td>{{$transaction->created_at->format('d-M-Y')}}</td>
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
                                                                        Acc # <span class="text-info">{{$transactions->last()?$transactions->last()->acc_number:0}}</span> - Amount:
                                                                        <span class="text-info">
                                                                            {{$transactions->last()?number_format($transactions->last()->amount, 2):0}}
                                                                        </span>
                                                                        (PKR)
                                                                    </strong>
                                                                </div>
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- File export table -->
                                </div>
                            </div>
                        @endif
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
