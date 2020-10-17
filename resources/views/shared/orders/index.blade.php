@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block order_menu_font" data-toggle="modal" data-target="#addOrderModal"><i class="fal fa-edit"></i> New Order</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block order_menu_font"><i class="fal fa-filter"></i> Filter</button>
                        </div>
                        <div class="col-md-3 offset-md-1">
                            <input type="text" class="form-control order_menu_font" name="search_order" id="search_order">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block order_menu_font"><i class="fal fa-search"></i> Search</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary order_menu_font btn-block"><i class="fad fa-filter"></i> Advanced</button>
                        </div>
                    </div>
                </div>

                <div class="card-body ">
                    <table class="table table-responsive" style="display: table;">
                        <tr>
                            <th>Edit</th>
                            <th>Loan #</th>
                            <th>File #</th>
                            <th>Closing Date</th>
                            <th>Borrower Name</th>
                            <th>Closing Address</th>
                            <th>City</th>
                            <th>Zip</th>
                            <th>Notary Name</th>
                            <th>Notary Phone</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Docs</th>
                            <th>Upload</th>
                        </tr>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    @if(!$isClient)
                                    <td><button type="button" class="btn btn-primary editOrder" data-toggle="modal" data-target="#editOrderModal"
                                            data-order_id="{{ $order->order_id }}"
                                            data-loan="{{ $order->loan_id }}"
                                            data-file="{{ $order->file_id }}"
                                            data-property_location_street_name = "{{ $order->property_location_street_name }}"
                                            data-property_location_additional_street_name = "{{ $order->property_location_additional_street_name }}"
                                            data-property_location_city = "{{ $order->property_location_city }}"
                                            data-property_location_state = "{{ $order->property_location_state }}"
                                            data-property_location_zip = "{{ $order->property_location_zip }}"
                                            data-close_location_street_name = "{{ $order->close_location_street_name }}"
                                            data-close_location_additional_street_name = "{{ $order->close_location_additional_street_name }}"
                                            data-close_location_city = "{{ $order->close_location_city }}"
                                            data-close_location_state = "{{ $order->close_location_state }}"
                                            data-close_location_zip = "{{ $order->close_location_zip }}"
                                            data-borrower_name = "{{ $order->borrower_name }}"
                                            data-borrower_middle_name = "{{ $order->borrower_middle_name }}"
                                            data-borrower_last_name = "{{ $order->borrower_last_name }}"
                                            data-borrower_email = "{{ $order->borrower_email }}"
                                            data-coborrower_name = "{{ $order->coborrower_name }}"
                                            data-coborrower_middle_name = "{{ $order->coborrower_middle_name }}"
                                            data-coborrower_last_name = "{{ $order->coborrower_last_name }}"
                                            data-contact_number_home = "{{ $order->contact_number_home }}"
                                            data-contact_number_mobile = "{{ $order->contact_number_mobile }}"
                                            data-contact_number_alt = "{{ $order->contact_number_alt }}"
                                            data-closing_time_and_date = "{{ $order->closing_time_and_date }}"
                                            data-closing_type = "{{ $order->closing_type }}"
                                            data-closing_information_type_value = "{{ $order->closing_information_type_value }}"
                                            data-closing_information_email = "{{ $order->closing_information_email }}"
                                            data-closing_information_fax = "{{ $order->closing_information_fax }}"
                                            data-lo_name = "{{ $order->lo_name }}"
                                            data-lo_number = "{{ $order->lo_number }}"
                                            data-lo_email = "{{ $order->lo_email }}"
                                            data-internal_notes = "{{ $order->internal_notes }}"
                                            data-fax_select = "{{ $order->fax_select }}"
                                            data-special_instructions = "{{ $order->special_instructions }}"
                                            data-status = "{{ $order->status }}"
                                            data-notary_id = "{{ $order->notary_id }}"
                                            data-fee = "{{ $order->fee }}"
                                         ><i class="fas fa-edit"></button></td>
                                    @else
                                    <td><button type="button" class="btn btn-primary sendEditOrderModal" data-toggle="modal" data-target="#sendEditOrderModal" data-id="{{ $order->order_id }}"><i class="fas fa-edit"></button></td>
                                    @endif
                                    <td>{{ $order->loan_id }}</td>
                                    <td>{{ $order->file_id }}</td>
                                    <td>{{ date('m/d/yy', strtotime($order->closing_time_and_date))  }}</td>
                                    <td>{{ $order->borrower_name.' '.$order->borrower_last_name }}</td>
                                    <td>{{ $order->close_location_street_name }}</td>
                                    <td>{{ $order->property_location_city }}</td>
                                    <td>{{ $order->property_location_zip }}</td>
                                    <td>{{ !empty($order->notary_name) ? $order->notary_name : 'N/A' }}</td>
                                    <td>{{ !empty($order->notary_phone) ? $order->notary_phone : 'N/A' }}</td>
                                    <td>{{ !empty($order->fee) ? $order->fee : 'N/A' }}</td>
                                    <td>
                                        {!! show_order_status($order->status) !!}
                                    </td>
                                    <?php $all_documents = \App\Models\OrderDocuments::select("*")->where("order_id",$order->order_id)->get(); ?>
                                    <td> <?php 
                                        if($order->document_status == 0) 
                                            echo 'No docs uploaded'; 
                                        else if(!empty($all_documents) && $order->document_status == 1) 
                                            echo "Documents uploaded"; 
                                        else if(!empty($all_documents) && $order->document_status == 2) 
                                            echo "Documents sent"; 
                                        ?> 
                                    </td>
                                    <td><button type="button" class="btn btn-primary uploadDocument" data-toggle="modal" data-id="{{ $order->order_id }}" data-email="{{ $order->borrower_email }}" data-target="#uploadDocument"><i class="fas fa-upload"></button></td>
                                </tr>
                                @empty
                                    <tbody>
                                        <tr>
                                            <td colspan="14" style="text-align: center;">
                                                <h3>No orders found</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('shared.orders.upload_documents')
@include('shared.orders.send_documents')
@include('shared.orders.create_order')
@include('shared.orders.edit_order')
@include('shared.orders.send_edit_order')

<style>
.tag {
    background-color: #3490dc !important;
    padding: 10px;
    font-weight: bold;
    color: white;
    line-height: 20px;
}
.modal-xl {
    max-width: 90% !important;
}
.order_menu_font {
    font-size: 14px;
}
.py-20 {
    margin-top: 10px;
}
#notary_list {
    width: 100% !important;
}
.hide {
    display: none;
}
.show {
    display: inline-block;
}
.progress { position:relative; width:90%; margin-left: 5%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; margin-top: 15px; height: 30px;}
.bar { background-color: #B4F5B4; width:0%; height:30px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:15px; left:48%; color: #7F98B2; }
</style>

<script>
function validate(formData, jqForm, options) {
        var form = jqForm[0];
        // if (!form.image[].value) {
        //     alert('File not found');
        //     return false;
        // }
    }
 
    (function() {
 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
    $('.progress').addClass('hide').removeClass('show'); 
 
    $('#uploadDocumentsForm').ajaxForm({
        beforeSubmit: validate,
        beforeSend: function() {
            status.empty();
            $('.progress').removeClass('hide').addClass('show');        
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = 'Wait, Saving';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            status.html(xhr.responseText);
            window.location.reload();
        }
    });
     
    })();


    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form-send-email').on('click', function(event){
            
            event.preventDefault();
            
            var email = $("input[name='email']").val();
            var order = $("input[name='order']").val();
			files = [];
            $('input[name="files[]"]').each(function() {
                /*var file = $(this).val();
                item = {}
                item ["files"] = file;
                files.push(item);*/
                files.push($(this).val());
            });

			//Ajax Send Request
			$.ajax({
				url: '{{ route('send_order_email') }}', //Name Api Route
				method: 'POST', //Method Request
				data: {
                    email:email,
                    order:order,
                    files:JSON.stringify(files)   
                },
				beforeSend:function() {
					$('#submit').attr('disabled', 'disabled');
					$('#submit').html('SENDING...');
				},
				success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                        window.location.reload();
                    }else{
                        toastr.error(data.error);
                    }
                },
                error: function(jqXHR, textStatus, error) { 
                    
                }
			});
            
        });

        $('.btn_select_notary').click(function() {
            
            var vendor_first_name = $(this).data("vendor_first_name");
            var vendor_last_name = $(this).data("vendor_last_name");
            var vendor_address = $(this).data("vendor_address");
            var vendor_city = $(this).data("vendor_city");
            var vendor_state = $(this).data("vendor_state");
            var vendor_zip_code = $(this).data("vendor_zip_code");
            var vendor_phone_number = $(this).data("vendor_phone_number");
            var vendor_email = $(this).data("vendor_email");
            var vendor_fee = $(this).data("vendor_fee");
            var vendor_additional_service_fee = $(this).data("vendor_additional_service_fee");
            var vendor_id = $(this).data("vendor_id");

            $('.vendor_first_name').val(vendor_first_name);
            $('.vendor_last_name').val(vendor_last_name);
            $('.vendor_address').val(vendor_address);
            $('.vendor_city').val(vendor_city);
            $('.vendor_state').val(vendor_state);
            $('.vendor_zip_code').val(vendor_zip_code);
            $('.vendor_phone_number').val(vendor_phone_number);
            $('.vendor_email').val(vendor_email);
            $('.vendor_fee').val(vendor_fee);
            $('.vendor_additional_service_fee').val(vendor_additional_service_fee);
            $('.vendor_id').val(vendor_id);

        });

        $('.notaryAvailability').click(function() {
            alert($(this).data('email'));
        });

        $('.editOrder').click(function() {
            var id = $(this).data("order_id");
            var loan = $(this).data("loan");
            var file = $(this).data("file");
            var property_location_street_name = $(this).data("property_location_street_name");
            var property_location_additional_street_name = $(this).data("property_location_additional_street_name");
            var property_location_city = $(this).data("property_location_city");
            var property_location_state = $(this).data("property_location_state");
            var property_location_zip = $(this).data("property_location_zip");
            var close_location_street_name = $(this).data("close_location_street_name");
            var close_location_additional_street_name = $(this).data("close_location_additional_street_name");
            var close_location_city = $(this).data("close_location_city");
            var close_location_state = $(this).data("close_location_state");
            var close_location_zip = $(this).data("close_location_zip");
            var borrower_name = $(this).data("borrower_name");
            var borrower_middle_name = $(this).data("borrower_middle_name");
            var borrower_last_name = $(this).data("borrower_last_name");
            var borrower_email = $(this).data("borrower_email");
            var coborrower_name = $(this).data("coborrower_name");
            var coborrower_middle_name = $(this).data("coborrower_middle_name");
            var coborrower_last_name = $(this).data("coborrower_last_name");
            var contact_number_home = $(this).data("contact_number_home");
            var contact_number_mobile = $(this).data("contact_number_mobile");
            var contact_number_alt = $(this).data("contact_number_alt");
            var closing_time_and_date = $(this).data("closing_time_and_date");
            var closing_type = $(this).data("closing_type");
            var closing_information_type_value = $(this).data("closing_information_type_value");
            var closing_information_email = $(this).data("closing_information_email");
            var closing_information_fax = $(this).data("closing_information_fax");
            var lo_name = $(this).data("lo_name");
            var lo_number = $(this).data("lo_number");
            var lo_email = $(this).data("lo_email");
            var fax_select = $(this).data("fax_select");
            var internal_notes = $(this).data("internal_notes");
            var special_instructions = $(this).data("special_instructions");
            var status = $(this).data("status");
            var notary_id = $(this).data("notary_id");
            var fee = $(this).data("fee");

            $('.edit_order_id').val(id);
            $('.edit_loan_id').val(loan);
            $('.edit_file_id').val(file);
            $('.vendor_id').val(notary_id);
            $('.vendor_fee').val(fee);

            $('.edit_property_location_street_name').val(property_location_street_name);
            $('.edit_property_location_additional_street_name').val(property_location_additional_street_name);
            $('.edit_property_location_city').val(property_location_city);
            $('.edit_property_location_state').val(property_location_state);
            $('.edit_property_location_zip').val(property_location_zip);

            $('.edit_close_location_street_name').val(close_location_street_name);
            $('.edit_close_location_additional_street_name').val(close_location_additional_street_name);
            $('.edit_close_location_city').val(close_location_city);
            $('.edit_close_location_state').val(close_location_state);
            $('.edit_close_location_zip').val(close_location_zip);

            $('.edit_borrower_name').val(borrower_name);
            $('.edit_borrower_middle_name').val(borrower_middle_name);
            $('.edit_borrower_last_name').val(borrower_last_name);
            $('.edit_borrower_email').val(borrower_email);

            $('.edit_coborrower_name').val(coborrower_name);
            $('.edit_coborrower_middle_name').val(coborrower_middle_name);
            $('.edit_coborrower_last_name').val(coborrower_last_name);

            console.log("HERE IS COBORROWER: "+JSON.stringify(coborrower_name))

            $('.edit_contact_number_home').val(contact_number_home);
            $('.edit_contact_number_mobile').val(contact_number_mobile);
            $('.edit_contact_number_alt').val(contact_number_alt);
            $('.edit_closing_time_and_date').val(closing_time_and_date);
            $('.edit_closing_type').val(closing_type);
            $('.edit_closing_information_type_value').val(closing_information_type_value);
            $('.edit_closing_information_email').val(closing_information_email);
            $('.edit_closing_information_fax').val(closing_information_fax);
            $('.edit_lo_name').val(lo_name);
            $('.edit_lo_number').val(lo_number);
            $('.edit_lo_email').val(lo_email);
            var fax_select = $('.edit_fax_select').val(fax_select);
            var internal_notes = $('.edit_internal_notes').text(internal_notes);
            var special_instructions = $('.edit_special_instructions').text(special_instructions);
            $('.edit_status').val(status);

            if(fax_select) {
                $('.fax_number').removeClass('hide').addClass('show');
                $('.email').removeClass('hide').addClass('show');
            } 

            var order_date = closing_time_and_date.substr(0,closing_time_and_date.indexOf(' ')); 
            var order_time = closing_time_and_date.substr(closing_time_and_date.indexOf(' ')+1); 
            $(".edit_closing_time_and_date").val(order_date+"T"+order_time);

            if(closing_type == 5) {
                $('.specify_other').removeClass('hide').addClass('show');
            }

            if(internal_notes !== '')
                $('.edit_lo_info').prop('checked', true);
            if(special_instructions !== '')
                $('.edit_notary_info').prop('checked', true);

            var vendor_id = $('.vendor_id').val();

            if(vendor_id != '') {
                $.ajax({
                    type: "get",
                    dataType: "json",       
                    url: "{{ url('/getVendorById') }}/"+vendor_id,
                    success: function(response)
                    {
                        if(response) {
                            $('.vendor_first_name').val(JSON.stringify(response.data[0].name).replace(/['"]+/g, '')); 
                            $('.vendor_last_name').val(JSON.stringify(response.data[0].lastName).replace(/['"]+/g, '')); 
                            $('.vendor_address').val(JSON.stringify(response.data[0].paymentAddress).replace(/['"]+/g, '')); 
                            $('.vendor_city').val(JSON.stringify(response.data[0].lastName).replace(/['"]+/g, '')); 
                            $('.vendor_state').val(JSON.stringify(response.data[0].lastName).replace(/['"]+/g, '')); 

                        }
                    },
                    error: function(jqXHR, textStatus, error) { 
                        alert(error);
                    }
                });
            }

        });

        $('.uploadDocument').click(function() {
            var id = $(this).data("order_id");
            var email = $(this).data("email");

            $('.inputEmail').val(email);
            $('.inputOrder').val(id);

            $("#uploaded_documents_order_id").val(id);
            $.ajax({
                    type: "get",
                    url: "{{ url('/uploaded_documents_list') }}/"+id,
                    success: function(response)
                    {
                        if(response) {
                            $("#uploaded_documents_list").empty();
                            $.each(response, function (key, value) {
                                $('#uploaded_documents_list').append('<tr><td class="uploadedDocument"><i class="far fa-file fa-2x"></i> '+response[key]['name']+'</td><td id="deleteDocument" data-id='+response[key]['id']+'><i class="far fa-times fa-2x" style="color: red;"></i></td></tr>');
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, error) { 
                        alert(error);
                    }
                });
        });

        $(document).on('click', '#deleteDocument' , function() {
            var id = $(this).data("id");
            $.ajax({
                url: "/delete_document/"+id,
                type: 'delete', // replaced from put
                dataType: "JSON",
                data: {
                    "id": id 
                },
                success: function (response)
                {
                    toastr.success(response.success);
                    window.location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText); 
                }
            });
        });

        $('.update_order').on('click', function (e) {
            e.preventDefault();
            
            var order_id = $("input[name='edit_order_id']").val();
            var loan_id = $("input[name='edit_loan_id']").val();
            var file_id = $("input[name='edit_file_id']").val();
            var property_location_street_name = $("input[name='edit_property_location_street_name']").val();
            var property_location_additional_street_name = $("input[name='edit_property_location_additional_street_name']").val();
            var property_location_city = $("input[name='edit_property_location_city']").val();
            var property_location_state = $("select[name='edit_property_location_state']").val();
            var property_location_zip = $("input[name='edit_property_location_zip']").val();
            var close_location_street_name = $("input[name='edit_close_location_street_name']").val();
            var close_location_additional_street_name = $("input[name='edit_close_location_additional_street_name']").val();
            var close_location_city = $("input[name='edit_close_location_city']").val();
            var close_location_state = $("select[name='edit_close_location_state']").val();
            var close_location_zip = $("input[name='edit_close_location_zip']").val();
            var borrower_name = $("input[name='edit_borrower_name']").val();
            var borrower_middle_name = $("input[name='edit_borrower_middle_name']").val();
            var borrower_last_name = $("input[name='edit_borrower_last_name']").val();
            var borrower_email = $("input[name='edit_borrower_email']").val();

            coborrower_name = [];
            coborrower_middle_name = [];
            coborrower_last_name = [];

            $('input[name="edit_coborrower_name[]"]').each(function() {
                var name = $(this).val();
                item = {}
                item ["name"] = name;
                coborrower_name.push(item);
            });
            $('input[name="edit_coborrower_middle_name[]"]').each(function() {
                var name = $(this).val();
                item = {}
                item ["middle_name"] = name;
                coborrower_middle_name.push(item);
            });
            $('input[name="edit_coborrower_last_name[]"]').each(function() {
                var name = $(this).val();
                item = {}
                item ["last_name"] = name;
                coborrower_last_name.push(item);
            });
            
            var contact_number_home = $("input[name='edit_contact_number_home']").val();
            var contact_number_mobile = $("input[name='edit_contact_number_mobile']").val();
            var contact_number_alt = $("input[name='edit_contact_number_alt']").val();
            var closing_time_and_date = $("input[name='edit_closing_time_and_date']").val();
            var closing_type = $("select[name='edit_closing_type']").val();
            var fax_select = $("select[name='edit_fax_select']").val();
            var closing_information_fax = $("input[name='edit_closing_information_fax']").val();
            var closing_information_email = $("input[name='edit_closing_information_email']").val();
            var closing_information_type_value = $("input[name='edit_closing_information_type_value']").val();
            var lo_name = $("input[name='edit_lo_name']").val();
            var lo_email = $("input[name='edit_lo_email']").val();
            var lo_number = $("input[name='edit_lo_number']").val();
            var status = $("select[name='edit_status']").val();
            var created_by = $("input[name='edit_created_by']").val();
            var internal_notes = $("textarea[name='edit_internal_notes']").val();
            var special_instructions = $("textarea[name='edit_special_instructions']").val();

            var notary_id = $("input[name='edit_vendor_id']").val();
            var fee = $("input[name='edit_vendor_fee']").val();

            $.ajax({
                type:'POST',
                url: "{{ route('update_order') }}",
                data: {
                        order_id:order_id, 
                        loan_id:loan_id, 
                        file_id:file_id,
                        property_location_street_name:property_location_street_name,
                        property_location_additional_street_name:property_location_additional_street_name,
                        property_location_city:property_location_city,
                        property_location_state:property_location_state,
                        property_location_zip:property_location_zip,
                        close_location_street_name:close_location_street_name,
                        close_location_additional_street_name:close_location_additional_street_name,
                        close_location_city:close_location_city,
                        close_location_state:close_location_state,
                        close_location_zip:close_location_zip,
                        borrower_name:borrower_name,
                        borrower_middle_name:borrower_middle_name,
                        borrower_last_name:borrower_last_name,
                        borrower_email:borrower_email,
                        coborrower_name:JSON.stringify(coborrower_name),
                        coborrower_middle_name:JSON.stringify(coborrower_middle_name),
                        coborrower_last_name:JSON.stringify(coborrower_last_name),
                        contact_number_home:contact_number_home,
                        contact_number_mobile:contact_number_mobile,
                        contact_number_alt:contact_number_alt,
                        closing_time_and_date:closing_time_and_date,
                        closing_type:closing_type,
                        closing_information_fax:closing_information_fax,
                        closing_information_email:closing_information_email,
                        closing_information_type_value:closing_information_type_value,
                        lo_name:lo_name,
                        lo_email:lo_email,
                        lo_number:lo_number,
                        fax_select: fax_select,
                        internal_notes: internal_notes,
                        special_instructions: special_instructions,
                        status: status,
                        notary_id:notary_id,
                        fee:fee,
                        created_by:created_by
                    },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                        window.location.reload();
                    }else{
                        toastr.error(data.error);
                    }
                },
                error: function(jqXHR, textStatus, error) { 
                    
                }
            });
        })

        $('.create_order').on('click', function (e) {
            e.preventDefault();
            
            var order_id = $("input[name='order_id']").val();
            var loan_id = $("input[name='loan_id']").val();
            var file_id = $("input[name='file_id']").val();
            var property_location_street_name = $("input[name='property_location_street_name']").val();
            var property_location_additional_street_name = $("input[name='property_location_additional_street_name']").val();
            var property_location_city = $("input[name='property_location_city']").val();
            var property_location_state = $("select[name='property_location_state']").val();
            var property_location_zip = $("input[name='property_location_zip']").val();
            var close_location_street_name = $("input[name='close_location_street_name']").val();
            var close_location_additional_street_name = $("input[name='close_location_additional_street_name']").val();
            var close_location_city = $("input[name='close_location_city']").val();
            var close_location_state = $("select[name='close_location_state']").val();
            var close_location_zip = $("input[name='close_location_zip']").val();
            var borrower_name = $("input[name='borrower_name']").val();
            var borrower_middle_name = $("input[name='borrower_middle_name']").val();
            var borrower_last_name = $("input[name='borrower_last_name']").val();
            var borrower_email = $("input[name='borrower_email']").val();

            coborrower_name = [];
            coborrower_middle_name = [];
            coborrower_last_name = [];

            $('input[name="coborrower_name[]"]').each(function() {
                var name = $(this).val();
                item = {}
                item ["name"] = name;
                coborrower_name.push(item);
            });
            $('input[name="coborrower_middle_name[]"]').each(function() {
                var name = $(this).val();
                item = {}
                item ["middle_name"] = name;
                coborrower_middle_name.push(item);
            });
            $('input[name="coborrower_last_name[]"]').each(function() {
                var name = $(this).val();
                item = {}
                item ["last_name"] = name;
                coborrower_last_name.push(item);
            });
            
            var contact_number_home = $("input[name='contact_number_home']").val();
            var contact_number_mobile = $("input[name='contact_number_mobile']").val();
            var contact_number_alt = $("input[name='contact_number_alt']").val();
            var closing_time_and_date = $("input[name='closing_time_and_date']").val();
            var closing_type = $("select[name='closing_type']").val();
            var fax_select = $("select[name='fax_select']").val();
            var closing_information_fax = $("input[name='closing_information_fax']").val();
            var closing_information_email = $("input[name='closing_information_email']").val();
            var closing_information_type_value = $("input[name='closing_information_type_value']").val();
            var lo_name = $("input[name='lo_name']").val();
            var lo_email = $("input[name='lo_email']").val();
            var lo_number = $("input[name='lo_number']").val();
            var created_by = $("input[name='created_by']").val();
            var internal_notes = $("textarea[name='internal_notes']").val();
            var special_instructions = $("textarea[name='special_instructions']").val();
            $.ajax({
                type:'POST',
                url: "{{ route('create_order') }}",
                data: {
                        order_id:order_id, 
                        loan_id:loan_id, 
                        file_id:file_id,
                        property_location_street_name:property_location_street_name,
                        property_location_additional_street_name:property_location_additional_street_name,
                        property_location_city:property_location_city,
                        property_location_state:property_location_state,
                        property_location_zip:property_location_zip,
                        close_location_street_name:close_location_street_name,
                        close_location_additional_street_name:close_location_additional_street_name,
                        close_location_city:close_location_city,
                        close_location_state:close_location_state,
                        close_location_zip:close_location_zip,
                        borrower_name:borrower_name,
                        borrower_middle_name:borrower_middle_name,
                        borrower_last_name:borrower_last_name,
                        borrower_email:borrower_email,
                        coborrower_name:JSON.stringify(coborrower_name),
                        coborrower_middle_name:JSON.stringify(coborrower_middle_name),
                        coborrower_last_name:JSON.stringify(coborrower_last_name),
                        contact_number_home:contact_number_home,
                        contact_number_mobile:contact_number_mobile,
                        contact_number_alt:contact_number_alt,
                        closing_time_and_date:closing_time_and_date,
                        closing_type:closing_type,
                        closing_information_fax:closing_information_fax,
                        closing_information_email:closing_information_email,
                        closing_information_type_value:closing_information_type_value,
                        lo_name:lo_name,
                        lo_email:lo_email,
                        lo_number:lo_number,
                        fax_select: fax_select,
                        internal_notes: internal_notes,
                        special_instructions: special_instructions,
                        created_by:created_by
                    },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                        window.location.reload();
                    }else{
                        toastr.error(data.error);
                    }
                },
                error: function(jqXHR, textStatus, error) { 
                    
                }
            });
        })

        $('select[name="property_location_state"]').change(function(e) {
            if(isSameLocation()) 
            {
                var selectedItem = $("select[name='property_location_state']").val();
                $("select[name='close_location_state'] option[value="+selectedItem+"]").prop('selected', true);
            }
        });
        
        $('.same_property_location').on('click', function() {
            if(isSameLocation()) 
                sameCloseAddress()
            else
                differentCloseAddress()
        })

        function isSameLocation() {
            if($('.same_property_location').prop('checked') == true)
                return 1;
            else 
                return 0;
        }

        $( ".property_location_street_name, .property_location_additional_street_name, .property_location_city, .property_location_state, .property_location_zip" ).keyup(function() {
            if(isSameLocation())
                sameCloseAddress()
            else 
                differentCloseAddress()
        });

        function sameCloseAddress() {
            $('.close_location_street_name').val($('.property_location_street_name').val());
            $('.close_location_street_name').attr("disabled", true);
            $('.close_location_additional_street_name').val($('.property_location_additional_street_name').val());
            $('.close_location_additional_street_name').attr("disabled", true);
            $('.close_location_city').val($('.property_location_city').val());
            $('.close_location_city').attr("disabled", true);
            $('.close_location_zip').val($('.property_location_zip').val());
            $('.close_location_zip').attr("disabled", true);
            var selectedItem = $("select[name='property_location_state']").val();
            $("select[name='close_location_state']").prop('disabled', true);
            $("select[name='close_location_state'] option[value="+selectedItem+"]").prop('selected', true);
        }

        function differentCloseAddress() {
            $('.close_location_street_name').attr("disabled", false);
            $('.close_location_additional_street_name').attr("disabled", false);
            $('.close_location_city').attr("disabled", false);
            $('.close_location_state').attr("disabled", false);
            $('.close_location_zip').attr("disabled", false);
            $("select[name='close_location_state']").prop('disabled', false);
        }

        var count = 0;
        $(document).on('click', '.addCoborrower', function(){
        count++;
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="coborrower_name[]" class="form-control coborrower_name" /></td>';
        html += '<td><input type="text" name="coborrower_middle_name[]" class="form-control coborrower_middle_name" /></td>';
        html += '<td><input type="text" name="coborrower_last_name[]" class="form-control coborrower_last_name" /></td>';
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-block remove"><i class="fas fa-times" style=" vertical-align: middle !important;"></button></td>';
        $('#coborrower_table tbody').append(html);
        });

            $(document).on('click', '.remove', function(){
            var rowCount = $('#coborrower_table tr').length;
            $(this).closest('tr').remove();
        });

        $('.fax_select, .edit_fax_select').on('change', function() {
            var selected_value = $(this).val();
            if(selected_value == 1) {
                $('.fax_number').removeClass('hide').addClass('show');
                $('.email').removeClass('hide').addClass('show');
            }
            else {
                $('.email').removeClass('show').addClass('hide');
                $('.email').val("");
                $('.fax_number').removeClass('show').addClass('hide');
                $('.fax_number').val("");
            }
        });

        $('.closing_type, .edit_closing_type').on('change', function() {
            var selected_value = $(this).find(":selected").text();
            console.log($.trim(selected_value));
            if($.trim(selected_value) === "Other") 
                $('.specify_other').removeClass('hide').addClass('show');
            else  {
                $('.specify_other').removeClass('show').addClass('hide');
                $('.specify_other').val("");
            }
        });
    });
</script>
@endsection


