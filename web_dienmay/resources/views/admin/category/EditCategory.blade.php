@extends('admin.layout.app')
@section('title', 'EditCategory')
@section('content')
    <div class="modal-header">
        <h4 class="modal-title">Edit Brand</h4>
    </div>
    <form action="{{route('admin.category.edit',$category->id)}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input value="{{$category->title}}" type="text" class="form-control" onkeyup="ChangeToSlug()" name="title"
                   id="slug">
            <span class="text-danger">@error('title'){{$message}}@enderror</span>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Slug</label>
            <input type="text" value="{{$category->slug}}" class="form-control" id="convert_slug" name="slug">
            <span class="text-danger">@error('slug'){{$message}}@enderror</span>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control"  name="image" type="file">
            <img style="width: 150px;height: 130px" alt="error-image"
                 src="{{asset('upload/category/'.$category->image)}}">
            <span class="text-danger">@error('image'){{$message}}@enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description</label>
            <textarea class="form-control" cols="5" rows="5" name="description">{{$category->description}}</textarea>
            <span class="text-danger">@error('description'){{$message}}@enderror</span>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example" name="status">
                @if($category->status == 0)
                    <option selected value="0">Active</option>
                    <option value="1">No Active</option>
                @else
                    <option value="0">Active</option>
                    <option selected value="1">No Active</option>
                @endif
            </select>
        </div>
        <button id="submit" type="submit" class="btn btn-primary">Edit</button>

    </form>
    </div>

@endsection
@push('scripts-custom')

@endpush
