@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('notary.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> List all notaries</a></div>

                <div class="card-body">
                    <form>
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="created_by">
                        <div class="row">
                            <div class="col-md-6 py-20">
                                <label for="notary_name">Name:</label>
                                <input type="text" class="form-control notary_name" name="notary_name">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="notary_surname">Last name:</label>
                                <input type="text" class="form-control notary_surname" name="notary_surname">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="notary_company_id">Company:</label>
                                <select class="form-control notary_company_id" name="notary_company_id" disabled>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" <?php if(Auth::user()->company_id == $company->id) echo "selected"; ?>>{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="notary_email">Email:</label>
                                <input type="text" class="form-control notary_email" name="notary_email">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="notary_phone">Phone:</label>
                                <input type="text" class="form-control notary_phone" name="notary_phone">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="notary_password">Password:</label>
                                <input type="password" class="form-control notary_password" name="notary_password">
                            </div>
                            <div class="col-md-12 py-20">
                                <button type="button" class="btn btn-primary addNewNotary">ADD NOTARY</button>
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

    $('.notary_phone').mask('123-123-1234');

    $('.addNewNotary').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var name = $('.notary_name').val();
        var lastName = $('.notary_surname').val();
        var email = $('.notary_email').val();
        var phone = $('.notary_phone').val();
        var password = $('.notary_password').val();
        var company_id = $( ".notary_company_id option:selected" ).val();


        $.ajax({
            type:'POST',
            url: "{{ route('notary.store') }}",
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
                    window.location.href = "{{ route('notary.index') }}";
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
