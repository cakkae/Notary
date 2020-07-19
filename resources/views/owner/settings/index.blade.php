@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3> Super Admin panel </h3></div>

                <div class="card-body">
                    <div class="card-header tab-card-header" style="background-color: transparent; border-bottom: 0px;">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
                            </li>
                            <li class="nav-item" style="margin-left: 30px;">
                                <a class="nav-link" id="superAdmin-tab" data-toggle="tab" href="#superAdmin" role="tab" aria-controls="superAdmin" aria-selected="true">Super Admin Users</a>
                            </li>
                        </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <p class="card-text">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>
                                            Company Info: 
                                        </label>
                                        <input type="text" class="form-control company_info" value="{{ $organization[0]->company_info }}" name="company_info">
                                    </div>
                                    <div class="col-md-12 py-20">
                                        <label>
                                            Company Contact: 
                                        </label>
                                        <input type="text" class="form-control company_contact" value="{{ $organization[0]->company_contact }}" name="company_contact">
                                    </div>
                                    <div class="col-md-12 py-20">
                                        <label>
                                            Company Address: 
                                        </label>
                                        <input type="text" class="form-control company_address" value="{{ $organization[0]->company_address }}" name="company_address">
                                    </div>
                                    <div class="col-md-12 py-20">
                                        <label>
                                            Company Phone: 
                                        </label>
                                        <input type="text" class="form-control company_phone" value="{{ $organization[0]->company_phone }}" name="company_phone">
                                    </div>
                                    <div class="col-md-12 py-20">
                                        <label>
                                            Company Email: 
                                        </label>
                                        <input type="text" class="form-control company_email" value="{{ $organization[0]->company_email }}" name="company_email">
                                    </div>
                                    <div class="col-md-12 py-20">
                                        <button type="button" class="btn btn-primary changeOrganizationInfo">SAVE CHANGES</button>
                                    </div>
                                </div>
                            </form>
                            </p>
                        </div>

                        <div class="tab-pane fade p-3" id="superAdmin" role="tabpanel" aria-labelledby="superAdmin-tab">
                            <h5 class="card-title">
                                <div class="row">
                                    <div class="col-md-6 mx-auto my-auto">
                                        Super Admin tab:
                                    </div>
                                    <div class="col-md-6" style="text-align: right;">
                                        <button type="button" class="btn btn-primary">ADD SUPER ADMIN</button>
                                    </div>
                                </div>
                            </h5>
                            <p class="card-text">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Phone#</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $key => $user)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $user->name.' '.$user->lastName }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><a href="#">Set</a>/<a href="#">Reset</a></td>
                                            <td>{{ $user->phone }}</td>
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
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#info-tab').click();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.changeOrganizationInfo').on('click', function() {
        var company_info = $('.company_info').val();
        var company_contact = $('.company_contact').val();
        var company_phone = $('.company_phone').val();
        var company_email = $('.company_email').val();
        var company_address = $('.company_address').val();

        $.ajax({
                type:'POST',
                url: "{{ route('update_organization_info') }}",
                data: {
                        company_info:company_info,
                        company_contact:company_contact,
                        company_phone:company_phone,
                        company_email:company_email,
                        company_address:company_address
                    },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                        window.location.reload();
                    }else{
                        toastr.error(data.error);
                    }
                },
                error: function(jqXHR, textStatus, error) { 
                    
                }
            });
    });

    $('.feeSaveChanges').on('click', function () {
            feeQuantityRange = [];

            $('input[name="feeQuantityRange[]"]').each(function() {
                var name = $(this).val();
                item = {}
                item ["fee"] = name;
                feeQuantityRange.push(item);
            });

            var company_id = $('input[name="company_id"]').val();

            $.ajax({
                type:'POST',
                url: "{{ route('update_company_fee') }}",
                data: {
                        company_id:company_id, 
                        feeQuantityRange:JSON.stringify(feeQuantityRange)
                    },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                        window.location.reload();
                    }else{
                        toastr.error(data.error);
                    }
                },
                error: function(jqXHR, textStatus, error) { 
                    
                }
            });
    });
});
</script>
@endsection
