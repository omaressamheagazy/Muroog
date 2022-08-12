<?php include INC . "/header.php";?>
<?php include INC . "/navbar.php";?>
<?php include INC . "/sidebar.php";?>
<section class="order-form my-4 mx-4 d-flex justify-content-center" style="margin-left: 100px">
  <div class="container pt-4 addBuilding">
    <div class="row">
      <div class="col-12">
        <h1>Add Building</h1>
        <hr class="mt-1" />
      </div>
      <div class="col-12">
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <label class="order-form-label">Name</label>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="Title" />
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <input class="order-form-input" placeholder="client" />
          </div>
        </div>
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <label class="order-form-label">Name</label>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="scope" />
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <input class="order-form-input" placeholder="budget" />
          </div>
        </div>
        <div class="row mx-4">
          <div class="col-12 mb-2">
            <label class="order-form-label">Name</label>
          </div>
          <div class="col-12 col-sm-6">
            <input class="order-form-input" placeholder="area" />
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
            <select class="form-select form-select-sm" id="year"></select>
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="col-12">
            <label class="order-form-label">Adress</label>
          </div>
          <div class="col-12 col-sm-6 mt-2 pl-sm-0">
            <select class="form-select" aria-label="Default select example">
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="col-12 col-sm-6 mt-2 pr-sm-2">
            <select class="form-select" aria-label="Default select example">
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>

          <div class="row mx-4">
          <div class="col-12 mb-2">
          </div>
          <div class="col-12 col-sm-6">
            <div>
                <label for="formFile" class="form-label">Main image</label>
            </div>
            <input class="form-control" type="file" id="formFile" name="file" value="">
          </div>
          <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                        <div>
                <label for="formFile" class="form-label">Auxiliary images</label>
            </div>
            <input class="form-control" type="file" id="formFile" name="file" value="" multiple >
          </div>
        </div>

        <div class="row mt-3 mx-4">
          <div class="col-12">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="validation" id="validation" value="1" />
              <label for="validation" class="form-check-label">Make it one of the latest projects</label>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-12">
            <button type="button" id="btnSubmit" class="btn btn-dark d-block mx-auto btn-submit">
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include INC . "/footer.php"?>
