<?php require INC_FRONTEND . "/header.php";?>
<!-- <?php require INC_FRONTEND . "/navbar.php";?> -->          
            <!-- Header Area End Here -->
            <!-- Inner Page Banner Area Start Here -->
            <section id="header-area-space" class="inner-page-banner-area add-top-margin" style="background-image: url('<?= IMG_FRONTEND ?>/banner/inner-banner.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="breadcrumbs-area area-left text-center--sm">
                                <h1>Our projects</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Inner Page Banner Area End Here -->
            <!-- Project Area Start Here -->
            <section class="section-space-default-less30 bg-light">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="isotope-classes-tab isotop-btn">
                            <a href="#" data-filter="*" class="current">All</a>
                            <a href="#" data-filter=".business">Business</a>
                            <a href="#" data-filter=".corporate">Corporate</a>
                            <a href="#" data-filter=".construction">Construction</a>
                            <a href="#" data-filter=".design">Design</a>
                        </div>
                    </div>
                    <div class="row zoom-gallery">
                        <?php foreach($data["building"] as $building): ?>
                        <?php 
                        if(!empty($building["auxiliary_images"]))
                        $images = explode(" ", $building["auxiliary_images"]);  
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="project-layout4">
                                <div class="item-img">
                                    <img src="<?=UP2 . "/" . $building["main_image"]?>" alt="service" style="height: 250px;">
                                    <div class="item-mask-content">
                                        <!-- <?php if(!empty($images)): ?>
                                            <?php foreach($images as $image): ?> 
                                        <a href="<?=UP2 . "/" . $image ?>" class="elv-zoom item-icon" data-fancybox-group="gallery" title="Title Here">
                                            <i class="fa fa-link" aria-hidden="true"></i>
                                        </a>
                                            <?php endforeach ?>
                                        <?php endif ?> -->
                                        <div class="project-sub-title-light"><?= $building["category"] ?></div>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h3 class="project-title-dark">
                                        <a href="single-project.html"><?= $building["title"] ?></a>
                                    </h3>
                                    <p><?= $building["location"] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>



                        
                    </div>
                    <ul class="pagination-layout1">
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                    </ul>
                </div>
            </section>
            <!-- Project Area End Here -->
<?php require INC_FRONTEND . "/footer.php"; ?>
