<?php

use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;

 include INC_BACKEND . "/header.php";?>
<?php include INC_BACKEND . "/navbar.php";?>
<?php include INC_BACKEND . "/sidebar.php";?>
<section class="order-form my-4 mx-4 d-flex justify-content-center mx-auto  " style=" max-width:60%; ">
  <div class="container pt-4 " style="margin-top: 100px;">
    <h1>
      <br>
      <?=$data["pageTitle"]?>
    </h1>
    <div class="row">
      <?php MessageReporting::alertAllMessages($data["error"], MessageType::FAIL) ?>
      <form action="/admin/location/update"  method="POST">
        <div class="form-group mb-4">
          <label for="locationInput">Location</label>
          <input type="hidden" name="id" value="<?=$data["location"]["id"] ?? ""?>">
          <input type="text" class="form-control" id="locationInput" aria-describedby="emailHelp"placeholder="Enter location" required name="title" value="<?=$data["location"]["title"] ?? ""?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
</section>
<?php include INC_BACKEND . "/footer.php"?>
