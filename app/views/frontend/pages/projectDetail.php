<?php require INC_FRONTEND . "/header.php"; ?>

<?php require INC_FRONTEND . "/navbar.php"; ?>
<hr>
<div class="container col-12" style="padding:0 ;">
    <dv class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div >
                        <br>
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <?php
                            $images = explode(" ", $data["building"]["auxiliary_images"]);
                            $imageNumber = count($images) + 1; // 1 -> plus the main image
                            ?>
                            <ol class="carousel-indicators">
                                <?php for ($i = 0; $i < $imageNumber; $i++) : ?>
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" <?= $i == 0 ? ' class="active" ' : ''; ?>></li>
                                <?php endfor ?>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?= UP2 . "/" . $data["building"]["main_image"] ?>" alt="First slide" style="height:50rem" />
                                </div>
                                <?php foreach ($images as $image) : ?>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?= UP2 . "/" . $image ?>" alt="Second slide" style="height:50rem" />
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
                <div class="details col-md-6">
                    <br>
                    <h3 class="product-title">Project Description</h3>
                    <br>
                    <p class="product-description"><?= $data["building"]["description"] ?>.</p>
                    <br>
                    <h3 class="product-title">Details</h3>
                    <br>
                    <h4 class="">
                        <b>Project</b>: <span><?= $data["building"]["title"] ?></span>
                        <hr>
                    </h4>
                    <h4 class="">
                        <b>Location</b>: <span><?= $data["building"]["location"] ?></span>
                        <hr>
                    </h4>
                    <h4 class="">
                        <b>Area</b>: <span><?= $data["building"]["area"] ?></span>
                        <hr>
                    </h4>
                    <h4 class="">
                        <b>Price</b>: <span><?= $data["building"]["budget"] ?></span>
                        <hr>
                    </h4>
                    <h4 class="">
                        <b>Year</b>: <span><?= $data["building"]["year"] ?></span>
                        <hr>
                    </h4>
                </div>
            </div>
        </div>
        
    </dv>
</div>

<!-- Project Details Area End Here -->
<?php require INC_FRONTEND . "/footer.php"; ?>