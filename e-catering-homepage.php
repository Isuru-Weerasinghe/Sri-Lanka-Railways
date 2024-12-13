<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E Catering System</title>
  <link rel="stylesheet" type="text/css" href="assets/css/e-catering.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

  <!--Header section start-->
  <header>
    <a href="#" class="logo"><img src="assets/img/e-cater/logo.png"></a>
    <nav class="navbar">
      <a href="#home" class="active">HOME</a>
      <a href="#about">ABOUT</a>
      <a href="e-catering-foodcategory.php">FOOD CATEGORY</a>
    </nav>

    <div class="icons">
      <i class="fas fa-bars" id="menu"></i>
      <i class="fas fa-search"></i>
      <i class="fas fa-heart"></i>
      <i class="fas fa-shopping-cart"></i>
    </div>
  </header>

  <script type="text/javascript">
    let menu = document.querySelector('#menu');
    let navbar = document.querySelector('.navbar');

    menu.onclick = () => {
      menu.classList.toggle('fa-times');
      navbar.classList.toggle('active');
    }
  </script>

</head>


<body>

  <!--slider section start-->
  <div class="home" id="home">
    <div class="swiper home-slider">
      <div class="swiper-wrapper wrapper">
        <div class="swiper-slide slide slide1">
          <div class="content">
            <img src="assets/img/e-cater/crown-symbol.png">
            <h3>Delicious royate</h3>
            <h1>Gift voucher</h1>
            <p>Give away your beloved customers</p>
            <a href="#" class="btn">Order Now</a>
            <script>
              swal({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
                button: "Aww yiss!",
              });
            </script>
          </div>
        </div>



        <div class="swiper-slide slide slide2">
          <div class="content">
            <img src="assets/img/e-cater/crown-symbol.png">
            <h3> sales of 10% this Dish</h3>
            <h1>The Fresh Meal</h1>
            <p> Food Catering</p>
            <a href="#" class="btn">Order Now</a>
          </div>
        </div>

        <div class="swiper-slide slide slide3">
          <div class="content">
            <img src="assets/img/e-cater/crown-symbol.png">
            <h3> We are open</h3>
            <h1>Fresh Fruits</h1>
            <p> You will love it.</p>
            <a href="#" class="btn">Order Now</a>
          </div>
        </div>

        <div class="swiper-slide slide slide4">
          <div class="content">
            <img src="assets/img/e-cater/crown-symbol.png">
            <h3> Delicious royate</h3>
            <h1>Gift voucher</h1>
            <p> Give away your beloved customers</p>
            <a href="#" class="btn">Order Now</a>
          </div>
        </div>


      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <!--slider section end-->

  <section class="welcome" id="about">
    <h1 class="heading"> Welcome to E Catering Service</h1>
    <center>
      <h3 class="sub-heading"> ~Luxuray and Quality Delisious Food in your Journey ~</h3>
    </center>

    <div class="box-container">
      <div class="box">
        <div class="image">
          <img src="assets/img/e-cater/post-thumb-1.jpg">

          <div class="content">
            <h3>PROFESSIONAL LEVEL</h3>
            <p>nor again is there anyone who loves or purpose or desires to obtain pain of itself, because it is pain.
            </p>
            <a href="#" class="btn">Read More </a>
          </div>
        </div>
      </div>

      <div class="box">
        <div class="image">
          <img src="assets/img/e-cater/post-thumb-2.jpg">

          <div class="content">
            <h3>FRESH FOOD FOR YOUR JOURNEY</h3>
            <p>nor again is there anyone who loves or purpose or desires to obtain pain of itself, because it is pain.
            </p>
            <a href="#" class="btn">Read More </a>
          </div>
        </div>
      </div>


      <div class="box">
        <div class="image">
          <img src="assets/img/e-cater/post-thumb-3.jpg">

          <div class="content">
            <h3>THE MENU IS PLENTYFUL</h3>
            <p>nor again is there anyone who loves or purpose or desires to obtain pain of itself, because it is pain.
            </p>
            <a href="#" class="btn">Read More </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!--our menu section start-->
  <section class="our-menu" id="menu">
    <h1 class="heading">Our Food Menu</h1>
    <center>
      <h3 class="sub-heading"> ~ see what we offer ~ </h3>
    </center>

    <div class="menu-container">
      <div class="item">
        <div class="item-name">
          <h2>Main Course</h2>
          <img src="assets/img/e-cater/drinks.png">
        </div>
        <div class="item-body">
          <div class="item-menu">
            <h3>Super-Delicious Sweets</h3>
            <span class="dots"></span>
            <h3>$40</h3>
            <ul>
              <li><a href="#">Chicken</a></li>
              <li><a href="#">Italian</a></li>
              <li><a href="#">Spinach</a></li>
              <li><a href="#">Sausage</a></li>
            </ul>
          </div>

          <div class="item-menu">
            <h3>Super-Delicious Drinks</h3>
            <span class="dots"></span>
            <h3>$60</h3>
            <ul>
              <li><a href="#">Faluda</a></li>
              <li><a href="#">Pineapple</a></li>
              <li><a href="#">Avacado</a></li>
              <li><a href="#">Strawbery</a></li>
            </ul>
          </div>

        </div>
      </div>

      <div class="item">
        <div class="item-name">
          <h2>Meals </h2>
          <img src="assets/img/e-cater/drinks.png">
        </div>
        <div class="item-body">
          <div class="item-menu">
            <h3>Super-Delicious Sweets</h3>
            <span class="dots"></span>
            <h3>$40</h3>
            <ul>
              <li><a href="#">Chicken</a></li>
              <li><a href="#">Italian</a></li>
              <li><a href="#">Spinach</a></li>
              <li><a href="#">Sausage</a></li>
            </ul>
          </div>

          <div class="item-menu">
            <h3>Super-Delicious Drinks</h3>
            <span class="dots"></span>
            <h3>$60</h3>
            <ul>
              <li><a href="#">Faluda</a></li>
              <li><a href="#">Pineapple</a></li>
              <li><a href="#">Avacado</a></li>
              <li><a href="#">Strawbery</a></li>
            </ul>
          </div>

        </div>
      </div>

      <div class="item">
        <div class="item-name">
          <h2>Desserts</h2>
          <img src="assets/img/e-cater/drinks.png">
        </div>
        <div class="item-body">
          <div class="item-menu">
            <h3>Desserts</h3>
            <span class="dots"></span>
            <h3>$40</h3>
            <ul>
              <li><a href="#">Chicken</a></li>
              <li><a href="#">Italian</a></li>
              <li><a href="#">Spinach</a></li>
              <li><a href="#">Sausage</a></li>
            </ul>
          </div>

          <div class="item-menu">
            <h3>Super-Delicious Drinks</h3>
            <span class="dots"></span>
            <h3>$60</h3>
            <ul>
              <li><a href="#">Faluda</a></li>
              <li><a href="#">Pineapple</a></li>
              <li><a href="#">Avacado</a></li>
              <li><a href="#">Strawbery</a></li>
            </ul>
          </div>

        </div>
      </div>
  </section>
  <!--our menu section end-->

  <!--our team section start-->
  <section class="our-team" id="team">
    <h1 class="heading">Our Facilities</h1>
    <center>
      <h3 class="sub-heading"> ~ Great Accomadation ~ </h3>
    </center>

    <div class="our-chef">
      <div class="item">
        <div class="image">
          <img src="assets/img/e-cater/facilities1.jpg">
        </div>

        <div class="chef-info">
          <div>
            <h3>SOFT DRINKS</h3>
            <span>ENJOY YOUR JOURNEY WITH DELISIOUS MEALS</span>
            <ul>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="item">
        <div class="image">
          <img src="assets/img/e-cater/facilities2.jpg">
        </div>

        <div class="chef-info">
          <div>
            <h3>CUSTOMER FRIENDLY</h3>
            <span>CUSTOMER HAPPLILY JOURNEY</span>
            <ul>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="item">
        <div class="image">
          <img src="assets/img/e-cater/facilities3.jpg">
        </div>

        <div class="chef-info">
          <div>
            <h3>MEALS WITH MORE PLEASENT DECORATION</h3>
            <span>CUSTOMER CARING SERVICE</span>
            <ul>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--our team section end-->


  <!-- news section start -->
  <section class="blog welcome" id="blog">
    <h1 class="heading">Latest News</h1>
    <center>
      <h3 class="sub-heading"> ~ Greate Artivles ~ </h3>
    </center>
    <div class="box-container">
      <div class="box">
        <div class="image">
          <img src="assets/img/e-cater/post-thumb-4.jpg">
        </div>
        <div class="content">
          <h3>PROFESSIONAL LEVEL SUPPLY</h3>
          <p>At our E Catering service, we take pride in our commitment to supply professional-level foods to meet your
            culinary needs.</p>
          <a href="#">READ MORE</a>
          <img src="assets/img/e-cater/post-body-bg-1.png">
        </div>
      </div>


      <div class="box">
        <div class="image">
          <img src="assets/img/e-cater/post-thumb-5.jpg">
        </div>
        <div class="content">
          <h3>FRESH MEAL GUARANTEED</h3>
          <p>Explore our service to discover how we excel in supplying pure meals that prioritize quality and taste,
            ensuring your satisfaction with every bite.</p>
          <a href="#">READ MORE</a>
          <img src="assets/img/e-cater/post-body-bg-2.png">
        </div>
      </div>



      <div class="box">
        <div class="image">
          <img src="assets/img/e-cater/post-thumb-6.jpg">
        </div>
        <div class="content">
          <h3>THE PROTECTION</h3>
          <p> your safety is our utmost priority, and we strictly adhere to the laws in railway service regarding the
            consumption of alcohol. We ensure that our services are only available to individuals who are of legal
            drinking, which is 18 and above, to maintain a responsible and lawful approach to the sale of rum and
            alcohol..</p>
          <a href="#">READ MORE</a>
          <img src="assets/img/e-cater/post-body-bg-3.png">
        </div>
      </div>

    </div>
  </section>
  <!-- news section end -->
  <!-- footer section start -->
  <section class="footer">
    <img src="assets/img/e-cater/logo.png" class="logo">
    <div class="container">
      <div>
        <h3>ABOUT US</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
      </div>
      <div>
        <h3>GET Latest NEWS and NEW MEALS</h3>
        <input type="email" name="" placeholder="Enter your email">
        <ul>
          <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
        </ul>
      </div>
      <div>
        <h3>CONTACT US</h3>
        <span>Railway Autority Food Management</span>
        <span>+(94) 71335466</span>
        <span>abc@gmail.com</span>
        <span>www.lms.com</span>

      </div>
    </div>
    <p>&copy;2023 Reserved by railway network </p>
  </section>
  <!-- footer section end -->

  <!-- jump to top -->
  <a href="#"><button class="topbtn"><i class="fa-solid fa-angle-up"></i></button></a>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".home-slider", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 7500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      loop: true,
    });
  </script>

</body>

</html>