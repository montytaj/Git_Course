@extends('lawyers.master')

@section('content')

    <div class="container row mx-auto align-items-center" style="margin-top: 50px; margin-bottom: 200px;" >
        <div class="row">
                
            <div class="col-md-4">
                <a href="{{ URL::to('lawyers/active_orders') }}">    
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                      <b>  الطلبات الجديدة  </b> </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Counts['CountCustomOrders']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-comments fa-2x text-gray-800"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ URL::to('lawyers/lawyer_done_offers') }}">    
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                       <b> الطلبات   المنجزة   </b></div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Counts['CountDoneCustomOrderOffers']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

                        <div class="col-md-4">
                <a href="{{ URL::to('lawyers/lawyer_done_offers') }}">    
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       <b> العائد    </b></div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Counts['TotalAmount']}} ريال </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>    
            </div>
        </div>

        <div class="row" style="display: none;">
            <div class="col-md-3">
                <a href="branches">    
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Five</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">5000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-bars fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>    
            </div>
                
            <div class="col-md-3">
                <a href="warehouses_types">    
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Six</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">6000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="branches">    
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Siven</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">7000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="warehouses_types">    
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Eaigt</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">8000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
     </div>

@endsection


<style>
    .grid_3{
        float: right;
        margin-bottom: 20px;
        margin-left: 20px;
        margin-right: 20px;
        width: 260px;
        /*margin: 0 auto;*/
    }
    li {
          position: relative;
          /*margin-left: -15px;*/
          list-style: none;
    }

    .row{
        /*background-color: red;*/
    }
    .row .col-md-4 {
        /*background-color: red;*/
        margin-bottom: 10px;
        /*margin-left: 1px;*/
        /*margin-right: 1px;*/
        /*width: 280px;*/
    }
    b{
        /*background-color: red;*/
        size: 100px;
        font-size: 20px;
    }
</style>