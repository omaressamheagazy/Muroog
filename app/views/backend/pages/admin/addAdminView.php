<?php

use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;

 include INC_BACKEND . "/header.php"; ?>
<?php include INC_BACKEND . "/navbar.php"; ?>
<?php include INC_BACKEND . "/sidebar.php"; ?>
<br>
<section class="order-form my-4 mx-4 d-flex justify-content-center" style="margin-left: 100px">
    <div class="container pt-4 addBuilding">

        <div class="row">
            <div class="col-12">
                <br>
                <h1><?= $data["title"] ?></h1>
                <hr class="mt-1" />
            </div>
            <div class="col-12">
        <?php MessageReporting::alertAllMessages($data["error"], MessageType::FAIL)?>
        <?php MessageReporting::flash(MessagesName::ERROR, class:MessageType::FAIL) ?>
                <form action="/admin/add" method="POST">
                    <div class="row mx-4">
                        <div class="col-12 mb-2">
                            <br>
                        </div>
                        <div class="col-12 col-sm-6">
                            <input class="order-form-input" placeholder="Full Name" name="name" required />
                        </div>
                        <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                            <input class="order-form-input" type="email" placeholder="Email" name="email" required />
                        </div>
                    </div>
                    <div class="row mx-4">
                        <div class="col-12 mb-2">
                            <br>
                        </div>
                        <div class="col-12 col-sm-6">
                            <input class="order-form-input" type="text" placeholder="phone number" name="phone" />
                        </div>
                        <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                            <select class="form-select" aria-label="Default select example" name="role" required>
                                <option value="">Role</option>
                                <option value="2">Super Admin</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mx-4">
                        <div class="col-12 mb-2">
                            <br>
                        </div>
                        <div class="col-12 col-sm-6">
                            <input class="order-form-input" type="password" placeholder="password" name="password" />
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" id="btnSubmit" class="btn btn-dark d-block mx-auto btn-submit">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include INC_BACKEND . "/footer.php" ?>