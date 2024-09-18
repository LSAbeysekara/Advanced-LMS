<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukon</title>
    <link rel="shortcut icon" href="assets/images/x-icon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/lightcase.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader ending here -->


    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="icofont-rounded-up"></i></a>
    <!-- scrollToTop ending here -->


    <?php include 'header.php'; ?>

    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Get In Touch With Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    <!-- Map & address us Section Section Starts Here -->
    <div class="map-address-section padding-tb section-bg">
        <div class="container">
            <div class="section-header text-center">
                <span class="subtitle">Get in touch with us</span>
                <h2 class="title">We're Always Eager To Hear From You!</h2>
            </div>
            <div class="section-wrapper">
                <div class="row flex-row-reverse">
                    <div class="col-xl-4 col-lg-5 col-12">
                        <div class="contact-wrapper">
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="assets/images/icon/01.png" alt="CodexCoder">
                                </div>
                                <div class="contact-content">
                                    <h6 class="title">Office Address</h6>
                                    <p>1201 park street, Fifth Avenue</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="assets/images/icon/02.png" alt="CodexCoder">
                                </div>
                                <div class="contact-content">
                                    <h6 class="title">Phone number</h6>
                                    <p>+22698 745 632,02 982 745</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="assets/images/icon/03.png" alt="CodexCoder">
                                </div>
                                <div class="contact-content">
                                    <h6 class="title">Send email </h6>
                                    <a href="mailto:info@gmail.com">adminedukon@gmil.com</a>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-thumb">
                                    <img src="assets/images/icon/04.png" alt="CodexCoder">
                                </div>
                                <div class="contact-content">
                                    <h6 class="title">Our website</h6>
                                    <a href="#">www.adminedukon@gmil.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-12">
                        <div class="map-area">
                            <div class="maps">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.2275990948147!2d90.38698831543141!3d23.739261895117753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b85c740f17d1%3A0xdd3daab8c90eb11f!2sCodexCoder!5e0!3m2!1sen!2sbd!4v1607313671993!5m2!1sen!2sbd" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Map & address us Section Section Ends Here -->

    <!-- Contact us Section Section Starts Here -->
    <div class="contact-section padding-tb">
        <div class="container">
            <div class="section-header text-center">
                <span class="subtitle">Get in touch with Contact us</span>
                <h2 class="title">Fill The Form Below So We Can Get To Know You And Your Needs Better.</h2>
            </div>
            <div class="section-wrapper">
                <form class="contact-form" action="contact.php" id="contact-form" method="POST">
                    <div class="form-group">
                        <input type="text" placeholder="Your Name" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Your Email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Phone" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Subject" id="subject" name="subject" required>
                    </div>
                    <div class="form-group w-100">
                        <textarea name="message" rows="8" id="message" placeholder="Your Message" required></textarea>
                    </div>
                    <div class="form-group w-100 text-center">
                        <button class="lab-btn"><span>Send our Message</span></button>
                    </div>
                </form>
                <p class="form-message"></p> 
            </div>
        </div>
    </div>
    <!-- Contact us Section Section Ends Here -->


    <!-- footer -->
    <div class="news-footer-wrap">
        <div class="fs-shape">
            <img src="assets/images/shape-img/03.png" alt="fst" class="fst-1">
            <img src="assets/images/shape-img/04.png" alt="fst" class="fst-2">
        </div>
        <!-- Newsletter Section Start Here -->
        <div class="news-letter">
            <div class="container">
                <div class="section-wrapper">
                    <div class="news-title">
                        <h3>Want Us To Email You About Special Offers And Updates?</h3>
                    </div>
                    <div class="news-form">
                        <form action="/">
                            <div class="nf-list">
                                <input type="email" name="email" placeholder="Enter Your Email">
                                <input type="submit" name="submit" value="Subscribe Now">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter Section Ending Here -->

        <!-- Footer Section Start Here -->
        <?php include 'footer.php'; ?>
    <!-- footer -->



    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/progress.js"></script>
    <script src="assets/js/lightcase.js"></script>
    <script src="assets/js/counter-up.js"></script>
    <script src="assets/js/isotope.pkgd.js"></script>
    <script src="assets/js/functions.js"></script>
</body>
</html>