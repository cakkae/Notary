@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2> Details for {{ $company->company_name }} </h2></div>

                <div class="card-body">
                    <div class="card-header tab-card-header" style="background-color: transparent; border-bottom: 0px;">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="accountInfo-tab" data-toggle="tab" href="#accountInfo" role="tab" aria-controls="accountInfo" aria-selected="false">Account Info</a>
                            </li>
                            <li class="nav-item" style="margin-left: 30px;">
                                <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
                            </li>
                            <li class="nav-item" style="margin-left: 30px;">
                                <a class="nav-link" id="fees-tab" data-toggle="tab" href="#fees" role="tab" aria-controls="fees" aria-selected="false">Fees</a>
                            </li>
                        </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="accountInfo" role="tabpanel" aria-labelledby="accountInfo-tab">
                            <h5 class="card-title">Account info tab:</h5>
                            <p class="card-text">
                            <form>
                                @csrf
                                    <input type="hidden" value="{{ $company->id }}" name="company_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            Company name:
                                        </label>
                                        <input type="text" class="form-control company_name" value="{{ $company->company_name }}" name="company_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            Contact name:
                                        </label>
                                        <input type="text" class="form-control contact_name" value="{{ $company->contact_name }}" name="contact_name">
                                    </div>
                                    <div class="col-md-6 py-20">
                                        <label>
                                            Contact number:
                                        </label>
                                        <input type="text" class="form-control contact_number" value="{{ $company->contact_number }}" name="contact_number">
                                    </div>
                                    <div class="col-md-6 py-20">
                                        <label>
                                            Email:
                                        </label>
                                        <input type="text" class="form-control email" value="{{ $company->email }}" name="email">
                                    </div>
                                    <div class="col-md-6 py-20">
                                        <label>
                                            Address:
                                        </label>
                                        <input type="text" class="form-control company_address" value="{{ $company->company_address }}" name="company_address">
                                    </div>  
                                    <div class="col-md-6 py-20">
                                        <label>
                                            City:
                                        </label>
                                        <input type="text" class="form-control company_city" value="{{ $company->company_city }}" name="company_city">
                                    </div>
                                    <div class="col-md-6 py-20">
                                        <label>
                                            State:
                                        </label>
                                        <input type="text" class="form-control company_state" value="{{ $company->company_state }}" name="company_state">
                                    </div>
                                    <div class="col-md-6 py-20">
                                        <label>
                                            ZIP:
                                        </label>
                                        <input type="text" class="form-control company_zip" value="{{ $company->company_zip }}" name="company_zip">
                                    </div>
                                    <div class="col-md-12 py-20">
                                        <button type="button" class="btn btn-primary btn-lg accountSaveChanges">SAVE CHANGES</button>
                                    </div>
                                </div>
                                </form>
                            </p>
                        </div>
                        <div class="tab-pane fade p-3" id="users" role="tabpanel" aria-labelledby="users-tab">
                        <h5 class="card-title">
                                <div class="row">
                                    <div class="col-md-9 mx-auto my-auto">
                                        Users tab:
                                    </div>
                                    <div class="col-md-3" style="text-align: right;">
                                        <button type="button" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#addUserModal">ADD USER</button>
                                    </div>
                                </div>
                            </h5>
                            <p class="card-text">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Users</th>
                                        <th>UserName</th>
                                        <th>Password</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $key => $user)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $user->name.' '.$user->surname }}</td>
                                            <td>{{ $user->email }}</td>   
                                            <td>{{ $user->roles->first()['name'] }}</td>
                                            <td><a href="#">Set</a>/<a href="#">Reset</a></td>
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
                                            <td colspan="6">{{ $users->render() }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </p>
                        </div>
                        <div class="tab-pane fade p-3" id="fees" role="tabpanel" aria-labelledby="fees-tab">
                            <h3 class="card-title">Fees: Per order placed</h3>
                            <p class="card-text">
                                <form>
                                @csrf
                                <?php $arr = json_decode($company->feeQuantityRange); ?>
                                    <input type="hidden" value="{{ $company->id }}" name="company_id">
                                    <table class="table">
                                        <thead>
                                            <th>Quantity Range:</th>
                                            <th>Fee:</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><h4>1 - 100</h4></td>
                                                <td><input type="decimal" class="form-control" name="feeQuantityRange[]" value="{{ $arr[0]->fee }}"></td>
                                            </tr>
                                                <td><h4>101 - 200</h4></td>
                                                <td><input type="decimal" class="form-control" name="feeQuantityRange[]" value="{{ $arr[1]->fee }}"></td>
                                            </tr>
                                                <td><h4>201 - 300</h4></td>
                                                <td><input type="decimal" class="form-control" name="feeQuantityRange[]" value="{{ $arr[2]->fee }}"></td>
                                            </tr>
                                                <td><h4>301 - 400</h4></td>
                                                <td><input type="decimal" class="form-control" name="feeQuantityRange[]" value="{{ $arr[3]->fee }}"></td>
                                            </tr>
                                                <td><h4>501 - 1000</h4></td>
                                                <td><input type="decimal" class="form-control" name="feeQuantityRange[]" value="{{ $arr[4]->fee }}"></td>
                                            </tr>
                                                <td><h4>1001 - 3000</h4></td>
                                                <td><input type="decimal" class="form-control" name="feeQuantityRange[]" value="{{ $arr[5]->fee }}"></td>
                                            </tr>
                                                <td><h4>3001+</h4></td>
                                                <td><input type="decimal" class="form-control" name="feeQuantityRange[]" value="{{ $arr[6]->fee }}"></td>
                                            </tr>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-primary btn-lg feeSaveChanges">SAVE CHANGES</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </tbody>
                                    </table>    
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body userForm">
        <div class="row">
            <div class="col-md-6">
                <label>
                    Name:
                </label>
                <input type="text" class="form-control name" name="username_name" placeholder="Enter name...">
            </div>
            <div class="col-md-6">
                <label>
                    Surname:
                </label>
                <input type="text" class="form-control lastName" name="lastName" placeholder="Enter surname...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Password:
                </label>
                <input type="password" class="form-control password" name="password" placeholder="Enter password...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Email:
                </label>
                <input type="email" class="form-control email" name="email" placeholder="Enter email...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Middlename:
                </label>
                <input type="text" class="form-control middlename" name="middlename" placeholder="Enter middlename...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Phone:
                </label>
                <input type="text" class="form-control phone" name="phone" placeholder="Enter phone number...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Permision:
                </label>
                <select class="form-control permision" name="permision">
                    <option value="1">User</option>
                    <option value="2">Vendor</option>
                    <option value="3">Admin</option>
                </select>
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Company:
                </label>
                <input type="text" class="form-control" value="{{ \App\Models\Company::find(1)->company_name }}" disabled>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">CLOSE</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block createNewUser">CREATE</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function($){
    // $('#accountInfo-tab').click();

    $('.contact_number').mask('123-123-1234');

    // $('#users-tab').click();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.createNewUser').on('click', function() {
        var name = $('.userForm .name').val();
        var lastName = $('.userForm .lastName').val();
        var middleName = $('.userForm .middleName').val();
        var phone = $('.userForm .phone').val();
        var password = $('.userForm .password').val();
        var email = $('.userForm .email').val();
        var role_id = $( ".userForm .permision option:selected" ).val();
        var company_id = $('input[name="company_id"]').val();

        $.ajax({
                type:'POST',
                url: "{{ route('create_user') }}",
                data: {
                        name:name, 
                        lastName:lastName,
                        middleName:middleName,
                        phone:phone,
                        password:password,
                        email:email,
                        role_id:role_id,
                        company_id:company_id
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

    $('.accountSaveChanges').on('click', function() {
        var company_name = $('.company_name').val();
        var contact_name = $('.contact_name').val();
        var contact_name = $('.contact_name').val();
        var email = $('.email').val();
        var company_address = $('.company_address').val();
        var company_city = $('.company_city').val();
        var company_zip = $('.company_zip').val();
        var company_state = $('.company_state').val();
        var contact_number = $('.contact_number').val();

        var company_id = $('input[name="company_id"]').val();

        $.ajax({
                type:'POST',
                url: "{{ route('update_company_account') }}",
                data: {
                        company_id:company_id, 
                        company_name:company_name,
                        contact_name:contact_name,
                        email:email,
                        contact_number:contact_number,
                        company_address:company_address,
                        company_state:company_state,
                        company_zip:company_zip,
                        company_city:company_city
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
