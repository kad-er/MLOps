<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MLOps - Face & gender detection page</title>
  <meta content="MLOps is a website which propose test Machine learning based solutions such skin segmentation, object detections , face and gender detection" name="description">
  <meta content="MLops,Machine learning,ML,skin segmentation,YOLO v5,YOLO,CVLIB,Cvlib,object detection,face detection,gender detection" name="keywords">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="language" content="English">
  <meta name="robots" content="index, follow">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Moderna - v2.2.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container">

      <div class="logo float-left">
        <!--h1 class="text-light"><a href="index.html"><span>MlOPS</span></a></h1-->
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        <a href="index"><img src="assets/img/logo.png" alt="" class="img-fluid" style="max-height: 50px"></a>
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li><a href="index">Homepage</a></li>
          <li ><a href="about">About</a></li>
          <li class="active"><a href="services">Services</a></li>
          <li><a href="contact">Contact us</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Treatment of facial and gender images</h2>
          <ol>
            <li><a href="index">Homepage</a></li>
            <li>Treatment of facial and gender images</li>
            <li></li>
          </ol>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
      <div class="container">

        <div class="panel panel-primary">

            <div class="panel-body">
      
              @if ($message = Session::get('successFAGD'))
              <div class="row mb-5">
                <div class="alert alert-success alert-block col-md-12" style="width: 100%">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div><br>
              </div>
              <div class="cold-md-12">
                <div class="col-md-6" >
                  
                  <img src="/{{ Session::get('imageFAGD') }}?={{Date('U')}}" style="width: 450px">

                </div>
                <div class="col-md-6 mx-auto my-auto" style="float: left;" >
                  <a href="{{URL::to('/')}}/{{Session::get('imageFAGD')}}?={{Date('U')}}" target="_blank">
                      <button class="btn btn-primary"><i class="fa fa-download"></i> Download File</button>
                  </a>
                </div>
              </div>
              <br/> <br/>
              @endif

              @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
              <br/><br/>
             @endif
            </div>
          </div>
      <div class="row col-md-12">
    
        <div class="col-md-12">
            
        
                <form action="{{ route('traitement.image.detection.genre.visage.post') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                      
                      <div class="form-check col-md-12 mx-3">
                        <input class="form-check-input" type="radio" name="radio" id="radio1" value="detect_face" checked>
                        <label class="form-check-label" for="radio1">
                          Face detection
                        </label>
                      </div>
                      <div class="form-check col-md-12 mx-3">
                        <input class="form-check-input" type="radio" name="radio" id="radio2" value="detect_gender">
                        <label class="form-check-label" for="radio2">
                          Gender detection
                        </label>
                      </div>
                        <div class="col-md-6 "" >
                            <input type="file" name="image" class="form-control">
                        </div>
        
                        <div class="col-md">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
        
                    </div>
                </form>
        
            </div>    
          </div>
              
        
            
      </div>
    </section><!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    <!-- End Facts Section -->

    <!-- ======= Our Skills Section ======= -->
    <section class="service-details" data-aos="fade-up">
      

        <div class="section-title">
          <h2>Try other services</h2>
          
        </div>
        <div class="container">
          
        
        <div class="row">
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/service-details-2.jpg" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="traitement-image-detection-objet">Treatment of images and videos Detection of objects</a></h5>
              <p class="card-text">You want to analyze your images or your surveillance videos? This tool is exactly what you need</p>
              <div class="read-more"><a href="traitement-image-detection-objet"><i class="icofont-arrow-right"></i> Discover the service</a></div>
            </div>
          </div>

        </div>
        <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/service-details-3.jpg" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="traitement-image-medicale">Medical image processing</a></h5>
              <p class="card-text">Through this module you will be able to treat your medical image</p>
              <div class="read-more"><a href="traitement-image-medicale"><i class="icofont-arrow-right"></i> Discover the service</a></div>
            </div>
          </div>
        </div>
        </div>
      </div>
              
              
              
              
            

      </div>
    </section><!-- End Our Skills Section -->

    <!-- ======= Tetstimonials Section ======= -->
    <!-- End Ttstimonials Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

    <!--div class="footer-newsletter">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div-->

    <div class="footer-top" >
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Quick access</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index">Homepage</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about">About</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="services">Our services</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="traitement-image-medicale">Medical image processing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="traitement-image-detection-genre-&-visage">Treatment of facial and gender images</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="traitement-image-detection-objet">Treatment of images and videos Detection of objects</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact us</h4>
            <p>
              Campus Targa Ouzemmour <br>
              Targa Ouzemmour<br>
              Bejaia, Algeria <br><br>
              <strong>Phone:</strong> +213 793 91 16 52<br>
              <strong>Email:</strong> bejaia.etudiant3@gmail.com<br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>About Us</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright {{date('Y')}} <strong><span>MlOPS</span></strong>. All Rights Reserved
      </div>
      
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>