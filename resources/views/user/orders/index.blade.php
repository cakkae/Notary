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

                <div class="card-body">
                    <table class="table table-response">
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
                            <tr>
                                <td>...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6 py-20">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Order #</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="col-md-6 py-20">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Loan #</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Property Location</label>
                        <textarea class="form-control" name="property_location"></textarea>
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Closing Location</label>
                        <textarea class="form-control" name="closing_location"></textarea>
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Borrower & Co Borrower Name</label>
                        <textarea class="form-control" name="borrower_name"></textarea>
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Closing Time and Date</label>
                        <input type="datetime-local" class="form-control input-lg" name="closing_time"/>
                    </div>
                    <div class="col-md-12 py-20">
                        <label>Contact Number </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 80px; max-width: 120px">Home:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 80px; max-width: 100px">Mobile:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 80px; max-width: 100px">Alt:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="col-md-12 py-20">
                        <h4>Closing Information</h4>
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Closing type</label>
                        <select name="closing_type" class="form-control">
                            <option value="-1" selected disabled>Please choose...</option>
                            <option value="0">Application</option>
                            <option value="0">Deed Only</option>
                            <option value="0">Purchase</option>
                            <option value="0">Refinance</option>
                            <option value="0">Reverse</option>
                            <option value="0">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Fax/Scanbacks</label>
                        <select name="closing_type" class="form-control">
                            <option value="-1" selected disabled>Please choose...</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6 py-20">
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6 py-20">
                        <input type="email" class="form-control">
                    </div>
                    <div class="col-md-12 py-20">
                        <input type="text" class="form-control" placeholder="Specify other...">
                    </div>
                    <div class="col-md-12 py-20">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 100px; max-width: 120px">LO Name:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 100px; max-width: 120px">LO Number:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 100px; max-width: 120px">LO Email:</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="lo_info" id="lo_info" value="0">
                                <label class="form-check-label" for="lo_info">
                                    Include LO Info in Notary confirmation
                                </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="notary_info" id="notary_info" value="1">
                                <label class="form-check-label" for="notary_info">
                                    Send Notary Info to LO
                                </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Internal notes</label>
                        <textarea class="form-control internal_notes" name="internal_notes"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Special instructions</label>
                        <textarea class="form-control special_instructions" name="special_instructions"></textarea>
                    </div>
                </div>                
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <table id="notary_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Middlename</th>
                                    <th>Payment Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <!-- <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="col-md-12">
                        <h4>Notary Info</h4>
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Firstname:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6 py-20">
                        <label>Lastname:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-12 py-20">
                        <label>Address:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4 py-20">
                        <label>City:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4 py-20">
                        <label>State:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4 py-20">
                        <label>Zip Code:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4 py-20">
                        <label>Phone number:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4 py-20">
                        <label>Email Address:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4 py-20">
                        <label>Fee:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-12 py-20">
                        <label>Additional Service Fee:</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Close</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block">Update</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block">Update and Send Confirmation</button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.modal-xl {
    max-width: 90% !important;
}
.order_menu_font {
    font-size: 19px;
}
.py-20 {
    margin-top: 10px;
}
#notary_list {
    width: 100% !important;
}
</style>
<script>
    $(document).ready(function() {
        $('#notary_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('user.orders') }}",
            },
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'lastName',
                    name: 'lastName'
                },
                {
                    data: 'middleName',
                    name: 'middleName'
                },
                {
                    data: 'paymentAddress',
                    name: 'paymentAddress'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        })
    });
</script>
@endsection
