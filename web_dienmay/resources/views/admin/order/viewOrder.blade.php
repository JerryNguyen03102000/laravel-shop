@extends('admin.layout.app')
@section('title','Order')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                @if(Session::has('success2'))
                    <div class="alert-success alert">
                        {{Session::get('success2')}}
                    </div>
                @endif
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
                                <th> Name</th>
                                <th> Phone</th>
                                <th> Address</th>
                                <th> Status</th>
                                <th> Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $value)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->order_code}}</td>
                                    <td>{{$value->ship->name}}</td>
                                    <td>{{$value->ship->phone}}</td>
                                    <td>{{$value->ship->address}}</td>
                                    @if($value->status == 1)
                                        <td class="text-primary">Đang chờ xử lý</td>
                                    @elseif($value->status == 2)
                                        <td class="text-success">Đã giao hàng</td>
                                    @else
                                        <td class="text-danger">Đã hủy</td>
                                    @endif

                                    <td>
                                        <a class="btn btn-primary"
                                           href="{{route('admin.orderDetails',$value->order_code)}}">View</a>
                                        <a onclick="return confirm('Do you want delete ?')" class="btn btn-danger"
                                           href="{{route('admin.orderDelete',$value->id)}}">DELETE</a></td>

                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <12select class="xulydonhang form-control">
                                        <option value="0">--Xử lý đơn hàng---</option>
                                        <option value="2">Đơn hàng đang được xử lý- Đang giao hàng</option>
                                        <option value="3">Hủy đơn</option>
                                    </12select>
                                </td>

                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
