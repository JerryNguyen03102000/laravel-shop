@extends('admin.layout.app')
@section('title', 'Category')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                @if(Session::has('success'))
                    <div class="alert-success alert">
                        {{Session::get('success')}}
                    </div>
                @endif

                <form method="get" action="{{route('admin.category.search')}}">
                    @csrf
                    <div class="card-body pb-5">
                        <div class="d-flex justify-content-between">
                            <p class="card-title" style="font-size:20px"> List Category </p>
                            <a type="button" class="btn bg-info" href="{{route('admin.category.create-form')}}"><i
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
                                    <th> Description</th>
                                    <th> Status</th>
                                    <th> Manage</th>
                                </tr>
                                </thead>
                                <tbody id="showdata">
                                @foreach($categorys as $key => $category)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>
                                            <img src="{{asset('upload/category/'.$category->image)}}"
                                                 style="border-radius:0 ; width: 150px;height: 140px ">

                                        </td>
                                        <td>{{$category->description}}</td>
                                        @if($category->status == 0)
                                            <td>Active</td>
                                        @else
                                            <td>No Active</td>
                                        @endif

                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{route('admin.category.edit-form',$category->id)}}">Edit</a>
                                            <a onclick="return confirm('Do you want delete ?')" class="btn btn-danger"
                                               href="{{route('admin.category.delete',$category->id)}}">DELETE</a></td>
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
                let url = '{{route('admin.category.search')}}';
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
