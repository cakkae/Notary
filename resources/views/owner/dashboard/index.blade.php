@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                        <div class="card-counter">
                            <i class="fal fa-file-invoice"></i>
                            <span class="count-numbers">0</span>
                            <span class="count-name">Number of invoices</span>
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="card-counter">
                            <i class="fal fa-browser"></i>
                            <span class="count-numbers">599</span>
                            <span class="count-name">Instances</span>
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="card-counter">
                            <i class="fal fa-database"></i>
                            <span class="count-numbers">6875</span>
                            <span class="count-name">Data</span>
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="card-counter">
                            <i class="fal fa-users"></i>
                            <span class="count-numbers">35</span>
                            <span class="count-name">Users</span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
