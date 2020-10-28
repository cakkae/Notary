@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('user.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> List all users</a></div>

                <div class="card-body">
                    <form>
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="created_by">
                        <div class="row">
                            <div class="col-md-6 py-20">
                                <label for="client_name">Name:</label>
                                <input type="text" class="form-control user_name" name="user_name">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="user_surname">Last name:</label>
                                <input type="text" class="form-control user_surname" name="user_surname">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="user_company_id">Company:</label>
                                <select class="form-control user_company_id" name="user_company_id" disabled>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" <?php if(Auth::user()->company_id == $company->id) echo "selected"; ?>>{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="user_email">Email:</label>
                                <input type="text" class="form-control user_email" name="user_email">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="user_phone">Phone:</label>
                                <input type="text" class="form-control user_phone" name="user_phone">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="user_password">Password:</label>
                                <input type="password" class="form-control user_password" name="user_password">
                            </div>
                            <div class="col-md-12 py-20">
                                <button type="button" class="btn btn-primary addNewUser">ADD USER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function ($){

    $('.addNewUser').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var name = $('.user_name').val();
        var lastName = $('.user_surname').val();
        var email = $('.user_email').val();
        var phone = $('.user_phone').val();
        var password = $('.user_password').val();
        var company_id = $( ".user_company_id option:selected" ).val();


        $.ajax({
            type:'POST',
            url: "{{ route('user.store') }}",
            data: {
                name:name, 
                lastName:lastName,
                email:email,
                phone:phone,
                password:password,
                company_id:company_id
            },
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    toastr.success(data.success);
                    window.location.href = "{{ route('user.index') }}";
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
