@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('client.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> List all clients</a></div>

                <div class="card-body">
                    <form>
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="created_by">
                        <div class="row">
                            <div class="col-md-6 py-20">
                                <label for="client_name">Name:</label>
                                <input type="text" class="form-control client_name" name="client_name">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="client_surname">Last name:</label>
                                <input type="text" class="form-control client_surname" name="client_surname">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="client_company_id">Company:</label>
                                <select class="form-control client_company_id" name="client_company_id" disabled>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" <?php if(Auth::user()->company_id == $company->id) echo "selected"; ?>>{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="client_email">Email:</label>
                                <input type="text" class="form-control client_email" name="client_email">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="client_phone">Phone:</label>
                                <input type="text" class="form-control client_phone" name="client_phone">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="client_password">Password:</label>
                                <input type="password" class="form-control client_password" name="client_password">
                            </div>
                            <div class="col-md-12 py-20">
                                <button type="button" class="btn btn-primary addNewClient">ADD CLIENT</button>
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

    $('.client_phone').mask('123-123-1234');

    $('.addNewClient').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var name = $('.client_name').val();
        var lastName = $('.client_surname').val();
        var email = $('.client_email').val();
        var phone = $('.client_phone').val();
        var password = $('.client_password').val();
        var company_id = $( ".client_company_id option:selected" ).val();


        $.ajax({
            type:'POST',
            url: "{{ route('client.store') }}",
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
                    window.location.href = "{{ route('client.index') }}";
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
