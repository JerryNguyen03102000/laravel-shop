@extends('admin.layout.app')
@section('title','Order')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body pb-5">
                    <div class="d-flex justify-content-between">
                        <p class="card-title" style="font-size:20px"> List Order </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th> #</th>
                                <th> Order Code</th>
                                <th> Product Name</th>
                                <th> Product Image</th>
                                <th> Product Price</th>
                                <th> Quantity</th>
                                <th> SubTotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderDetails as $key => $value)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->order_code}}</td>
                                    <td>{{$value->title}}</td>
                                    <td><img style="width: 150px;height: 120px;border-radius: 0" src="{{asset('upload/product/'.$value->image)}}" alt="error image"></td>
                                    <td>{{'$'.number_format($value->price)}}</td>
                                    <td>{{$value->quantity}}</td>
                                    <td>{{'$'.number_format(($value->price)*($value->quantity))}}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
