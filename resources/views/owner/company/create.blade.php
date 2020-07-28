@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('company.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> List all companies</a></div>

                <div class="card-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 py-20">
                                <label>
                                    Company name:
                                </label>
                                <input type="text" class="form-control company_name" name="company_name">
                            </div>
                            <div class="col-md-6 py-20">
                                <label>
                                    Contact name:
                                </label>
                                <input type="text" class="form-control contact_name" name="contact_name">
                            </div>
                            <div class="col-md-6 py-20">
                                <label>
                                    Contact number:
                                </label>
                                <input type="text" class="form-control contact_number" name="contact_number">
                            </div>
                            <div class="col-md-6 py-20">
                                <label>
                                    Email:
                                </label>
                                <input type="text" class="form-control email" name="email">
                            </div>
                            <div class="col-md-6 py-20">
                                <label>
                                    Company address:
                                </label>
                                <input type="text" class="form-control company_address" name="company_address">
                            </div>
                            <div class="col-md-6 py-20">
                                <label>
                                    Company City:
                                </label>
                                <input type="text" class="form-control company_city" name="company_city">
                            </div>
                            <div class="col-md-6 py-20">
                                <label>
                                    Company State:
                                </label>
                                <input type="text" class="form-control company_state" name="company_state">
                            </div>
                            <div class="col-md-6 py-20">
                                <label>
                                    Company ZIP:
                                </label>
                                <input type="text" class="form-control company_zip" name="company_zip">
                            </div>
                            <div class="col-md-12 py-20">
                                <button type="button" class="btn btn-primary createNewCompany">ADD COMPANY</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function (){
    $('.createNewCompany').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var company_name = $('.company_name').val();
        var contact_name = $('.contact_name').val();
        var contact_name = $('.contact_name').val();
        var email = $('.email').val();
        var company_address = $('.company_address').val();
        var company_state = $('.company_state').val();
        var company_city = $('.company_city').val();
        var company_zip = $('.company_zip').val();
        var contact_number = $('.contact_number').val();

        var company_id = $('input[name="company_id"]').val();

        $.ajax({
            type:'POST',
            url: "{{ route('company.store') }}",
            data: {
                    company_id:company_id, 
                    company_name:company_name,
                    contact_name:contact_name,
                    email:email,
                    contact_number:contact_number,
                    company_address:company_address,
                    company_zip:company_zip,
                    company_city:company_city,
                    company_state:company_state
                },
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    toastr.success(data.success);
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
