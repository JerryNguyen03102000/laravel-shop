<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function ListCategory()
    {
        $categorys = Category::all();
        $count = count($categorys);
        return view('admin.category.ListCategory', compact('categorys', 'count'));
    }

    public function CreateCategory()
    {
        return view('admin.category.CreateCategory');
    }

    public function StoreCreateCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:category,title',
            'slug' => 'required|max:255|unique:category,title',
            'image' => 'required|image',
            'description' => 'required',
        ]);
        $category = new Category();
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $a = rand();
            $file_name = $a . '.' . $extension;
            $file->move('upload/category', $file_name);
            $request->image = $file_name;
        }
        $category->image = $file_name;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Add category success');
    }

    public function Delete($id)
    {
        $category = Category::find($id);
        $path = 'upload/category/' . $category->image;
        if (file_exists($path)) {
            unlink($path);
        }
        $category->delete();
        return redirect()->route('admin.category')->with('success', 'Delete category success');
    }

    public function FormEditCategory($id)
    {
        $category = Category::find($id);
        return view('admin.category.EditCategory', compact('category'));
    }

    public function EditCategory(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:category,title,' . $id,
            'slug' => 'required|max:255|unique:category,title,' . $id,
            'image' => 'image',
            'description' => 'required',
        ]);
        $category = Category::find($id);
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status;
        $get_image = $request->image;
        if ($get_image) {
            $path = 'upload/category/' . $category->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $a = rand();
            $file_name = $a . '.' . $extension;
            $image->move('upload/category', $file_name);
            $category->image = $file_name;
        }

        $category->save();
        return redirect()->route('admin.category')->with('success', 'Edit category success');

    }
    public function Search(Request $request)
    {
        $data = Category::where('title', 'like', '%' . $request->search . '%')->get();
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
                 <td><img style=\"border-radius: 0;width: 150px;height: 130px\" alt=\"error-image\" src='" . asset('upload/category/' . $value->image) . "'></td>
                  <td>$value->description </td>
                <td>$status </td>
                <td>  <a class='btn-primary btn' href='".route('admin.category.edit-form',$value->id)."'> EDIT</a>
             <a class='btn-danger btn'  href='".route('admin.category.delete',$value->id)."'> DELETE</a>
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
