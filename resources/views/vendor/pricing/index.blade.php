@extends('layouts.app')

@section('content')
<div class="container-fluid">
<form id="updatePricing">
    {{ csrf_field() }}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                    <div class="row">
                        <div class="col-md-9">
                            <h3>Pricing And Availability</h3>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block btn-primary btn-submit">Save</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Deeds</label>
                                <input type="number" name="deeds" class="form-control" value="{{ $pricing->deeds ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label>Trust</label>
                                <input type="number" name="trust" class="form-control" value="{{ $pricing->trust ?? '' }}">
                            </div>
                        </div>
                        <div class="row py-20">
                            <div class="col-md-6">
                                <label>Refinance</label>
                                <input type="number" name="refinance" class="form-control" value="{{ $pricing->refinance ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label>Purchase</label>
                                <input type="number" name="purchase" class="form-control" value="{{ $pricing->purchase ?? '' }}">
                            </div>
                        </div>
                        <div class="row py-20">
                            <div class="col-md-6">
                                <label>Reverse</label>
                                <input type="number" name="reverse" class="form-control" value="{{ $pricing->reverse ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label>SBA</label>
                                <input type="number" name="sba" class="form-control" value="{{ $pricing->sba ?? '' }}">
                            </div>
                        </div>
                        <div class="row py-20">
                            <div class="col-md-6">
                                <label>Commercial</label>
                                <input type="number" name="commercial" class="form-control" value="{{ $pricing->commercial ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label>Split Closing</label>
                                <input type="number" name="split_closing" class="form-control" value="{{ $pricing->split_closing ?? '' }}">
                            </div>
                        </div>
                        <div class="row py-20">
                            <div class="col-md-6">
                                <label>Applications</label>
                                <input type="number" name="applications" class="form-control" value="{{ $pricing->applications ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label>Walk-in Recordings</label>
                                <input type="number" name="walk_in_recordings" class="form-control" value="{{ $pricing->walk_in_recordings ?? '' }}">
                            </div>
                        </div>
                        <div class="row py-20">
                            <div class="col-md-12 py-20">
                                <h3>Availability Days</h3>
                                <div class="row py-20">
                                    <div class="col-md-2">
                                        <label>Monday</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="monday_from" value="{{ $pricing->monday_from ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="monday_to" value="{{ $pricing->monday_to ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Tuesday</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="tuesday_from" value="{{ $pricing->tuesday_from ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="tuesday_to" value="{{ $pricing->tuesday_to ?? '' }}">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-2">
                                        <label>Wednesday</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="wednesday_from" value="{{ $pricing->wednesday_from ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="wednesday_to" value="{{ $pricing->wednesday_to ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Thursday</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="thursday_from" value="{{ $pricing->thursday_from ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="thursday_to" value="{{ $pricing->thursday_to ?? '' }}">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-2">
                                        <label>Friday</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="friday_from" value="{{ $pricing->friday_from ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="friday_to" value="{{ $pricing->friday_to ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Saturday</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="saturday_from" value="{{ $pricing->saturday_from ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="saturday_to" value="{{ $pricing->saturday_to ?? '' }}">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-2">
                                        <label>Sunday</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="sunday_from" value="{{ $pricing->sunday_from ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" class="form-control" name="sunday_to" value="{{ $pricing->sunday_to ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<style>
.py-20 {
    margin-top: 15px;
}
</style>
<script type="text/javascript">
    $('document').ready(function () {
        $(".btn-submit").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var user_id = $("input[name='user_id']").val();
            var deeds = $("input[name='deeds']").val();
            var trust = $("input[name='trust']").val();
            var refinance = $("input[name='refinance']").val();
            var purchase = $("input[name='purchase']").val();
            var reverse = $("input[name='reverse']").val();
            var sba = $("input[name='sba']").val();
            var commercial = $("input[name='commercial']").val();
            var split_closing = $("input[name='split_closing']").val();
            var applications = $("input[name='applications']").val();
            var walk_in_recordings = $("input[name='walk_in_recordings']").val();
            
            var monday_from = $("input[name='monday_from']").val();
            var monday_to = $("input[name='monday_to']").val();

            var tuesday_from = $("input[name='tuesday_from']").val();
            var tuesday_to = $("input[name='tuesday_to']").val();
            
            var wednesday_from = $("input[name='wednesday_from']").val();
            var wednesday_to = $("input[name='wednesday_to']").val();

            var thursday_from = $("input[name='thursday_from']").val();
            var thursday_to = $("input[name='thursday_to']").val();

            var friday_from = $("input[name='friday_from']").val();
            var friday_to = $("input[name='friday_to']").val();

            var saturday_from = $("input[name='saturday_from']").val();
            var saturday_to = $("input[name='saturday_to']").val();

            var sunday_from = $("input[name='sunday_from']").val();
            var sunday_to = $("input[name='sunday_to']").val();
       
            $.ajax({
                url: "{{ route('updatePricing') }}",
                type:'POST',
                data: { 
                        _token:_token, 
                        user_id:user_id, 
                        deeds:deeds, 
                        trust:trust,
                        refinance:refinance, 
                        purchase:purchase, 
                        reverse:reverse, 
                        sba: sba, 
                        commercial: commercial,
                        split_closing:split_closing,
                        applications:applications,
                        walk_in_recordings:walk_in_recordings,
                        monday_from:monday_from,
                        tuesday_from:tuesday_from,
                        wednesday_from:wednesday_from,
                        thursday_from:thursday_from,
                        friday_from:friday_from,
                        saturday_from:saturday_from,
                        sunday_from:sunday_from,
                        monday_to:monday_to,
                        tuesday_to:tuesday_to,
                        wednesday_to:wednesday_to,
                        thursday_to:thursday_to,
                        friday_to:friday_to,
                        saturday_to:saturday_to,
                        sunday_to:sunday_to
                    },
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
