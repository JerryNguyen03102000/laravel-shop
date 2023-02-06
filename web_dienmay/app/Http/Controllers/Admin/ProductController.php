<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ListProduct()
    {
        $products = Product::all();
        $count = count($products);
        return view('admin.product.ListProduct', compact('products', 'count'));
    }

    public function CreateProduct()
    {
        $categorys = Category::all();
        $brands = Brands::all();
        return view('admin.product.CreateProduct',compact('categorys','brands'));
    }

    public function StoreCreateProduct(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:product,title',
            'slug' => 'required|max:255|unique:product,slug',
            'price' => 'required|integer',
            'image' => 'required|image',
            'description' => 'required',
        ]);
        $product = new Product();
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $a = rand();
            $file_name = $a . '.' . $extension;
            $file->move('upload/product', $file_name);
            $request->image = $file_name;
        }

        $product->image = $file_name;
        $product->price = $request->price;
        $product->id_category = $request->category;
        $product->id_brand = $request->brand;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Add category success');
    }

    public function Delete($id)
    {
        $product = Product::find($id);
        $path = 'upload/product/' . $product->image;
        if (file_exists($path)) {
            unlink($path);
        }
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'Delete product success');
    }

    public function FormEditProduct($id)
    {
        $category = Category::all();
        $brand = Brands::all();
        $product = Product::find($id);
        return view('admin.product.EditProduct', compact('product','category','brand'));
    }

    public function EditProduct(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:product,title,' . $id,
            'slug' => 'required|max:255|unique:product,title,' . $id,
            'image' => 'image',
            'price' => 'required|integer',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->Price = $request->price;
        $product->description = $request->description;
        $product->id_category = $request->category;
        $product->id_brand = $request->brand;
        $product->status = $request->status;
        $get_image = $request->image;
        if ($get_image) {
            $path = 'upload/product/' . $product->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $a = rand();
            $file_name = $a . '.' . $extension;
            $image->move('upload/product', $file_name);
            $product->image = $file_name;
        }

        $product->save();
        return redirect()->route('admin.product')->with('success', 'Edit product success');

    }
    public function Search(Request $request)
    {
        $data = Product::where('title', 'like', '%' . $request->search . '%')->get();
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
                 <td><img style=\"border-radius: 0;width: 150px;height: 130px\"
                 alt=\"error-image\" src='" . asset('upload/product/' . $value->image) . "'></td>
                    <td>$value->price$</td>
                  <td>$value->description </td>
                    <td>".$value->category->title."</td>
                      <td>".$value->brand->title."</td>
                <td>$status </td>
                <td>  <a class='btn-primary btn' href='".route('admin.product.edit-form',$value->id)."'> EDIT</a>
             <a class='btn-danger btn'  href='".route('admin.product.delete',$value->id)."'> DELETE</a>
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
