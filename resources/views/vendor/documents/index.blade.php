@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ route('uploadDocuments') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h3>Documents</h3> 
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-submit btn-block">Update</button>
                        </div>
                    </div>
                </div>

                <div class="progress hide">
                    <div class="bar"></div >
                    <div class="percent">0%</div >
                </div>

                <div class="card-body">

                    <div class="row">
                        @foreach ($documents as $file)
                            <div class="col-md-6" style="padding: 15px;">
                                <i class="fal fa-file-{{ $icons[pathinfo($file->document, PATHINFO_EXTENSION)] }} fa-2x"></i>
                                <a href="{{ URL::to('/') }}/images/{{$file->document}}">{{$file->document}}</a>
                            </div>
                            <div class="col-md-6" style="padding: 15px;">
                                @if (strpos($file->document, 'OTHER_DOCUMENT') == false)
                                    Date exp: {{ $file->date_exp }}
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->id }}">

                    <div class="card card-default">
                        <div class="card-header">Notary License</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="file">Notary License File</label>
                                    <input type="file" name="notary_license" id="notary_license" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="file">Expiration date</label>
                                    <input type="date" name="notary_license_date" id="notary_license_date" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card card-default">
                        <div class="card-header">E&O</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="file">E&O File</label>
                                    <input type="file" name="e_and_o" id="e_and_o" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label for="file">E&O Amount</label>
                                    <input type="number" name="e_and_o_amount" id="e_and_o_amount" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label for="file">Expiration date</label>
                                    <input type="date" name="e_and_o_date" id="e_and_o_date" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="card card-default">
                        <div class="card-header">Background Check</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="file">Background Check File</label>
                                    <input type="file" name="background_check" id="background_check" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="file">Expiration date</label>
                                    <input type="date" name="background_check_date" id="background_check_date" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="card card-default">
                        <div class="card-header">NNA Certification</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="file">NNA Certification File</label>
                                    <input type="file" name="nna_certification" id="nna_certification" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="file">Expiration date</label>
                                    <input type="date" name="nna_certification_date" id="nna_certification_date" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="card card-default">
                        <div class="card-header">State Title License</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="file">State Title License File</label>
                                    <input type="file" name="state_title_license" id="state_title_license" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="file">Expiration date</label>
                                    <input type="date" name="state_title_license_date" id="state_title_license_date" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>  
                    <div class="card card-default">
                        <div class="card-header">Other documents</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="file">NOTE: Hold down CTRL while selecting more than one document</label>
                                    <input type="file" multiple name="other_document[]" id="other_document" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </br> 
                </form>                          
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 
    function validate(formData, jqForm, options) {
        var form = jqForm[0];
        /*if (!form.image[].value) {
            alert('File not found');
            return false;
        }*/
    }
 
    (function() {
 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
    $('.progress').addClass('hide').removeClass('show'); 
 
    $('form').ajaxForm({
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
</script>

<style>
        .hide { display: none; }
        .show { display: block; }
        .progress { position:relative; width:90%; margin-left: 5%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; margin-top: 15px; height: 30px;}
        .bar { background-color: #B4F5B4; width:0%; height:30px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:15px; left:48%; color: #7F98B2; }
</style>
@endsection
