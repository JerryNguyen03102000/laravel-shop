@extends('admin.layout.app')
@section('title', 'Product')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                @if(Session::has('success'))
                    <div class="alert-success alert">
                        {{Session::get('success')}}
                    </div>
                @endif

                <form method="get" action="">
                    @csrf
                    <div class="card-body pb-5">
                        <div class="d-flex justify-content-between">
                            <p class="card-title" style="font-size:20px"> List Product </p>
                            <a type="button" class="btn bg-info" href="{{route('admin.product.create-form')}}"><i
                                    class="ti-plus text-white"></i></a>

                        </div>
                        <div class="count-brand">
                            <h6><b>Total:{{$count}}</b></h6>
                        </div>
                        <input type="text" class="form-control col-md-4 px-2 mb-3" placeholder="Search by keyword"
                               id="search" name="search">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th> #</th>
                                    <th> Title</th>
                                    <th> Slug</th>
                                    <th> Image</th>
                                    <th> Price</th>
                                    <th> Description</th>
                                    <th> Category</th>
                                    <th> Brand</th>
                                    <th> Status</th>
                                    <th> Manage</th>
                                </tr>
                                </thead>
                                <tbody id="showdata">
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->slug}}</td>
                                        <td>
                                            <img src="{{asset('upload/product/'.$product->image)}}"
                                                 style="border-radius:0 ; width: 160px;height: 140px ">

                                        </td>
                                        <td>{{number_format($product->price)}}$</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->category->title}}</td>
                                        <td>{{$product->brand->title}}</td>
                                        @if($product->status == 0)
                                            <td>Active</td>
                                        @else
                                            <td>No Active</td>
                                        @endif

                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{route('admin.product.edit-form',$product->id)}}">Edit</a>
                                            <a onclick="return confirm('Do you want delete ?')" class="btn btn-danger"
                                               href="{{route('admin.product.delete',$product->id)}}">DELETE</a></td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tbody id="content" class="searchdata">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts-custom')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#search').on('keyup', function () {
                var query = $(this).val();
                let url = '{{route('admin.product.search')}}';
                if (query) {
                    $('#showdata').hide();
                    $('#content').show();
                } else {
                    $('#showdata').show();
                    $('#content').hide();
                }
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {'search': query},
                    success: function (data) {
                        $('#content').html(data);
                    }

                });

            });

        });
    </script>

@endpush
