<?php

use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;

include INC_BACKEND . "/header.php";?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
    .form-gap {
        padding-top: 70px;
    }
</style>
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">
                            <?php MessageReporting::alertAllMessages($data["error"], MessageType::FAIL)?>
                            <?php MessageReporting::alertAllMessages($data["success"], MessageType::SUCCESS)?>

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="/reset">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" type="email" placeholder="email address" class="form-control" type="email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>
                                <a href="/admin/login">Login</a>
                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include INC_BACKEND . "/footer.php";
