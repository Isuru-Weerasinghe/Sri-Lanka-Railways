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
    <script src="assets/js/sweetalert.min.js"></script>

    <!--Header section start-->
    <header>
        <a href="#" class="logo"><img src="assets/img/e-cater/logo.png"></a>
        <nav class="navbar">
            <a href="e-catering-homepage.php#home" class="active">HOME</a>
            <a href="e-catering-homepage.php#about">ABOUT</a>
            <a href="#foodcategory">FOOD CATEGORY</a>
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

    <!--reservation section start-->
    <div class="reservation" id="reservation">
        <div class="image">

        </div>
        <div class="form">
            <h1 class="heading">check out your meals</h1>
            <center>
                <h3 class="sub-heading"> ~ Check Out Our Place ~ </h3>
            </center>
            <form action="">
                <div calss="form-holder">
                    <input type="text" name="" placeholder="Ticket No:">
                    <input type="text" name="" placeholder="Name of Passenger">
                    <div>
                        <select>
                            <option>1 people</option>
                            <option>2 people</option>
                            <option>3 people</option>
                            <option>4 people</option>
                        </select>
                        <input type="text" name="" placeholder="Price">
                        <input type="text" name="" placeholder="Quantity">
                        <input type="text" name="" placeholder="Phone No">
                    </div>
                    <div>
                        <input type="text" name="" placeholder="Date">
                        <input type="email" name="" placeholder="Email">
                    </div>
                </div>
                <form method="POST" action="#" onsubmit="return submit(this);">
                   <button id="myButton" role="button" type="submit" class="btn1">Check Out Now</button>
                   <button id="myButton" role="button" type="nosubmit" class="btn1"> Cancel Check Out Now</button>
                </form>
                <script>
                    function submit(form){
                    swal({
                        title:"Are you sure?",
                        text: "This checkout confirmed",
                        icon: "warning",
                        buttons:true,
                        dangerMode:true,
                    })
                    .then((isokay)=> {
                        if(isokay){
                            form.submit();
                        }
                    });
                    return false;
                }
                </script>
            </form>
           

        </div>
    </div>
    <!--reservation section end-->

</body>

</html>