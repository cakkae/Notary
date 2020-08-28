@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('notary.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Notary</a></div>
                <div class="card-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Password</th>
                        <th>Phone#</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($notaries as $key => $notary)
                        <?php $company = \App\Models\Company::where('id',$notary->company_id)->first(); ?>
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $notary->name.' '.$notary->lastName }}</td>
                            <td>{{ $notary->email }}</td>
                            <td>{{ $company->company_name }}</td>
                            <td><a href="#">Set</a>/<a href="#">Reset</a></td>
                            <td>{{ $notary->phone }}</td>
                            <td><a href="#">Edit</a>/<a href="#">Remove</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="font-size: 22px; text-align: center;">No results</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
