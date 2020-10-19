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
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSuperAdminModal">ADD SUPER ADMIN</button>
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
                                            <td>
                                                <a href="javascript::void()"
                                                    class="changeClientPassword"
                                                    data-client_id = "{{ $user->id }}">
                                                    Set
                                                </a>
                                            </td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <a href="javascript::void()" 
                                                    class="editClientButton"
                                                    data-client_id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-lastName="{{ $user->lastName }}"
                                                    data-email="{{ $user->email }}"
                                                    data-phone="{{ $user->phone }}"
                                                    >
                                                    Edit
                                                </a>/
                                                <a href="{{ route('deleteSuperAdmin', $user->id) }}">Remove</a>
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


<!-- Add Order Modal -->
<div class="modal fade" id="addSuperAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Super Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            {{ csrf_field() }}
            <input type="hidden" value="{{ Auth::user()->id }}" name="created_by">
            <div class="row">
                <div class="col-md-6 py-20">
                    <label for="owner_name">Name:</label>
                    <input type="text" class="form-control owner_name" name="owner_name">
                </div>
                <div class="col-md-6 py-20">
                    <label for="owner_surname">Surname:</label>
                    <input type="text" class="form-control owner_surname" name="owner_surname">
                </div>
                <div class="col-md-6 py-20">
                    <label for="owner_email">Email:</label>
                    <input type="text" class="form-control owner_email" name="owner_email">
                </div>
                <div class="col-md-6 py-20">
                    <label for="owner_password">Password:</label>
                    <input type="password" class="form-control owner_password" name="owner_password">
                </div>
            </div>    
        </div>
      <div class="modal-footer">
        <div class="col-md-4">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Close</button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-lg btn-block addSuperAdmin">Add Super Admin</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- BEGIN: EDIT ROLE MODAL -->
<div class="modal fade changeClientPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit client password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body clientForm">
        <input type="hidden" class="client_id" name="client_id">
        <div class="row">
            <div class="col-md-12 py-20">
                <label>
                    Password:
                </label>
                <input type="password" name="client_password" class="form-control client_password">
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

<!-- BEGIN: EDIT USER MODAL -->
<div class="modal fade editClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Super Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body superAdminForm">
        <input type="hidden" class="client_id" name="client_id">
        <div class="row">
            <div class="col-md-6">
                <label>
                    Name:
                </label>
                <input type="text" class="form-control edit_name" placeholder="Enter name...">
            </div>
            <div class="col-md-6">
                <label>
                    Lastname:
                </label>
                <input type="text" class="form-control edit_lastName" placeholder="Enter lastname...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Email:
                </label>
                <input type="email" class="form-control edit_email" placeholder="Enter email...">
            </div>
            <div class="col-md-6 py-20">
                <label>
                    Phone:
                </label>
                <input type="text" class="form-control edit_phone" placeholder="Enter phone number...">
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

<script type="text/javascript">
$(document).ready(function(){
    $('#info-tab').click();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.editClientButton').on('click', function () {
            
        var name = $(this).data('name');
        var lastName = $(this).data('lastname');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        var client_id = $(this).data('client_id');

        $('.editClientModal .superAdminForm .edit_name').val(name);
        $('.editClientModal .superAdminForm .edit_lastName').val(lastName);
        $('.editClientModal .superAdminForm .edit_email').val(email);
        $('.editClientModal .superAdminForm .edit_phone').val(phone);
        $('.editClientModal .superAdminForm .client_id').val(client_id);

        jQuery('.editClientModal').modal("show");
    });

    $('.changeClientPassword').on('click', function () {
        var client_id = $(this).data('client_id');
        $('.changeClientPasswordModal .clientForm .client_id').val(client_id);
        jQuery('.changeClientPasswordModal').modal("show");
    });

    $('.updateCurrentUser').on('click', function () {
        var client_id = $('.superAdminForm .client_id').val();
        var name = $( ".superAdminForm .edit_name" ).val();
        var lastName = $( ".superAdminForm .edit_lastName" ).val();
        var email = $( ".superAdminForm .edit_email" ).val();
        var phone = $( ".superAdminForm .edit_phone" ).val();

        $.ajax({
            type:'POST',
            url: "{{ route('update_superadmin_password') }}",
            data: {
                    client_id:client_id,
                    name:name,
                    lastName:lastName,
                    email:email,
                    phone:phone
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

    $('.updateRoleUser').on('click', function () {
        var client_id = $('.clientForm .client_id').val();
        var password = $( ".clientForm .client_password" ).val();

        $.ajax({
            type:'POST',
            url: "{{ route('update_client_password') }}",
            data: {
                    password:password,
                    client_id:client_id
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

    $('.addSuperAdmin').on('click', function() {
        var name = $('.owner_name').val();
        var surname = $('.owner_surname').val();
        var email = $('.owner_email').val();
        var password = $('.owner_password').val();

        $.ajax({
            type:'POST',
            url: "{{ route('add_super_admin') }}",
            data: {
                name: name,
                surname: surname,
                email: email,
                password: password
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
