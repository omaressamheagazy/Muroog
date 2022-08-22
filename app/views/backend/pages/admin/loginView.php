<?php

use App\Helpers\Enums\MessagesName;
use App\Helpers\MessageReporting;

 require INC_BACKEND. '/header.php';?>
<section class="vh-100">
	<center>
		<h1><?= $data["title"] ?></h1>
	</center>
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src= "<?=IMG_BACKEND ?>/b1.jpg"class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <?php MessageReporting::flash(MessagesName::PASSWORD) ?>
        <form action="/admin/login" method="POST">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form1Example13" class="form-control form-control-lg" name="email" value="<?= $data["email"] ?>" required />
            <label class="form-label" for="form1Example13" >Email address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" value="<?= $data["password"] ?>"  required/>
            <label class="form-label" for="form1Example23" >Password</label>
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
            <a href="/reset">Forgot password?</a>
          </div>
          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
        </form>
      </div>
    </div>
  </div>
</section>
<?php require INC_BACKEND . '/footer.php'?>
