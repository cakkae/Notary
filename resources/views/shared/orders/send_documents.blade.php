<!-- Send Document Email -->
<div class="modal fade" id="sendDocumentEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-send-email">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">SEND EMAIL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="inputOrder form-control" name="order">
                            <input type="email" class="inputEmail form-control" name="email">
                            <input type="email" class="form-control" name="email2">
                            <?php 
                                $order_documents = \App\Models\OrderDocuments::where('order_id', '1')->get();
                                $array_documents = [];
                                foreach($order_documents as $key => $order) {
                                    $array_documents[$key] = $order->name;
                                ?>
                                    <input type="hidden" name="files[]" class="file form-control" value="{{ $array_documents[$key] }}"/>
                                <?php }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    <button id="submit" type="submit" class="btn btn-info">SEND EMAIL</button>
                </div>
            </div>
        </form>
    </div>
</div>