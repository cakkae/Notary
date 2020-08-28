<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col-md-4 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Order #</span>
                                </div>
                                <input type="text" class="form-control edit_order_id" aria-label="Order#" name="order_id">
                            </div>
                        </div>
                        <div class="col-md-4 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Loan #</span>
                                </div>
                                <input type="text" class="form-control edit_loan_id" aria-label="Loan#" name="loan_id">
                            </div>
                        </div>
                        <div class="col-md-4 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">File #</span>
                                </div>
                                <input type="text" class="form-control edit_file_id" aria-label="File#" name="file_id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Notary Availability</th>
                                        <th>Notary Name</th>
                                        <th>Notary Phone Number</th>
                                        <th>Notary City</th>
                                        <th>Notary Distance</th>
                                        <th>Notary Fee</th>
                                        <th>Select Notary</th>
                                        <th>Show Details</th>
                                    </tr>
                                    <tbody>
                                        @forelse($vendors as $vendor)
                                        <tr>
                                            <td style="text-align: center;" class="notaryAvailability" data-email="{{ $vendor->email }}"><i class="fal fa-inbox-out fa-2x"></i></td>
                                            <td>{{ $vendor->name }}</td>
                                            <td>{{ $vendor->lastName }}</td>
                                            <td>{{ $vendor->email }}</td>
                                            <td>432 km</td>
                                            <td>40</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn_select_notary btn-block"
                                                data-vendor_first_name="{{ $vendor->name }}"
                                                data-vendor_last_name="{{ $vendor->lastName }}"
                                                data-vendor_address="{{ $vendor->name }}"
                                                data-vendor_city="{{ $vendor->name }}"
                                                data-vendor_state="{{ $vendor->name }}"
                                                data-vendor_zip_code="{{ $vendor->name }}"
                                                data-vendor_phone_number="{{ $vendor->name }}"
                                                data-vendor_email="{{ $vendor->email }}"
                                                data-vendor_fee="{{ $vendor->name }}"
                                                data-vendor_additional_service_fee="{{ $vendor->name }}">SELECT</button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn_notary_details btn-block"
                                                data-vendor_first_name="{{ $vendor->name }}">NOTARY DETAILS</button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center"><h2>No result</h2></td>
                                        </tr>
                                        @endforelse
                                    </tbody>  
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <h4>Notary Info</h4>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Firstname:</label>
                            <input type="text" class="form-control vendor_first_name" name="vendor_first_name">
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Lastname:</label>
                            <input type="text" class="form-control vendor_last_name" name="vendor_last_name">
                        </div>
                        <div class="col-md-12 py-20">
                            <label>Address:</label>
                            <input type="text" class="form-control vendor_address" name="vendor_address">
                        </div>
                        <div class="col-md-4 py-20">
                            <label>City:</label>
                            <input type="text" class="form-control vendor_city" name="vendor_city">
                        </div>
                        <div class="col-md-4 py-20">
                            <label>State:</label>
                            <input type="text" class="form-control vendor_state" name="vendor_state">
                        </div>
                        <div class="col-md-4 py-20">
                            <label>Zip Code:</label>
                            <input type="text" class="form-control vendor_zip_code" name="vendor_zip_code">
                        </div>
                        <div class="col-md-4 py-20">
                            <label>Phone number:</label>
                            <input type="text" class="form-control vendor_phone_number" name="vendor_phone_number">
                        </div>
                        <div class="col-md-4 py-20">
                            <label>Email Address:</label>
                            <input type="text" class="form-control vendor_email" name="vendor_email">
                        </div>
                        <div class="col-md-4 py-20">
                            <label>Fee:</label>
                            <input type="text" class="form-control vendor_fee" name="vendor_fee">
                        </div>
                        <div class="col-md-12 py-20">
                            <label>Additional Service Fee:</label>
                            <input type="text" class="form-control vendor_additional_service_fee" name="vendor_additional_service_fee">
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Property Location</label>
                            <div class="row">
                                <div class="col-md-12 py-20">
                                    <input type="text" class="form-control edit_property_location_street_name" name="property_location_street_name" placeholder="Street name">
                                </div>
                                <div class="col-md-12 py-20">
                                    <input type="text" class="form-control edit_property_location_additional_street_name" name="property_location_additional_street_name" placeholder="Additional Street name">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_property_location_city" name="property_location_city" placeholder="City">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_property_location_state" name="property_location_state" placeholder="State">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_property_location_zip" name="property_location_zip" placeholder="Zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 py-20">
                        <label>Close Location</label>
                            <div class="row">
                                <div class="col-md-12 py-20">
                                    <input type="text" class="form-control edit_close_location_street_name" name="close_location_street_name" placeholder="Street name">
                                </div>
                                <div class="col-md-12 py-20">
                                    <input type="text" class="form-control edit_close_location_additional_street_name" name="close_location_additional_street_name" placeholder="Additional Street name">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_close_location_city" name="close_location_city" placeholder="City">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_close_location_state" name="close_location_state" placeholder="State">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_close_location_zip" name="close_location_zip" placeholder="Zip">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Borrower Name</label>
                            <div class="row">
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_borrower_name" name="borrower_name" placeholder="First name">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_borrower_middle_name" name="borrower_middle_name" placeholder="Middle name">
                                </div>
                                <div class="col-md-4 py-20">
                                    <input type="text" class="form-control edit_borrower_last_name" name="borrower_last_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-12 py-20">
                                    <input type="email" class="form-control edit_borrower_email" name="borrower_email" placeholder="Email">
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
                        <div class="col-md-6 py-20">
                            <label>Contact Number </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 80px; max-width: 120px">Home:</span>
                                </div>
                                <input type="text" class="form-control edit_contact_number_home" aria-label="Home number" name="contact_number_home">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 80px; max-width: 100px">Mobile:</span>
                                </div>
                                <input type="text" class="form-control edit_contact_number_mobile" aria-label="Mobile number" name="contact_number_mobile">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 80px; max-width: 100px">Alt:</span>
                                </div>
                                <input type="text" class="form-control edit_contact_number_alt" aria-label="Alt number" name="contact_number_alt">
                            </div>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Closing Time and Date</label>
                            <input type="datetime-local" class="form-control input-lg edit_closing_time_and_date" name="closing_time_and_date"/>
                        </div>
                        <div class="col-md-12 py-20">
                            <h4>Closing Information</h4>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Closing type</label>
                            <select name="closing_type" class="form-control edit_closing_type">
                                <option selected disabled>Please choose...</option>
                                <option value="0">Application</option>
                                <option value="1">Deed Only</option>
                                <option value="2">Purchase</option>
                                <option value="3">Refinance</option>
                                <option value="4">Reverse</option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 py-20">
                            <label>Fax/Scanbacks</label>
                            <select name="fax_select" class="form-control edit_fax_select">
                                <option value="-1" selected disabled>Please choose...</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6 py-20">
                            <input type="text" class="form-control fax_number hide edit_closing_information_fax" placeholder="Fax number" name="closing_information_fax">
                        </div>
                        <div class="col-md-6 py-20">
                            <input type="email" class="form-control email hide edit_closing_information_email" placeholder="Email" name="closing_information_email">
                        </div>
                        <div class="col-md-12 py-20">
                            <input type="text" class="form-control specify_other hide edit_closing_information_type_value" placeholder="Specify other..." name="closing_information_type_value">
                        </div>
                        <div class="col-md-12 py-20">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 100px; max-width: 120px">LO Name:</span>
                                </div>
                                <input type="text" class="form-control edit_lo_name" aria-label="LO Name" name="lo_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 100px; max-width: 120px">LO Number:</span>
                                </div>
                                <input type="text" class="form-control edit_lo_number" aria-label="LO Number" name="lo_number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 100px; max-width: 120px">LO Email:</span>
                                </div>
                                <input type="email" class="form-control edit_lo_email" aria-label="LO Email" name="lo_email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input edit_lo_info" type="checkbox" name="lo_info" id="lo_info" value="0">
                                    <label class="form-check-label" for="lo_info">
                                        Include LO Info in Notary confirmation
                                    </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input edit_notary_info" type="checkbox" name="notary_info" id="notary_info" value="1">
                                    <label class="form-check-label" for="notary_info">
                                        Send Notary Info to LO
                                    </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Internal notes</label>
                            <textarea class="form-control edit_internal_notes" name="internal_notes"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Special instructions</label>
                            <textarea class="form-control edit_special_instructions" name="special_instructions"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            
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
            <button type="button" class="btn btn-primary btn-lg btn-block create_order">UPDATE ORDER</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>