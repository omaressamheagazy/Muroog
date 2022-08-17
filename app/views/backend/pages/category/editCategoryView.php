<?php

use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;

 include INC_BACKEND . "/header.php";?>
<?php include INC_BACKEND . "/navbar.php";?>
<?php include INC_BACKEND . "/sidebar.php";?>
<section class="order-form my-4 mx-4 d-flex justify-content-center mx-auto  " style=" max-width:60%; ">
  <div class="container pt-4 " style="margin-top: 100px;">
    <h1>
      <?=$data["pageTitle"]?>
    </h1>
    <div class="row">
      <?php MessageReporting::alertAllMessages($data["error"], MessageType::FAIL) ?>
      <form action="/admin/category/update"  method="POST">
        <div class="form-group mb-4">
          <label for="categoryInput">Category</label>
          <input type="hidden" name="id" value="<?=$data["category"]["id"] ?? ""?>">
          <input type="text" class="form-control" id="categoryInput" aria-describedby="emailHelp"placeholder="Enter Category" required name="title" value="<?=$data["category"]["title"] ?? ""?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
</section>
<?php include INC_BACKEND . "/footer.php"?>
