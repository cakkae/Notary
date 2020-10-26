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
                                    <div class="col-md-6 py-20">
                                        <label>
                                            Company name:
                                        </label>
                                        <input type="text" class="form-control company_name" value="{{ $company->company_name }}" name="company_name">
                                    </div>
                                    <div class="col-md-6 py-20">
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
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $key => $user)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $user->name.' '.$user->lastName }}</td>
                                            <td>{{ $user->email }}</td>   
                                            <td>{{ $user->roles->first()['name'] }}</td>
                                            <td>
                                                <a href="javascript::void()"
                                                    class="editRoleButton"
                                                    data-user_id = "{{ $user->id }}">
                                                    Set
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript::void()" 
                                                    class="editUserButton"
                                                    data-user_id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-lastname="{{ $user->lastName }}"
                                                    data-email="{{ $user->email }}"
                                                    data-middlename="{{ $user->middleName }}"
                                                    data-phone="{{ $user->phone }}"
                                                    data-permission="{{ $user->roles->first()['pivot']['role_id'] }}"
                                                    >
                                                    Edit
                                                </a>/
                                                <a href="{{ route('deleteUser', $user->id) }}">Remove</a>
                                                /
                                                <a href="javascript::void()"
                                                    class="changePasswordButton"
                                                    data-user_id = "{{ $user->id }}">
                                                    Change password
                                                </a>
                                            </td>
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

<!-- BEGIN: EDIT ROLE MODAL -->
<div class="modal fade editRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body userForm">
        <input type="hidden" class="user_id" name="user_id">
        <div class="row">
            <div class="col-md-12 py-20">
                <label>
                    Permision:
                </label>
                <select class="form-control edit_permission" name="permision">
                    <option value="1">User</option>
                    <option value="2">Vendor</option>
                    <option value="3">Admin</option>
                    <option value="5">Client</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">CLOSE</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block updateRoleUser">UPDATE</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END: EDIT ROLE MODAL -->

<!-- BEGIN: CHANGE PASSWORD MODAL -->
<div class="modal fade changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body userForm">
        <input type="hidden" class="edit_user_id" name="user_id">
        <div class="row">
            <div class="col-md-12">
                <label>
                    Password:
                </label>
                <input type="password" class="form-control password" name="password" placeholder="Enter password...">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">CLOSE</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block updatePassword">UPDATE</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END: EDIT USER MODAL -->

<!-- BEGIN: EDIT USER MODAL -->
<div class="modal fade editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body userForm">
        <input type="hidden" class="edit_user_id" name="user_id">
        <div class="row">
            <div class="col-md-6">
                <label>
                    Name:
                </label>
                <input type="text" class="form-control edit_name" name="username_name" placeholder="Enter name...">
            </div>
            <div class="col-md-6">
                <label>
                    Lastname:
                </label>
                <input type="text" class="form-control edit_lastName" name="lastName" placeholder="Enter lastname...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Email:
                </label>
                <input type="email" class="form-control edit_email" name="email" placeholder="Enter email..." readonly>
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Middlename:
                </label>
                <input type="text" class="form-control edit_middlename" name="middlename" placeholder="Enter middlename...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Phone:
                </label>
                <input type="text" class="form-control edit_phone" name="phone" placeholder="Enter phone number...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Permision:
                </label>
                <select class="form-control edit_permission" name="permision">
                    <option value="1">User</option>
                    <option value="2">Vendor</option>
                    <option value="3">Admin</option>
                    <option value="5">Client</option>
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
            <button type="button" class="btn btn-primary btn-lg btn-block updateCurrentUser">UPDATE</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END: EDIT USER MODAL -->

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
                    Lastname:
                </label>
                <input type="text" class="form-control lastName" name="lastName" placeholder="Enter lastname...">
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
                    <option value="5">Client</option>
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

    $('.changePasswordButton').on('click', function () {
        var user_id = $(this).data('user_id');
        $('.changePasswordModal .userForm .edit_user_id').val(user_id);
        jQuery('.changePasswordModal').modal("show");

    });

    $('.editUserButton').on('click', function () {
        
        var name = $(this).data('name');
        var lastname = $(this).data('lastname');
        var email = $(this).data('email');
        var middlename = $(this).data('middlename');
        var phone = $(this).data('phone');
        var permission = $(this).data('permission');
        var user_id = $(this).data('user_id');

        $('.editUserModal .userForm .edit_name').val(name);
        $('.editUserModal .userForm .edit_lastName').val(lastname);
        $('.editUserModal .userForm .edit_email').val(email);
        $('.editUserModal .userForm .edit_middlename').val(middlename);
        $('.editUserModal .userForm .edit_phone').val(phone);
        $('.editUserModal .userForm .edit_permission').val(permission);
        $('.editUserModal .userForm .edit_user_id').val(user_id);

        jQuery('.editUserModal').modal("show");
    });

    $('.editRoleButton').on('click', function () {
        
        var user_id = $(this).data('user_id');

        $('.editRoleModal .userForm .user_id').val(user_id);

        jQuery('.editRoleModal').modal("show");
    });
    
    $('.updateRoleUser').on('click', function () {
        var user_id = $('.userForm .user_id').val();
        var role_id = $('.userForm .edit_permission option:selected').val();

        $.ajax({
                type:'POST',
                url: "{{ route('update_role') }}",
                data: {
                        role_id:role_id,
                        user_id: user_id
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

    $('.updatePassword').on('click', function () {
        var user_id = $('.changePasswordModal .userForm .edit_user_id').val();
        var password = $('.changePasswordModal .userForm .password').val();

        $.ajax({
                type:'POST',
                url: "{{ route('update_password') }}",
                data: {
                        user_id: user_id,
                        password:password
                    },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                        window.location.reload();
                    }else{
                        toastr.error(data.error);
                    }
                },
                error: function(data) { 
                    toastr.error(data);
                }
        });
    })

    $('.updateCurrentUser').on('click', function() {
        var name = $('.userForm .edit_name').val();
        var lastName = $('.userForm .edit_lastName').val();
        var middleName = $('.userForm .edit_middlename').val();
        var phone = $('.userForm .edit_phone').val();
        var email = $('.userForm .edit_email').val();
        var role_id = $( ".userForm .edit_permission option:selected" ).val();
        var company_id = $('input[name="company_id"]').val();
        var user_id = $('.userForm .edit_user_id').val();

        $.ajax({
                type:'POST',
                url: "{{ route('update_user') }}",
                data: {
                        name:name, 
                        lastName:lastName,
                        middleName:middleName,
                        phone:phone,
                        email:email,
                        role_id:role_id,
                        user_id: user_id,
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
