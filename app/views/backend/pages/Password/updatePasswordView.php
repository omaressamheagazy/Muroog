<?php

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
                        <h2 class="text-center">Update Password</h2>
                        <div class="panel-body">
                            <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="/reset/update">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-lock"></i></span>
                                        <input id="email" name="password" type="password" placeholder="email address" class="form-control" type="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Update" type="submit">
                                </div>
                                <input type="hidden" name="code" value="<?= $data["code"] ?>">
                                <a href="/admin/login">Login</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include INC_BACKEND . "/footer.php";
