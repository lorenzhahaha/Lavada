@extends('layouts.app')

<style type="text/css">
    .viewContent {
          width: 300px;
          height: 300px;
          margin: 10px;
          border: 10px solid #fff;
          float: left;
          overflow: hidden;
          position: relative;
          text-align: center;
          box-shadow: 1px 1px 2px #999;
          cursor: default;
          left: 80px;
          top: 150px;
    }

    .viewContent .mask,
    .viewContent .content {
          width: 300px;
          height: 300px;
          position: absolute;
          overflow: hidden;
          top: 0;
          left: -10px;
    }

    .viewContent img {
          display: block;
          position: relative;
    }

    .viewContent h2 {
          text-transform: uppercase;
          color: #fff;
          text-align: center;
          position: relative;
          font-size: 17px;
          padding: 10px;
          background: rgba(0, 0, 0, 0.8);
          margin: 20px 0 0 0;
    }

    .viewContent p {
          font-family: Georgia, serif;
          font-size: 12px;
          font-style: italic;
          position: relative;
          color: #fff;
          padding: 10px 40px;
    }

    .viewContent a.info {
          display: inline-block;
          text-decoration: none;
          padding: 7px 14px;
          background: #000;
          color: #fff;
          text-transform: uppercase;
          box-shadow: 0 0 1px #000;
    }

    .viewContent a.info:hover {
            box-shadow: 0 0 5px #000;
    }

    .view-first img {
            transition: all 0.2s linear;
    }

    .view-first .mask {
          opacity: 0;
          background-color: rgba(172, 170, 170, 0.8);
          transition: all 0.4s ease-in-out;
    }

    .view-first h2 {
          transform: translateY(-100px);
          opacity: 0;
          transition: all 0.2s ease-in-out;
    }

    .view-first p {
          transform: translateY(100px);
          opacity: 0;
          transition: all 0.2s linear;
    }

    .view-first a.info {
          opacity: 0;
          transition: all 0.2s ease-in-out;
    }

    .view-first:hover img {
        transform: scale(1.1);
    }

    .view-first:hover .mask {
        opacity: 1;
    }

    .view-first:hover h2,
    .view-first:hover p,
    .view-first:hover a.info {
        opacity: 1;
        transform: translate(0px);
    }

    .view-first:hover p {
        transition-delay: 0.1s;
    }

    .view-first:hover a.info {
        transition-delay: 0.2s;
    }

@media (min-width: 1500px) {
  .navbar-align {
      margin-left: 30px !important;
    }
}
</style>
@section('content')

{{-- @if(session()->has('goingCart.content'))
    <script> alert("{{ $product_name }} {!! session('goingCart.content') !!}");</script>
@endif --}}
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-responsive" src="{{ asset('lavada-icon.png') }}" width="300px" height="auto">
                <div class="intro-text">
                    <span class="name">Start Shopping in Lavada</span>
                    <hr class="star-light">
                    <span class="skills">Guaranteed Customer Protection - Shop Endlessly - Experience Quality</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- BEST SELLER -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center margin-100">
                    <h2>BEST-SELLERS</h2>
                    <hr class="star-primary">
                </div>
            
                <?php $x=1; ?>
                @foreach ($products as $product)
                    <div class="viewContent view-first">
                    <img src="{{ asset($product -> product_picture) }}" width="100%" height="100%">
                        <div class="mask"></div>
                        <div class="content">
                            <h2> {{ $product -> product_name }} </h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.
                            </p>
                            <a href="#portfolioModal{{$x}}" class="portfolio-link info" data-toggle="modal">
                                <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
                                View More
                            </a>
                        </div>
                    </div>
                    <?php $x++; ?>
                @endforeach
            
                <!-- MODALS -->
                <?php $y=1; ?>
                @foreach ($products as $product)
                <div class="portfolio-modal modal fade" id="portfolioModal{{$y}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2>{{ $product -> product_name }}</h2>
                                <hr class="star-primary">
                                <img src="{{ asset($product -> product_picture) }}" class="img-responsive img-centered" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <ul class="list-inline item-details font-size">
                                    <li>Price:
                                        <strong> ${{ $product -> product_price }} </strong>
                                    </li>
                                </ul>
                                <form action="/process-cart" method="post" accept-charset="utf-8">
                                {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{ $product -> product_id }}">
                                    <input type="hidden" name="product_name" value="{{ $product -> product_name }}">
                                    <input type="hidden" name="product_price" value="{{ $product -> product_price }}">
                                    <input type="hidden" name="product_picture" value="{{ $product -> product_picture }}">
                                    <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i> Add to Cart </button>
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $y++; ?>
    @endforeach
            
    
    <!-- ABOUT SECTION -->
    <section class="success" id="about" style="margin-top: 200px; position: relative;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About Lavada</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Lavada is a non-stop shopping outlet that offers different products especially modern fashions. We also guarantee 100% customer satisfaction and security. We are open for partnerships and for third-party sellers.</p>
                </div>
                <div class="col-lg-4">
                    <p>Whether you're a student, by-stander, parent, office worker, who are looking to showcase the quality of products in Lavada, we are always open to serve what you want. We are generous to fulfill your expectations with us!</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download App
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Lavada</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-warning btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>La Verdad Christian College
                            <br>Apalit, Pampanga 2016</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="navbar-nav navbar-align list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About the Editor</h3>
                        <p>I am Lorenz Florentino who is an aspiring web developer. I created this Lavada just for fun and for completion of requirements.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Lavada - Lorenz Florentino 2017
                    </div>
                </div>
            </div>
        </div>
    </footer>

@endsection
