<!-- Add Order Modal -->
<div class="modal fade" id="sendEditOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Order Modal Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <label for="order_id">Order ID</label>
                    <input type="text" disabled class="form-control request_edit_order_id">
                   <label for="message" class="py-20">Message:</label>
                   <textarea name="message" id="message" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>        
        </div>
      <div class="modal-footer">
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Close</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block sendEditOrderRequest">Send request</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
$(document).ready(function () {

    $('.sendEditOrderModal').click(function (){
        var order_id = $(this).data('id');
        $('.request_edit_order_id').val(order_id);
    });

    $('.sendEditOrderRequest').click(function (){
        var message = $('.message').val();
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

    });
});
</script>