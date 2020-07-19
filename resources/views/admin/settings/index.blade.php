@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Settings</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form>
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->id }}">
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>From email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php if(isset($settings->from_email)) echo $settings->from_email; else echo '';?>" class="form-control from_email" name="from_email" placeholder="From email...">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>From name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php if(isset($settings->from_name)) echo $settings->from_name; else echo '';?>" class="form-control from_name" name="from_name" placeholder="From name...">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>Mailer</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control mailer" name="mailer">
                                            <option selected>Choose mailer</option>
                                            <option <?php if( isset($settings->mailer) && $settings->mailer == 'SMTP') echo 'selected="selected"'; else echo  '';?>>SMTP</option>
                                            <option <?php if( isset($settings->mailer) && $settings->mailer == 'IMAP') echo 'selected="selected"'; else echo  '';?>>IMAP</option>
                                            <option <?php if( isset($settings->mailer) && $settings->mailer == 'POP3') echo 'selected="selected"'; else echo  '';?>>POP3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>Host</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php if(isset($settings->host)) echo $settings->host; else echo '';?>" class="form-control host" name="host" placeholder="Host...">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>Port*</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php if(isset($settings->port)) echo $settings->port; else echo '';?>" class="form-control port" name="port" placeholder="Port...">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>Security email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control security_email" name="security_email">
                                            <option>Choose security</option>
                                            <option <?php if( isset($settings->mailer) && $settings->security_email == 'SSL/TLS') echo 'selected="selected"'; else echo  '';?>>SSL/TLS</option>
                                            <option <?php if( isset($settings->mailer) && $settings->security_email == 'STARTTLS') echo 'selected="selected"'; else echo  '';?>>STARTTLS</option>
                                            <option <?php if( isset($settings->mailer) && $settings->security_email == '') echo 'selected="selected"'; else echo  '';?>>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php if(!empty($settings->username)) echo $settings->username; else echo '';?>" class="form-control username" name="username" placeholder="Username...">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-3">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" value="<?php if(isset($settings->password)) echo $settings->password; else echo '';?>" class="form-control password" name="password" placeholder="Password...">
                                    </div>
                                </div>
                                <div class="row py-20">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-submit btn-block">UPDATE</button>
                                    </div>
                                </div>
                            </form>

                            <form>
                                {{ csrf_field() }}
                                <div class="row py-20">
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-block btn_send_test_mail">SEND TEST MAIL</button>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
.py-20 {
    margin-top: 20px;
}
</style>

<script type="text/javascript">
    $('document').ready(function () {

        $(".btn-submit").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var user_id = $("input[name='user_id']").val();

            var from_email = $(".from_email").val();
            var from_name = $(".from_name").val();
            var mailer = $(".mailer").val();
            var host = $(".host").val();
            var port = $(".port").val();
            var security_email = $(".security_email").val();
            var username = $(".username").val();
            var password = $(".password").val();

            $.ajax({
                url: "{{ route('updateSettings') }}",
                type:'POST',
                data: {
                    _token:_token, 
                    user_id:user_id, 
                    from_email:from_email,
                    from_name:from_name,
                    mailer:mailer,
                    host:host,
                    port:port,
                    security_email:security_email,
                    username:username,
                    password:password
                },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                    }else{
                        toastr.error(data.error);
                    }
                }
            });
       
        }); 

        $(".btn_send_test_mail").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var user_id = $("input[name='user_id']").val();
            var from_email = $(".from_email").val();

            $.ajax({
                url: "{{ route('sendTestEmail') }}",
                type:'POST',
                data: {
                    _token:_token, 
                    user_id:user_id, 
                    email:from_email
                },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        toastr.success(data.success);
                    }else{
                        toastr.error(data.error);
                    }
                }
            });
       
        }); 
       
    });
</script>
@endsection
