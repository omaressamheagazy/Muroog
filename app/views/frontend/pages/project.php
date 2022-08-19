<?php require INC_FRONTEND . "/header.php";?>
<!-- <?php require INC_FRONTEND . "/navbar.php";?> --

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
            <section class="section-space-equal bg-light">
                <div class="container" id="isotope-container">
                    <div class="row">
                        <!-- Categories -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="isotope-classes-tab isotop-btn">
                                    <a href="#" data-filter="*" class="current">All</a>
                                <?php foreach($data["category"] as $category): ?>
                                    <a href="#" data-filter=".<?= $category["title"] ?>"><?= $category["title"] ?></a>
                                <?php endforeach; ?>
                                </div>
                            </div>
                    </div>
                    <!-- projects -->
                    <div class="row no-gutters zoom-gallery featuredContainer">

                        <?php foreach($data["building"] as $building): ?>
                        <?php 
                        if(!empty($building["auxiliary_images"]))
                        $images = explode(" ", $building["auxiliary_images"]);  
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 <?= $building["category"] ?> construction">
                            <div class="project-layout1">
                                        <a href="/project/<?= $building["id"] ?>" class=" item-icon-bottom-center" style="background-color:transparent;  width:50%; top:30%">
                                            <span class="project-title">
                                                <?= $building["title"] ?>
                                            </span> 
                                        </a>
                                        <a href="/project/<?= $building["id"] ?>" class=" item-icon-bottom-center" style="background-color:transparent; border:1px solid #3a6cf4; width:30%; ">
                                            <span style="color: white; font-size: small; font-weight:700">
                                                View Project
                                            </span> 
                                        </a>
                                <img src="<?=UP2 . "/" . $building["main_image"]?>" class="img-fluid" alt="project" style="height: 350px ;">
                            </div>
                        </div>
                        <?php endforeach ?>




                    </div>
                </div>
            </section>
            <!-- Project Area End Here -->
            <?php require INC_FRONTEND . "/footer.php"; ?>
