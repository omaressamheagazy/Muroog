        <div id="wrapper">
            <!-- Header Area Start Here -->
            <header>
                <div id="header-one" class="header-area header-fixed header-style-one">
                    <div class="header-top-bar bg-dark">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 ">
                                    <div class="header-address-textprimary">
                                        <ul>
                                            <li>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>Al Jami Al, Ghala, Muscat, Oman
                                            </li>
                                            <li>
                                                <i class="fa fa-phone" aria-hidden="true"></i>+968 99491497
                                            </li>
                                            <li>
                                                <i class="fa-solid fa-envelope" aria-hidden="true"></i></i>muroogconsultant@gmail.com
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="header-social-textprimary">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-linkedin"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main-menu-area bg-light" id="sticker" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="container container-fluid-sm">
                            <div class="row no-gutters d-flex align-items-center">
                                <div class="col-lg-3 col-md-3">
                                    <div class="logo-area">
                                        <a href="index.html" class="logo-dark">
                                            <img src="<?= IMG_FRONTEND ?>/logo2.png" alt="logo" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 possition-static">
                                    <div class="builder-main-menu">
                                        <nav id="dropdown">
                                            <ul>
                                                <li class="<?= $data["active"] == 'home' ? 'active' : '' ?>">
                                                    <a href="/">Home</a>
                                                </li>
                                                <li class="<?= $data["active"] == 'about' ? 'active' : '' ?>">
                                                    <a href="/about">About</a>
                                                </li>
                                                <li class="<?= $data["active"] == 'service' ? 'active' : '' ?>">
                                                    <a href="/service">Services</a>
                                                </li>
                                                <li class="<?= $data["active"] == 'project' ? 'active' : '' ?>">
                                                    <a href="/project">Projects</a>
                                                </li>
                                                <li class="<?= $data["active"] == 'contact' ? 'active' : '' ?>">
                                                    <a href="/contact">Contact</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </header>
            <!-- Header Area End Here -->