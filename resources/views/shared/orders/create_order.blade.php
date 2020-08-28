<!-- Add Order Modal -->
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
        <form>
            {{ csrf_field() }}
            <input type="hidden" value="{{ Auth::user()->id }}" name="created_by">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Order #</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Order#" name="order_id" value="<?php if(!empty($lastOrder)) echo ++$lastOrder->order_id; else echo "1";?>">
                            </div>
                        </div>
                        <div class="col-md-3 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Loan #</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Loan#" name="loan_id">
                            </div>
                        </div>
                        <div class="col-md-3 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">File #</span>
                                </div>
                                <input type="text" class="form-control" aria-label="File#" name="file_id">
                            </div>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Property Location</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control property_location_street_name" name="property_location_street_name" placeholder="Street name">
                                </div>
                                <div class="col-md-12 py-20">
                                    <input type="text" class="form-control property_location_additional_street_name" name="property_location_additional_street_name" placeholder="Additional Street name">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control property_location_city" name="property_location_city" placeholder="City">
                                </div>
                                <div class="col-md-4 py-20">
                                    <!-- <input type="text" class="form-control property_location_state" name="property_location_state" placeholder="State"> -->
                                    <select class="form-control" name="property_location_state" id="property_location_state">
                                        <option value="">Select state</option>
                                            @foreach($states as $state) 
                                                <option value="{{ $state->state_id }}">{{ $state->state }}  </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control property_location_zip" name="property_location_zip" placeholder="Zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 py-20">
                        <label>Close Location</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control close_location_street_name" name="close_location_street_name" placeholder="Street name">
                                </div>
                                <div class="col-md-12 py-20">
                                    <input type="text" class="form-control close_location_additional_street_name" name="close_location_additional_street_name" placeholder="Additional Street name">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control close_location_city" name="close_location_city" placeholder="City">
                                </div>
                                <div class="col-md-4 py-20">
                                    <!-- <input type="text" class="form-control close_location_state" name="close_location_state" placeholder="State"> -->
                                    <select class="form-control" name="close_location_state" id="close_location_state">
                                        <option value="">Select state</option>
                                            @foreach($states as $state) 
                                                <option value="{{ $state->state_id }}">{{ $state->state }}  </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control close_location_zip" name="close_location_zip" placeholder="Zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-6 py-20">
                            <input type="checkbox" class="same_property_location form-check-input" type="checkbox" name="same_property_location" id="same_property_location"> 
                                <label class="form-check-label" for="same_property_location">
                                    Select Check Box is same as Property location 
                                </label>
                        </div>
                        <div class="col-md-6 py-20">
                            <div class="row">
                            <div class="col-md-12">
                                <label>Borrower Name</label>
                            </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control borrower_name" name="borrower_name" placeholder="First name">
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" class="form-control borrower_middle_name" name="borrower_middle_name" placeholder="Middle name">
                                </div>
                                <div class="col-md-4 ">
                                    <input type="text" class="form-control borrower_last_name" name="borrower_last_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-12 py-20">
                                    <label>Contact Number </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 80px; max-width: 120px">Home:</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Home number" name="contact_number_home">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 80px; max-width: 100px">Mobile:</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Mobile number" name="contact_number_mobile">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 80px; max-width: 100px">Alt:</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Alt number" name="contact_number_alt">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control borrower_email" name="borrower_email" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Co Borrower Name</label>
                            <table class="table table-bordered" id="coborrower_table">
                            <span id="error"></span>
                            <thead>
                                <tr>
                                <th class="center">Coborrower name</th>
                                <th class="center">Coborrower middle name</th>
                                <th class="center">Coborrower lastname</th>
                                <th>
                                    <button type="button" name="addCoborrower" id="addCoborrower" class="btn btn-primary btn-block addCoborrower">
                                        ADD
                                    </button>
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="coborrower_name[]" class="form-control coborrower_name" /></td>
                                    <td><input type="text" name="coborrower_middle_name[]" class="form-control coborrower_middle_name" /></td>
                                    <td><input type="text" name="coborrower_last_name[]" class="form-control coborrower_last_name" /></td>
                                    <td><button type="button" name="remove" class="btn btn-danger btn-block remove"><i class="fas fa-times" style=" vertical-align: middle !important;"></button></td>
                                </tr>
                            </tbody>
                            <tfoot></tfoot>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <label>Closing Time and Date</label>
                            <input type="datetime-local" class="form-control input-lg" name="closing_time_and_date"/>
                        </div>
                        <div class="col-md-12 py-20">
                            <h4>Closing Information</h4>
                        </div>
                        <div class="col-md-12 py-20">
                        <label>Client</label>
                        <select class="form-control" name="close_location_state" id="close_location_state" <?php if($isClient) echo "disabled";?>>
                            <option value="" disabled>Select client</option>
                            @foreach($clients as $client) 
                                <option value="{{ $client->id }}" <?php if($isClient && Auth::user()->id == $client->id) echo "selected";?>>{{ $client->name.' '.$client->lastName.' ('.\App\Models\Company::where('id', $client->company_id)->get()->pluck('company_name')->first().')' }}  </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Closing type</label>
                            <select name="closing_type" class="form-control closing_type">
                                <option value="" disabled selected>Select product type</option>
                                @foreach($productTypes as $productType) 
                                    <option value="{{ $productType->id }}">{{ $productType->name }}  </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Fax/Scanbacks</label>
                            <select name="fax_select" class="form-control fax_select">
                                <option value="-1" selected disabled>Please choose...</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6 py-20">
                            <input type="text" class="form-control fax_number hide" placeholder="Fax number" name="closing_information_fax">
                        </div>
                        <div class="col-md-6 py-20">
                            <input type="email" class="form-control email hide" placeholder="Email" name="closing_information_email">
                        </div>
                        <div class="col-md-12 py-20">
                            <input type="text" class="form-control specify_other hide" placeholder="Specify other..." name="closing_information_type_value">
                        </div>
                        <div class="col-md-12 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 100px; max-width: 120px">LO Name:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="LO Name" name="lo_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 100px; max-width: 120px">LO Number:</span>
                                </div>
                                <input type="text" class="form-control" aria-label="LO Number" name="lo_number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 100px; max-width: 120px">LO Email:</span>
                                </div>
                                <input type="email" class="form-control" aria-label="LO Email" name="lo_email">
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
            </div>        
        </div>
      <div class="modal-footer">
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Close</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary btn-lg btn-block create_order">Create Order</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>