@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block order_menu_font" data-toggle="modal" data-target="#addOrderModal"><i class="fal fa-edit"></i> New Order</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block order_menu_font"><i class="fal fa-filter"></i> Filter</button>
                        </div>
                        <div class="col-md-3 offset-md-1">
                            <input type="text" class="form-control order_menu_font" name="search_order" id="search_order">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block order_menu_font"><i class="fal fa-search"></i> Search</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary order_menu_font btn-block"><i class="fad fa-filter"></i> Advanced</button>
                        </div>
                    </div>
                </div>

                <div class="card-body ">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tag {
    background-color: #3490dc !important;
    padding: 10px;
    font-weight: bold;
    color: white;
    line-height: 20px;
}
.modal-xl {
    max-width: 90% !important;
}
.order_menu_font {
    font-size: 14px;
}
.py-20 {
    margin-top: 10px;
}
#notary_list {
    width: 100% !important;
}
.hide {
    display: none;
}
.show {
    display: inline-block;
}
.progress { position:relative; width:90%; margin-left: 5%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; margin-top: 15px; height: 30px;}
.bar { background-color: #B4F5B4; width:0%; height:30px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:15px; left:48%; color: #7F98B2; }
</style>

@endsection


