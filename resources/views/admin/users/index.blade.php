@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</a></div>
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
                        @forelse($users as $key => $user)
                        <?php $company = \App\Models\Company::where('id',$user->company_id)->first(); ?>
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $user->name.' '.$user->lastName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $company->company_name }}</td>
                            <td>
                                <a href="javascript::void()"
                                    class="changeUserPassword"
                                    data-user_id = "{{ $user->id }}">
                                    Set
                                </a>
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <a href="javascript::void()" 
                                    class="editUserButton"
                                    data-user_id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-lastname="{{ $user->lastName }}"
                                    data-email="{{ $user->email }}"
                                    data-phone="{{ $user->phone }}"
                                    >
                                    Edit
                                </a>/
                                <a href="{{ route('deleteUser', $user->id) }}">Remove</a>
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN: EDIT ROLE MODAL -->
<div class="modal fade changeUserPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit user password</h5>
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
                    Password:
                </label>
                <input type="password" name="user_password" class="form-control user_password">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">CLOSE</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block updateUserPassword">UPDATE</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END: EDIT ROLE MODAL -->

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
        <input type="hidden" class="user_id" name="user_id">
        <div class="row">
            <div class="col-md-6">
                <label>
                    Name:
                </label>
                <input type="text" class="form-control edit_name" placeholder="Enter name...">
            </div>
            <div class="col-md-6">
                <label>
                    Surname:
                </label>
                <input type="text" class="form-control edit_lastname" placeholder="Enter surname...">
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
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.updateCurrentUser').on('click', function () {
            var name = $('.editUserModal .userForm .edit_name').val();
            var lastName = $('.editUserModal .userForm .edit_lastname').val();
            var email = $('.editUserModal .userForm .edit_email').val();
            var phone = $('.editUserModal .userForm .edit_phone').val();
            var user_id = $('.editUserModal .userForm .user_id').val();

            $.ajax({
                type:'POST',
                url: "{{ route('update_current_user') }}",
                data: {
                        name:name,
                        lastName:lastName,
                        email:email,
                        phone:phone,
                        user_id:user_id
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

        $('.editUserButton').on('click', function () {
            
            var name = $(this).data('name');
            var lastname = $(this).data('lastname');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var user_id = $(this).data('user_id');

            $('.editUserModal .userForm .edit_name').val(name);
            $('.editUserModal .userForm .edit_lastname').val(lastname);
            $('.editUserModal .userForm .edit_email').val(email);
            $('.editUserModal .userForm .edit_phone').val(phone);
            $('.editUserModal .userForm .user_id').val(user_id);

            jQuery('.editUserModal').modal("show");
        });
        
        $('.changeUserPassword').on('click', function () {
            var user_id = $(this).data('user_id');
            $('.changeUserPasswordModal .userForm .user_id').val(user_id);
            jQuery('.changeUserPasswordModal').modal("show");
        });

        $('.updateUserPassword').on('click', function () {
        var user_id = $('.userForm .user_id').val();
        var password = $( ".userForm .user_password" ).val();

        $.ajax({
                type:'POST',
                url: "{{ route('update_user_password') }}",
                data: {
                        password:password,
                        user_id:user_id
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
