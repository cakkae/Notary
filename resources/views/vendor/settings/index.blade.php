@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Account Settings</div>

                <div class="card-body">

                    <form>
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->id }}">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">First name</label>
                                <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="middleName">Middle name</label>
                                <input id="middleName" name="middleName" type="text" class="form-control" value="{{ $user->middleName }}">
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                    <label for="lastName">Last name</label>
                                    <input id="lastName" name="lastName" type="text" class="form-control" value="{{ $user->lastName }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="companyName">Company name</label>
                                <input id="companyName" name="companyName" type="text" class="form-control" value="{{ $user->companyName }}">
                            </div>
                        </div>
                    </div>                        

                        <label for="taxId">Tax ID or SS#</label>
                        <input id="taxId"  name="taxId" type="text" class="form-control" value="{{ $user->taxId }}">

                        </br>
                        <label for="paymentAddress">Payment address</label>
                        <input id="paymentAddress"  name="paymentAddress" type="text" class="form-control" value="{{ $user->paymentAddress }}">

                        </br>
                        <label for="city">City</label>
                        <input id="city"  name="city" type="text" class="form-control" value="{{ $user->city }}">

                        </br>
                        <label for="state">State</label>
                        <input id="state"  name="state" type="text" class="form-control" value="{{ $user->state }}">

                        </br>
                        <label for="zipCode">Zip</label>
                        <input id="zipCode"  name="zipCode" type="text" class="form-control" value="{{ $user->zipCode }}">

                        </br>
                        <button class="btn btn-success btn-submit">Update</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('document').ready(function () {
        $(".btn-submit").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var user_id = $("input[name='user_id']").val();
            var name = $("input[name='name']").val();
            var lastName = $("input[name='lastName']").val();
            var middleName = $("input[name='middleName']").val();
            var companyName = $("input[name='companyName']").val();
            var taxId = $("input[name='taxId']").val();
            var paymentAddress = $("input[name='paymentAddress']").val();
            var city = $("input[name='city']").val();
            var state = $("input[name='state']").val();
            var zipCode = $("input[name='zipCode']").val();

            $.ajax({
                url: "{{ route('updateAccountSettings') }}",
                type:'POST',
                data: {_token:_token, user_id:user_id, name:name, companyName:companyName, lastName:lastName, middleName:middleName, taxId: taxId, paymentAddress: paymentAddress, city: city, state: state, zipCode: zipCode},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                    }else{
                        toastr.error(data.error);
                    }
                }
            });
       
        }); 
       
    });
</script>
@endsection
