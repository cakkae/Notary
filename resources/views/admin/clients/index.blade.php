@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('client.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Client</a></div>
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
                        @forelse($clients as $key => $client)
                        <?php $company = \App\Models\Company::where('id',$client->company_id)->first(); ?>
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $client->name.' '.$client->lastName }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $company->company_name }}</td>
                            <td>
                                <a href="javascript::void()"
                                    class="changeClientPassword"
                                    data-client_id = "{{ $client->id }}">
                                    Set
                                </a>
                            </td>
                            <td>{{ $client->phone }}</td>
                            <td>
                                <a href="javascript::void()" 
                                    class="editClientButton"
                                    data-client_id="{{ $client->id }}"
                                    data-name="{{ $client->name }}"
                                    data-lastName="{{ $client->lastName }}"
                                    data-email="{{ $client->email }}"
                                    data-phone="{{ $client->phone }}"
                                    >
                                    Edit
                                </a>/
                                <a href="{{ route('deleteClient', $client->id) }}">Remove</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body clientForm">
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
                    Surname:
                </label>
                <input type="text" class="form-control edit_lastName" placeholder="Enter surname...">
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

        $('.editClientButton').on('click', function () {
            
            var name = $(this).data('name');
            var lastName = $(this).data('lastName');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var client_id = $(this).data('client_id');

            $('.editClientModal .clientForm .edit_name').val(name);
            $('.editClientModal .clientForm .edit_lastName').val(lastName);
            $('.editClientModal .clientForm .edit_email').val(email);
            $('.editClientModal .clientForm .edit_phone').val(phone);
            $('.editClientModal .clientForm .client_id').val(client_id);

            jQuery('.editClientModal').modal("show");
        });
        
        $('.changeClientPassword').on('click', function () {
            var client_id = $(this).data('client_id');
            $('.changeClientPasswordModal .clientForm .client_id').val(client_id);
            jQuery('.changeClientPasswordModal').modal("show");
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
    });
</script>
@endsection
