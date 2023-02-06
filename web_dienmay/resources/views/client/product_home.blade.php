@extends('client.layout.app')
@section('home')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
            @foreach($product as $value)
                <form method="post" action="{{route('add_to_cart')}}">
                    @csrf
                   <input type="hidden" value="{{$value->id}}" name="id_product">
                    <input type="hidden" value="1" name="quantity">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img style="width: 100%;height: 200px" src="{{asset('upload/product/'.$value->image)}}" alt=""/>
                                <h2>${{number_format($value->price)}}</h2>
                                <p>{{$value->title}}</p>
                                <a href="{{route('client-details',$value->slug)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i></i>
                                    Details</a>
                                <button type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to cart</button>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
            @endforeach
        </div>

    </div>
@endsection
