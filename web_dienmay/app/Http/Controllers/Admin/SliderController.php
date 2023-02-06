<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function ListSlider(){
       $sliders = Slider::all();
       $count = count($sliders);
       return view('admin.slider.ListSlider',compact('sliders','count'));

    }
    public function CreateSlider(){
        return view('admin.slider.CreateSlider');
    }
    public function StoreCreateSlider(Request $request){
        $request->validate([
            'title'=>'required|max:255|unique:slider,title',
            'image'=>'required|image',
            'description'=>'required',
        ]);
        if($request->hasFile('image')){
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $a = rand();
            $file_name = $a.'.'.$extension;
            $file->move('upload/slider',$file_name);
            $request->image = $file_name;
        }
        $slider = new  Slider();
        $slider->title = $request->title;
        $slider->image = $file_name;
        $slider->description = $request->description;
        $slider->save();
        return redirect()->route('admin.slider')->with('success','Add slider success');
    }
    public function FormEditSlider($id){
        $slider = Slider::find($id);
        return view('admin.slider.EditSlider',compact('slider'));
    }
    public function EditSlider(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:slider,title,' . $id,
            'image' => 'image',
            'description' => 'required',

        ]);
        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->status = $request->status;
        // xóa item sẽ xóa luôn ảnh

        $get_image = $request->image;
        if ($get_image) {
            $path = 'upload/slider/' . $slider->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $a = rand();
            $file_name = $a . '.' . $extension;
            $image->move('upload/slider/', $file_name);
            $slider->image = $file_name;
        }
        $slider->save();
        return redirect()->route('admin.slider')->with('success', 'Edit brand success');

    }
    public function Delete($id){
        $slider = Slider::find($id);
        $slider->delete();
        $path = 'upload/slider/'.$slider->image;
        if(file_exists($path)){
            unlink($path);
        }
         return redirect()->route('admin.slider')->with('success','Delete slider success');
    }
    public function Search(Request $request)
    {
        $data = '';
        if ($request->search) {
            $data = Slider::where('title', 'like', '%' . $request->search . '%')->get();
        }
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

                 <td><img style=\"width: 300px;height: 140px;border-radius: 0\" alt=\"error-image\" src='" . asset('upload/slider/' . $value->image) . "'></td>
                  <td>$value->description </td>
                <td>$status </td>
                <td>  <a class='btn-primary btn' href='".route('admin.slider.edit-form',$value->id)."'> EDIT</a>
             <a class='btn-danger btn'  href='".route('admin.slider.delete',$value->id)."'> DELETE</a>
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
