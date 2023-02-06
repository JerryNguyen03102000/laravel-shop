<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Slider;
use Illuminate\Http\Request;
use function League\Flysystem\Local\move;
use function Symfony\Component\Console\Style\confirm;

class BrandController extends Controller
{
    public function ShowListBrand()
    {
        $brands = Brands::all();
        $count = count($brands);
        return view('admin.brand.ListBrand', compact('brands','count'));
    }

    public function CreateBrand()
    {
        return view('admin.brand.CreateBrand');
    }

    public function StoreCreateBrand(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:brands,title',
            'slug' => 'required|max:255|unique:brands,slug',
            'image' => 'required|image',
            'description' => 'required',

        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $a = rand();
            $file_name = $a . '.' . $extension;
            $image->move('uploadImageBrand', $file_name);
            $request->image = $file_name;

        }

        $brand = new Brands();
        $brand->title = $request->title;
        $brand->slug = $request->slug;
        $brand->image = $file_name;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->save();

        return redirect()->route('admin.brand')->with('success', 'Add brand success');
    }

    public function FormEditBrand($id)
    {
        $brand = Brands::find($id);
        return view('admin.brand.EditBrand', compact('brand'));
    }

    public function EditBrand(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:brands,title,' . $id,
            'slug' => 'required|max:255|unique:brands,slug,' . $id,
            'image' => 'image',
            'description' => 'required',

        ]);
        $brand = Brands::find($id);
        $brand->title = $request->title;
        $brand->slug = $request->slug;
        $brand->description = $request->description;
        $brand->status = $request->status;
        // xóa item sẽ xóa luôn ảnh
        $path = 'uploadImageBrand/' . $brand->image;
        $get_image = $request->image;
        if ($get_image) {
            $path = 'uploadImageBrand/' . $brand->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $a = rand();
            $file_name = $a . '.' . $extension;
            $image->move('uploadImageBrand', $file_name);
            $brand->image = $file_name;
        }
        $brand->save();
        return redirect()->route('admin.brand')->with('success', 'Edit brand success');

    }

    public function Delete($id)
    {
        $brand = Brands::find($id);
        // xóa item sẽ xóa luôn ảnh
        $path = 'uploadImageBrand/' . $brand->image;
        if (file_exists($path)) {
            unlink($path);
        }
        $brand->delete();
        return redirect()->route('admin.brand')->with('success', 'Delete brand success');
    }

    // search
    public function Search(Request $request)
    {
            $data = Brands::where('title', 'like', '%' . $request->search . '%')->get();
        $output = '';
        $status = '';
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                switch ($value->status) {
                    case 0:
                        $status = "Active";
                        break;
                    case 1:
                        $status = "No Active";
                        break;


                }

                $output .= "
             <tr>
                <td>$key </td>
                <td>$value->title </td>
                     <td>$value->slug </td>
                 <td><img style=\"border-radius: 0;width: 150px;height: 120px\" alt=\"error-image\" src='" . asset('uploadImageBrand/' . $value->image) . "'></td>
                  <td>$value->description </td>
                <td>$status </td>
                <td>  <a class='btn-primary btn' href='".route('admin.brand.edit-form',$value->id)."'> EDIT</a>
             <a class='btn-danger btn'  href='".route('admin.brand.delete',$value->id)."'> DELETE</a>
</td>
            </tr>
         }
       ";
            }
        } else {
            $output .= "No result";
        }
        return $output;
    }
}
