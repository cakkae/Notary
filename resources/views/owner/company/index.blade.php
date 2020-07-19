@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('company.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Company</a></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Company</th>
                            <th>URL</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        @forelse($companies as $key => $company)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ strtolower($company->company_name.'.notary.com') }}</td>
                                <td><a href="{{ route('company.edit', $company->id)}}" class="btn btn-primary" ><i class="fa fa-pencil"></i></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <h2>There is no company</h2>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
