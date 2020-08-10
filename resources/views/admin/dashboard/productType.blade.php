@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddProductType">
                        ADD PRODUCT TYPE
                    </button>
                </div>
                <div class="card-body">
                <form>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }} 
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Product name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($productTypes as $key => $productType)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $productType->name }}</td>
                            <td><button type="button" class="btn btn-danger btnDeleteProductType" data-id="{{ $productType->id }}">DELETE</button></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="font-size: 22px; text-align: center;">No results</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                        </tr>
                    </tfoot>
                </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddProductType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add product type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
            {{ csrf_field() }}
      <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="product_type_id">Product type name:</label>
                    <input type="text" class="product_type_name form-control" name="product_type_name">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary addProductType">ADD PRODUCT YPE</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function (){

    $('.addProductType').click(function (){
        var _token = $("input[name='_token']").val();
        var name = $(".product_type_name").val();

        $.ajax({
            type:'POST',
            url: "{{ route('addProductType') }}",
            data: {
                _token:_token, 
                name:name
            },
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    toastr.success(data.success);
                    window.location.href = "{{ route('productType') }}";
                }else{
                    toastr.error(data.error);
                }
            },
            error: function(jqXHR, textStatus, error) { 
                
            }
        });
    });

    $('.btnDeleteProductType').click(function ()
    {
        var id = $(this).data("id");
        var _token = $("input[name='_token']").val();

        $.ajax({
            type:'DELETE',
            url: "/admin/deleteProductType/"+id,
            data: {
                _token:_token, 
                id:id
            },
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    toastr.success(data.success);
                    window.location.href = "{{ route('productType') }}";
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
