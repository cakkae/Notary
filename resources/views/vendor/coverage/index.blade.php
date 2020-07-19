@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Coverage</div>
                <div class="card-body">
                    <form>
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->id }}">
                        <div class="row">
                            <div class="col-md-12 py-20">
                                <label>State:</label>
                                <select class="form-control" name="state" id="state">
                                    <option value="">Select state</option>
                                        @foreach($states as $state) 
                                            <option value="{{ $state->state_id }}">{{ $state->state }}  </option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 py-20">
                                <label>County:</label>
                                <select class="form-control" name="country" id="country">
                                </select>
                            </div>
                            <div class="col-md-12 py-20 zipcode_container">
                                <ul id="zipcode" class="zipcode" name="zipcode[]"></ul>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-lg btn-primary btn-update">Update coverage</button>
                            </div>
                        </div>
                    </form>
                    <input type="text" class="form-control selected_zip">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $("#state").change(function() {
            var state_id = $(this).val();
            if(state_id){
                $.ajax({
                    type: "get",
                    url: "{{ url('/getCountry') }}/"+state_id,
                    success: function(response)
                    {
                        if(response) {
                            $("#country").empty();
                            $("#country").append('<option>Select Country</option>');
                            $.each(response, function(key, value) {
                                $("#country").append('<option value="'+key+'">'+value['country']+'</option>');
                            });
                        }
                    }
                });
            }
        })

        $("#country").change(function() {
            var country_name = $( "#country option:selected" ).text();
            if(country_name){
                $.ajax({
                    type: "get",
                    url: "{{ url('/getZipCode') }}/"+country_name,
                    success: function(response)
                    {
                        if(response) {
                            $("#zipcode").empty();
                            // $.each(response, function(key, value) {
                            //     $("#zipcode").append(value['zipcode']);
                            // });
                            $.each(response, function (key, value) {
                                var li = $('<li name="zipcode_tag[]" class="zipcode_tag"><input type="checkbox" name="zipcode_key[]" id="' + key + '" value="' + value['zipcode'] + '"/>' +
                                        '<label for="' + key + '" name="zipcode_value[]"></label></li>');
                                li.find('label').text(value['zipcode']);
                                $('#zipcode').append(li);
                            });
                        }
                    }
                });
            }
        })

        $('.btn-update').on('click', function(){
            $('input[name="zipcode_key[]"]').each(function() {
                if($(this).val() != '') 
                {
                    var current_value = $(this).val();
                    all_selected_value = [];
                    all_selected_value.push(current_value);
                    $('.selected_zip').val(all_selected_value);
                }
            });
            
            /*if ($this.is(':checked')) {
                $(this).parent().remove();
            }*/
        })

        // $(".btn-update").click(function(e){
        //     e.preventDefault();
       
        //     var _token = $("input[name='_token']").val();
        //     var user_id = $("input[name='user_id']").val();
        //     var from_email = $(".from_email").val();
            
        //     zipcode = [];

            
        //     /*$('li[name="zipcode_tag[]"]').each(function() {
        //         // if() 
        //         // {
        //             var zipcode_tag = $(this).children().val();
        //             alert(zipcode_tag);
        //             // alert($(this).attr('for'))
        //             var name = $(this).text();
        //             item = {}
        //             item ["name"] = name;
        //             zipcode.push(item);
        //             console.log(zipcode);
        //         // }
        //     });*/

        //     // zipcode:JSON.stringify(zipcode),
        //     //alert(JSON.stringify(zipcode))

        //     // $.ajax({
        //     //     url: "{{ route('updateCoverage') }}",
        //     //     type:'POST',
        //     //     data: {
        //     //         _token:_token, 
        //     //         user_id:user_id, 
        //     //         email:from_email
        //     //     },
        //     //     success: function(data) {
        //     //         if($.isEmptyObject(data.error)){
        //     //             toastr.success(data.success);
        //     //         }else{
        //     //             toastr.error(data.error);
        //     //         }
        //     //     }
        //     // });

       
        // }); 

    })
</script>
<style>
    .py-20 {
        margin-top: 20px;
    }
    #zipcode {
        list-style-type: none;
        padding: 0;
    }
    .zipcode_tag {
        display: inline-block;
        padding: 5px;
        font-size: 18px;
    }
    label {
        padding: 5px;
    }
</style>
@endsection
