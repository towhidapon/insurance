<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle  = 'Manage Categories';
        $categories = Category::all();
        return view('admin.category.index', compact('pageTitle', 'categories'));
    }

    public function save(Request $request, $id = 0)
    {
        $isRequired = $id ? 'nullable' : 'required';

        $request->validate([
            'name'      => 'required|string|unique:categories,name,' . $id,
            'icon'      => [$isRequired, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'image'     => [$isRequired, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'benefit'   => 'required|array|min:1|max:5',
            'benefit.*' => 'required|string|max:255',
        ]);

        if ($id) {
            $category = Category::find($id);
            $message  = "Category upodated successfully";
        } else {
            $category = new Category();
            $message  = "Category created successfully";
        }

        $category->name = $request->name;

        if ($request->hasFile('icon')) {
            try
            {
                $category->icon = fileUploader($request->icon, getFilePath('categoryIconImage'), getFileSize('categoryIconImage'), $category->icon);
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Icon Image could not be uploaded'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('image')) {
            try {
                $category->image = fileUploader($request->image, getFilePath('categoryImage'), getFileSize('categoryImage'), $category->image);
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }
        }

        $category->benefit = $request->benefit;
        $category->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function toggleStatus($id)
    {
        return Category::changeStatus($id);
    }

    public function toggleFeature(Request $request)
    {
        $category              = Category::findOrFail($request->id);
        $category->is_featured = $request->is_featured;
        $category->save();

        return response()->json(['message' => __('Feature status updated successfully.')]);
    }

    public function togglePopular(Request $request)
    {
        $category             = Category::findOrFail($request->id);
        $category->is_popular = $request->is_popular;
        $category->save();

        return response()->json(['message' => __('Popular status updated successfully.')]);
    }
}
