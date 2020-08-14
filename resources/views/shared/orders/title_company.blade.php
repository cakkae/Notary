@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  
                </div>

                <div class="card-body ">
                   <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company</th>
                            <th>Order ID</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allRequestOrder as $key => $order)
                            <td>{{ ++$key }}</td>
                            <td>{{ \App\Models\Company::where('id', $order->company_id)->pluck('company_name')->first() }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->message }}</td>
                            <td><a href="{{ route('shared.orders.edit', $order->order_id) }}" class="btn btn-primary">Edit Order</button></td>
                        @endforeach
                    </tbody>
                   </table>
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


