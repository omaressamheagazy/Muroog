<?php

use App\Helpers\Enums\MessagesName;
use App\Helpers\MessageReporting;

 include INC . "/header.php";?>
<?php include INC . "/navbar.php";?>
<?php include INC . "/sidebar.php";?>
<?php

?>

<section class="order-form my-4 mx-4 d-flex justify-content-center" style="margin-left: 100px">
  <div class="container pt-4 addBuilding">
    <?php MessageReporting::flash(MessagesName::Building)?>
    <div class="row">
      <div class="col-12">
        <h1><?=$data["Pagetitle"]?></h1>
        <hr class="mt-1" />
      </div>

      <div class="col-12" >
        <div class="row mx-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" >
							<?php 
								$images = explode(" ", $data["building"]["auxiliary_images"]);  
								$imageNumber = count($images) + 1; // 1 -> plus the main image
							?>
              <ol class="carousel-indicators">
								<?php for($i=0; $i < $imageNumber ;  $i++): ?>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" <?= $i== 0 ?  ' class="active" ' : '' ;?> ></li>
								<?php endfor ?>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="<?=UP2 . "/" . $data["building"]["main_image"]?>" alt="First slide" style="height:25rem" />
                </div>
                <?php foreach($images as $image): ?>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?=UP2 . "/" . $image?>" alt="Second slide" style="height:25rem" />
                </div>
                <?php endforeach ?>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
      </div>

      <div class="col-12">
        <form action="/admin/building/update" method="POST" enctype="multipart/form-data">
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <br>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="Title" name="title" value="<?= $data["building"]["title"]?>" required />
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <input class="order-form-input" placeholder="client" name="client" value="<?= $data["building"]["client"]?>"/>
          </div>
        </div>
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <br>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="scope" name="scope" value="<?= $data["building"]["scope"]?>"/>
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <input class="order-form-input" placeholder="budget" name="budget" value="<?= $data["building"]["budget"]?>" />
          </div>
        </div>
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <br>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="area" name="area"  value="<?= $data["building"]["area"]?>"/>
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <select class="form-select form-select-sm" id="year" name="year"  ></select>
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">
                <?= $data["building"]["description"]?>
            </textarea>
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="col-12 col-sm-6 mt-2 pl-sm-0">
            <select class="form-select" aria-label="Default select example" name="category_id" required>
              <option  value="">Category</option>
              <?php foreach ($data["category"] as $category): ?>
                <option  value="<?=$category["id"]?>"   <?= $category["id"] == $data["building"]["category_id"] ? ' selected="selected" ' : '' ?>    ><?=$category["title"]?></option>
              <?php endforeach?>
            </select>
          </div>
          <div class="col-12 col-sm-6 mt-2 pr-sm-2">
            <select class="form-select" aria-label="Default select example" name="location_id" required>
              <option  value="">Location</option>
              <?php foreach ($data["location"] as $location): ?>
                <option value="<?=$location["id"]?>" <?= $location["id"] == $data["building"]["location_id"] ? ' selected="selected" ' : '' ?>  ><?=$location["title"]?></option>
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
            <input class="form-control" type="file" id="formFile" name="main_image" value="<?= $data["building"]["main_image"]?>">
						<input type="hidden" name="main_image" value="<?= $data["building"]["main_image"] ?? '' ?>">
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <div>
              <b>
                <label for="formFile" class="form-label">Auxiliary images</label>
              </b>
            </div>
            <input class="form-control" type="file" id="formFile" name="file[]"  multiple >
						<input type="hidden" name="auxiliary_images" value="<?= $data["building"]["auxiliary_images"] ?? '' ?>">
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="col-12">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="latest_project" id="validation"  <?= $data["building"]["latest_project"] !== null ? 'checked' : '' ?> />
              <label for="validation" class="form-check-label" >Make it one of the latest projects</label>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
						<input type="hidden" name="id" value="<?= $data["building"]["id"] ?>">
            <button type="submit" id="btnSubmit" class="btn btn-dark d-block mx-auto btn-submit">
              Update
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
    let year_selected =  <?= json_encode($data["building"]["year"], JSON_HEX_TAG); ?>;
		console.log(year_selected);

    let option = '';
    option = '<option>Year</option>'; // first option

    for (let i = year_satart; i <= year_end; i++) {
        let selected = (i == year_selected ? ' selected' : '');
        option += '<option value="' + i + '"' + selected + '>' + i + '</option>';
    }
    document.getElementById("year").innerHTML = option;
};
</script>
<?php include INC . "/footer.php"?>
