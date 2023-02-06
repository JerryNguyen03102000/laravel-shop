@extends('admin.layout.app')
@section('title', 'CreateBrand')
@section('content')
    <div class="modal-header">
        <h4 class="modal-title">Add Slider</h4>
    </div>
    <form action="{{route('admin.slider.create')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input value="{{old('title')}}" type="text" class="form-control"  name="title" >
            <span class="text-danger">@error('title'){{$message}}@enderror</span>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" name="image" type="file" >
            <span class="text-danger">@error('image'){{$message}}@enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description</label>
            <textarea  class="form-control" cols="5" rows="5" name="description">{{old('description')}}</textarea>
            <span class="text-danger">@error('description'){{$message}}@enderror</span>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example" name="status">
                <option value="0" >Active</option>
                <option value="1">No Active</option>

            </select>
        </div>
        <button id="submit" type="submit" class="btn btn-success">ADD</button>

    </form>
    </div>

@endsection
@push('scripts-custom')


@endpush
