@extends('admin.layout.app')
@section('title', 'Slider')
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
                            <p class="card-title" style="font-size:20px"> List Slider </p>
                            <a type="button" class="btn bg-info" href="{{route('admin.slider.create-form')}}"><i
                                    class="ti-plus text-white"></i></a>

                        </div>
                        <div class="count-brand">
                            <h6><b>Total:{{$count}}</b></h6>
                        </div>
                        <input type="text" class="form-control col-md-4 px-2 mb-3" placeholder="Search by keyword"
                               id="search" name="search">
                        <div class="">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Title</th>
                                    <th> Image</th>
                                    <th> Description</th>
                                    <th> Status</th>
                                    <th> Manage</th>
                                </tr>
                                </thead>
                                <tbody id="showdata">
                                @foreach($sliders as $key => $slider)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$slider->title}}</td>
                                        <td>
                                            <img style="border-radius: 0;width:300px;height: 140px"  alt="error-image"
                                                 src="{{asset('upload/slider/'.$slider->image)}}">
                                        </td>

                                        <td>{{$slider->description}}</td>
                                        @if($slider->status == 0)
                                            <td>Active</td>
                                        @else
                                            <td>No Active</td>
                                        @endif

                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{route('admin.slider.edit-form',$slider->id)}}">Edit</a>
                                            <a onclick="return confirm('Do you want delete ?')" class="btn btn-danger"
                                               href="{{route('admin.slider.delete',$slider->id)}}">DELETE</a></td>
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
                let url = '{{route('admin.slider.search')}}';
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


