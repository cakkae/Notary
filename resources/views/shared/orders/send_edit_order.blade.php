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
            <div class="row">
                <div class="col-md-12">
                    <label for="order_id">Order ID</label>
                    <input type="text" disabled class="form-control request_edit_order_id" name="order_id">
                   <label for="message" class="py-20">Message:</label>
                   <textarea name="message" id="message" class="form-control message" cols="30" rows="10"></textarea>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.sendEditOrderRequest').click(function (){
        var order_id = $('.request_edit_order_id').val();
        var message = $('.message').val();
        $.ajax({
                type:'POST',
                url: "{{ route('add_user_order_request') }}",
                data: {
                        order_id:order_id, 
                        message: message
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