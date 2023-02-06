@extends('client.layout.app')
@section('home')

    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">CATEGORY:{{$category_title->title}}</h2>
            @if($count > 0)
                @foreach($category_product as $value)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img style="width: 100%;height:200px" src="{{asset('upload/product/'.$value->image)}}" alt=""/>
                                    <h2>{{number_format($value->price)}}$</h2>
                                    <p>{{$value->title}}</p>
                                    <a href="{{route('client-details',$value->slug)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i></i>
                                        Details</a>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                        to cart</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
         <h3 class="alert alert-success">Product is empty</h3>
                @endif
        </div>

    </div>
@endsection
