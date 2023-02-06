<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Electron</title>
    <link href="css/client/bootstrap.min.css" rel="stylesheet">
    <link href="css/client/font-awesome.min.css" rel="stylesheet">
    <link href="css/client/prettyPhoto.css" rel="stylesheet">
    <link href="css/client/price-range.css" rel="stylesheet">
    <link href="css/client/animate.css" rel="stylesheet">
    <link href="css/client/main.css" rel="stylesheet">
    <link href="css/client/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
@include('client.header')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
    <div class="alert alert-success">
        Thank you for your order. We will contact you as soon as possible
    </div>
    </div>
</section>
@include('client.footer')
<script src="js/client/jquery.js"></script>
<script src="js//client/bootstrap.min.js"></script>
<script src="js/client/jquery.scrollUp.min.js"></script>
<script src="js/client/price-range.js"></script>
<script src="js/client/jquery.prettyPhoto.js"></script>
<script src="js/client/main.js"></script>
<script src="js/client/html5shiv.js"></script>
<script src="js/client/respond.min.js"></script>
</body>
</html>


