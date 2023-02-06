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
        <div class="table-responsive cart_info">
            @if($count>0)
            <table class="table table-condensed text-center" >
                <thead>
                <tr class="cart_menu">
                    <td class="key">#</td>
                    <td class="image">Image</td>
                    <td class="title">Title</td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td class="total">Delete</td>

                </tr>
                </thead>
                <tbody>
                <?php
                $subtotal = 0;
                $total = 0;
                ?>
                @foreach($carts as $key =>$value)
                    <?php
                    $subtotal = ($value->price) * ($value->quantity);
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td>
                            <p>{{++$key}}</p>
                        </td>
                        <td class="col-md-2 text-center">
                            <img style="height: 120px;width: 140px" src="{{asset('upload/product/'.$value->image)}}"
                                 alt="">
                        </td>
                        <td class="col-md-2">
                            <h4>{{$value->title}}</h4>
                        </td>
                        <td class="col-md-2">
                            <p>${{number_format($value->price)}}</p>
                        </td>
                        <td class="col-md-2">
                            <form action="{{route('update-quantity_cart',$value->id)}}" method="post">
                                @csrf
                                <div style="display: flex">
                            <input id="test" name="quantity" style="width:120px;height: 30px" min="1" value="{{$value->quantity}}"
                                   type="number">
                            <button style="margin: 0" class="btn btn-primary " type="submit">Update</button>
                                </div>
                            </form>
                        </td>
                        <td class="col-md-2">
                            <p class="cart_total_price">${{number_format($subtotal)}}</p>
                        </td>
                        <td class="col-md-2">
                            <a class="cart_quantity_delete"
                               onclick="return confirm('do you want delele cart?')" href="{{route('delete_cart',$value->id)}}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>

                @endforeach
                <tr style="position: relative">
                    <td>Total</span>:<a class="cart_total_price">${{number_format($total)}}</a></td>
                    <td style="position: absolute;right: 0"><a class="btn btn-danger" href="{{route('delete_all_cart')}}">Delete all</a></td>
                    <td  style="position: absolute;right: 10%"><a class="btn btn-success" href="{{route('user-checkout')}}">Order cart</a></td>
                </tr>
                </tbody>
            </table>
            @else
            <div class="no-cart alert alert-danger">Please add product to cart</div>
            @endif
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

