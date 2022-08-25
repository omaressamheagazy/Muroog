<?php

use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;

 require INC_FRONTEND . "/header.php"; ?>
<?php require INC_FRONTEND . "/navbar.php"; ?>

<!-- Contact Area Start Here -->
<section class="section-space-less30 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 mb-30">
                <div class="contact-info-area">
                    <br>
                    <h2 class="section-title-dark text-left title-bar-primary">Company Information</h2>
                    <br>
                    <p>Rimply dummy text of the printing and typesetting industry.Ipsum has been the industry's
                        standard dummy text ever since thwhen an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five centuries.
                    </p>
                    <ul class="company-information">
                        <li>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>PO Box 16122 Collins Street West Victoria 8007 Australia
                        </li>
                        <li>
                            <i class="fa fa-phone" aria-hidden="true"></i>+61 3 8376 6284
                        </li>
                        <li>
                            <i class="fa fa-fax" aria-hidden="true"></i>+61 3 8376 6284
                        </li>
                        <li>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>info@example.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 mb-30">
                <div class="contact-form-area">
                    <br>
                    <h2 class="section-title-dark text-left title-bar-primary">Send Us Message</h2>
                    <br>
                    <?php MessageReporting::alertAllMessages($data["error"], MessageType::FAIL); ?>
                    <br>
                    <form name="contactForm" id="contact_form" method="POST" action="/contact">
                        <div class="row gutters-15">
                            <div class="col-md-6 col-12 form-group">
                                <input type="text" placeholder="Name *" class="form-control" name="name">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-6 col-12 form-group">
                                <input type="text" placeholder="E-mail *" class="form-control" name="email" ">
                                <div class=" help-block with-errors">
                            </div>
                        </div>
                        <div class="col-md-12 col-12 form-group">
                            <input type="text" placeholder="Subject *" class="form-control" name="subject"="">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-12 form-group">
                            <textarea placeholder="Body *" class="textarea form-control" name="body" id="form-message" rows="7" cols="20"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-12 form-group">
                            <button type="submit" class="fill-btn">Send Now</button>
                        </div>
                </div>
                <div class="form-response"></div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Contact Area End Here -->
<!-- Google Map Area Start Here -->
<div class="embed-responsive embed-responsive-21by9" style="height:50vh ;">
    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.6103593785774!2d58.368612500000005!3d23.582433599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e8e01ab34d1730d%3A0x8f261fdcb405d634!2sThe%20Omani%20Society%20For%20Arts!5e0!3m2!1sen!2som!4v1660935303248!5m2!1sen!2som" loading="lazy"></iframe>
</div>
<!-- Google Map Area End Here -->


<?php require INC_FRONTEND . "/footer.php"; ?>