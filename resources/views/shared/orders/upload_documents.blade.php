<!-- Upload Documents Modal -->
<div class="modal fade" id="uploadDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Documents Upload to order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="progress hide">
                    <div class="bar"></div >
                    <div class="percent">0%</div >
                </div>
            </div>
        </div>
        <form method="post" id="uploadDocumentsForm" action="{{ route('add_document_order') }}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 py-20">
                    {{ csrf_field() }}
                    <input type="hidden" name="document_order_id" id="uploaded_documents_order_id">
                    <div>
                        <table class="table table-responsive" id="uploaded_documents_list">
                            <thead>
                                <tr>
                                    <th class="center">Name</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <label for="file">NOTE: Hold down CTRL while selecting more than one document</label>
                    <input type="file" multiple name="order_document[]" id="order_document" class="form-control" />
                </div>
                <div class="col-md-6 py-20">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
                <div class="col-md-6 py-20">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#sendDocumentEmail">Send</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>