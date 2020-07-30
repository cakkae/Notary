@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('shared.vendors') }}" class="btn btn-primary"><i class="fa fa-plus"></i> List all vendors</a></div>

                <div class="card-body">
                    <form>
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" name="created_by">
                        <div class="row">
                            <div class="col-md-6 py-20">
                                <label for="vendor_name">Name:</label>
                                <input type="text" class="form-control vendor_name" name="vendor_name">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="vendor_surname">Surname:</label>
                                <input type="text" class="form-control vendor_surname" name="vendor_surname">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="vendor_company_id">Company:</label>
                                <select class="form-control vendor_company_id" name="vendor_company_id">
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="vendor_email">Email:</label>
                                <input type="text" class="form-control vendor_email" name="vendor_email">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="vendor_phone">Phone:</label>
                                <input type="text" class="form-control vendor_phone" name="vendor_phone">
                            </div>
                            <div class="col-md-6 py-20">
                                <label for="vendor_password">Password:</label>
                                <input type="password" class="form-control vendor_password" name="vendor_password">
                            </div>
                            <div class="col-md-12 py-20">
                                <button type="button" class="btn btn-primary addNewVendor">ADD VENDOR</button>
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

    $('.vendor_phone').mask('123-123-1234');

    $('.addNewVendor').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var name = $('.vendor_name').val();
        var lastName = $('.vendor_surname').val();
        var email = $('.vendor_email').val();
        var phone = $('.vendor_phone').val();
        var password = $('.vendor_password').val();
        var company_id = $( ".vendor_company_id option:selected" ).val();


        $.ajax({
            type:'POST',
            url: "{{ route('vendor.store') }}",
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
                    window.location.href = "{{ url('/shared/vendors') }}";
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
