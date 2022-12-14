<?php

use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;

 include INC_BACKEND . "/header.php"; ?>
<?php include INC_BACKEND . "/navbar.php"; ?>
<?php include INC_BACKEND . "/sidebar.php"; ?>

<section class="order-form my-4 mx-4 d-flex justify-content-center" style="margin-left: 100px">
  <div class="container pt-4 addBuilding">
    
    <div class="row">
      <div class="col-12">
        <?php MessageReporting::flash(MessagesName::ERROR) ?>
        <h1><?= $data["Pagetitle"]?></h1>
        <hr class="mt-1" />
      </div>      
      <div class="col-12">
        <form action="/admin/building/add" method="POST" enctype="multipart/form-data">
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <br>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="Title" name="title" required />
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <input class="order-form-input" placeholder="client" name="client" />
          </div>
        </div>
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <br>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="scope" name="scope" />
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <input class="order-form-input" placeholder="budget" name="budget" />
          </div>
        </div>
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <br>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="area" name="area" />
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <select class="form-select form-select-sm" id="year" name="year"></select>
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="col-12 col-sm-6 mt-2 pl-sm-0">
            <select class="form-select" aria-label="Default select example" name="category_id" required>
              <option  value="">Category</option>
              <?php foreach($data["category"] as $category): ?>
                <option  value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-12 col-sm-6 mt-2 pr-sm-2">
            <select class="form-select" aria-label="Default select example" name="location_id" required>
              <option  value="">Location</option>
              <?php foreach ($data["location"] as $location): ?>
                <option value="<?=$location["id"]?>"><?=$location["title"]?></option>
              <?php endforeach?>
            </select>
          </div>
        </div>

          <div class="row mx-4">
          <div class="col-12 mb-2">
          </div>
          <div class="col-12 col-sm-6">
            <div>
              <b>
                <label for="formFile" class="form-label">Main image</label>
              </b>
            </div>
            <input class="form-control" type="file" id="formFile" name="main_image" value="">
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <div>
              <b>
                <label for="formFile" class="form-label">Auxiliary images</label>
              </b>
            </div>
            <input class="form-control" type="file" id="formFile" name="file[]" value="" multiple >
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="col-12">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="latest_project" id="validation"  />
              <label for="validation" class="form-check-label">Make it one of the latest projects</label>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <button type="submit" id="btnSubmit" class="btn btn-dark d-block mx-auto btn-submit">
              Submit
            </button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
  window.onload = function () {
let year_satart = 2000;
    let year_end = (new Date).getFullYear(); // current year
    let year_selected = "Year";

    let option = '';
    option = '<option>Year</option>'; // first option

    for (let i = year_satart; i <= year_end; i++) {
        let selected = (i === year_selected ? ' selected' : '');
        option += '<option value="' + i + '"' + selected + '>' + i + '</option>';
    }
    document.getElementById("year").innerHTML = option;
};
</script>
<?php include INC_BACKEND . "/footer.php"?>
