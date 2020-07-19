@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hardware</div>

                <div class="card-body">

                <form>
                    {{ csrf_field() }}
                    <input type="hidden" name="hardware_1" value="0">
                    <input type="hidden" name="hardware_2" value="0">
                    <input type="hidden" name="hardware_3" value="0">
                    <input type="hidden" name="hardware_4" value="0">
                    <input type="hidden" name="hardware_5" value="0">
                    <input type="hidden" name="hardware_6" value="0">
                    <input type="hidden" name="hardware_7" value="0">
                    <input type="hidden" name="hardware_8" value="0">
                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->id }}">

                    <div class="row py-20">
                        <div class="col-md-4 offset-md-2 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_1) && $hardware->hardware_1 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_1" name="hardware_1" > 
                            <label class="custom-control-label" for="hardware_1">Laser Printer</label>
                        </div>
                        <div class="col-md-4 offset-md-1 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_2) && $hardware->hardware_2 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_2" name="hardware_2" > 
                            <label class="custom-control-label" for="hardware_2">Dual Tray Printer</label>
                        </div>
                    </div>
                    <div class="row py-20">
                        <div class="col-md-4 offset-md-2 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_3) && $hardware->hardware_3 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_3" name="hardware_3" > 
                            <label class="custom-control-label" for="hardware_3">Scanner</label>
                        </div>
                        <div class="col-md-4 offset-md-1 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_4) && $hardware->hardware_4 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_4" name="hardware_4" > 
                            <label class="custom-control-label" for="hardware_4">Mobile Printer</label>
                        </div>
                    </div>
                    <div class="row py-20">
                        <div class="col-md-4 offset-md-2 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_5) && $hardware->hardware_5 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_5" name="hardware_5" > 
                            <label class="custom-control-label" for="hardware_5">Mobile Scanner</label>
                        </div>
                        <div class="col-md-4 offset-md-1 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_6) && $hardware->hardware_6 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_6" name="hardware_6" > 
                            <label class="custom-control-label" for="hardware_6">Wireless Card</label>
                        </div>
                    </div>
                    <div class="row py-20">
                        <div class="col-md-4 offset-md-2 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_7) && $hardware->hardware_7 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_7" name="hardware_7" > 
                            <label class="custom-control-label" for="hardware_7">Laptop</label>
                        </div>
                        <div class="col-md-4 offset-md-1 custom-control custom-checkbox">
                            <input <?php if(isset($hardware->hardware_8) && $hardware->hardware_8 == 1) echo "checked"; else echo ""; ?> type="checkbox" class="custom-control-input" id="hardware_8" name="hardware_8" > 
                            <label class="custom-control-label" for="hardware_8">Finger Printing</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-9">
                            <button class="btn btn-success btn-submit">UPDATE</button>
                        </div>
                    </div>
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
            var hardware_1 = +$("#hardware_1")[0].checked;
            var hardware_2 = +$("#hardware_2")[0].checked;
            var hardware_3 = +$("#hardware_3")[0].checked;
            var hardware_4 = +$("#hardware_4")[0].checked;
            var hardware_5 = +$("#hardware_5")[0].checked;
            var hardware_6 = +$("#hardware_6")[0].checked;
            var hardware_7 = +$("#hardware_7")[0].checked;
            var hardware_8 = +$("#hardware_8")[0].checked;

            $.ajax({
                url: "{{ route('updateHardwareSettings') }}",
                type:'POST',
                data: {_token:_token, user_id:user_id, hardware_1:hardware_1, hardware_2:hardware_2, hardware_3:hardware_3, hardware_4: hardware_4, hardware_5: hardware_5, hardware_6:hardware_6, hardware_7:hardware_7, hardware_8:hardware_8},
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
