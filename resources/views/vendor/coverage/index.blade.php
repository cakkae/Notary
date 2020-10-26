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
                                    <option value="" disabled>Select state</option>
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
                                <div class="button-group">
                                    <button type="button" class="btn btn-lg btn-primary btn-update">UPDATE COVERAGE</button>
                                    <button type="button" class="btn btn-lg btn-primary btn-selectAll" disabled>SELECT ALL</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- <input type="text" class="form-control selected_zip"> -->

                    <div class="tag-container" id="tag-container">
                        <br>
                        <h5>Coverage list:</h5>
                        @isset(Auth::user()->coverage)
                            @forelse(json_decode(Auth::user()->coverage, true) as $value)
                                <span class="dashfolio-tag" name="coverageArea[]">{{ $value["name"] }}</span>
                            @empty
                                There is no selected coverage
                            @endforelse
                        @endisset
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){

        var selectedCode = [];

        $(".dashfolio-tag").each(function(){
            var name = $(this).text();
            item = {}
            item ["name"] = name;
            selectedCode.push(item);
        });

        $('.tag-container').on('click', 'span', function() {
            if(confirm("Remove "+ $(this).text() +"?")) {
                $(this).remove(); 
                $.ajax({
                    url: "{{ route('updateCoverage') }}",
                    type:'POST',
                    data: {
                        _token:_token, 
                        user_id:user_id, 
                        selectedCode:JSON.stringify(selectedCode)
                    },
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            toastr.success(data.success);
                        }else{
                            toastr.error(data.error);
                        }
                    }
                });
            }
        });

        $(document).on('click','.zipcode_key',function(){
            var notExist = $(this).is(':checked');
            if(notExist) {
                // selectedCode.push($(this).val());
                var name = $(this).val();
                item = {}
                item ["name"] = name;
                console.log(selectedCode);
                selectedCode.push(item);
                $("<span/>", {text:$(this).val(), appendTo:"#tag-container", class:"dashfolio-tag", name:"coverageArea[]"});
            }
            else {
                var name = $(this).val();
                item = {};
                item["name"] = name
                selectedCode.splice($.inArray(item, selectedCode), 1);
                toastr.success('Postal code '+$(this).val()+ ' successfully deleted');
            }
        });

        $('.btn-selectAll').on('click', function() {
            $(".zipcode_key").each(function(){
                $(this).prop("checked",true);
                if($(this).is(':checked')) {
                    // selectedCode.push($(this).val());
                    var name = $(this).val();
                    item = {}
                    item ["name"] = name;
                    selectedCode.push(item);
                    $("<span/>", {text:$(this).val(), appendTo:"#tag-container", class:"dashfolio-tag"});
                } else {
                    selectedCode.splice($.inArray($(this).val(), selectedCode), 1);
                }
            });

        });

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
                            $("#country").append('<option disabled>Select Country</option>');
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
                            $('.btn-selectAll').prop("disabled", false);
                            // $.each(response, function(key, value) {
                            //     $("#zipcode").append(value['zipcode']);
                            // });
                            $.each(response, function (key, value) {
                                var li = $('<li name="zipcode_tag[]" class="zipcode_tag"><input type="checkbox" class="zipcode_key" name="zipcode_key[]" id="' + key + '" value="' + value['zipcode'] + '"/>' +
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
            
            var user_id = $("input[name='user_id']").val();
            var coverage = $("span[name='coverage[]']").text();
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('updateCoverage') }}",
                type:'POST',
                data: {
                    _token:_token, 
                    user_id:user_id, 
                    selectedCode:JSON.stringify(selectedCode)
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
    .tag-container {
        max-width: 100%;
    }

    .dashfolio-tag {
    cursor:pointer;
    background-color: #3490dc;
    padding: 5px 10px 5px 10px;
    display: inline-block;
    margin-top: 3px; /*incase tags go in next line, will space */
    color:#fff;
    margin-right: 4px;
    font-size: 18px;
    padding-right: 20px; /* adds space inside the tags for the 'x' button */
    }

    .dashfolio-tag:hover{
    opacity:0.7;
    }

    .dashfolio-tag:after { 
    position:absolute;
    content:"×";
    /* padding:2px 2px; */
    margin-left:2px;
    font-size:18px;
    }

    #add-tag-input {
    background:#eee;
    border:0;
    margin:6px 6px 6px 0px ; /* t r b l */
    padding:5px;
    width:auto;
    }      
</style>
@endsection
