<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Categories';
        $features  = Feature::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.feature.index', compact('pageTitle', 'features'));
    }

    public function save(Request $request, $id = 0)
    {
        $isRequired = $id ? 'nullable' : 'required';

        $request->validate([
            'title'    => 'required|string|unique:features,title,' . $id,
            'subtitle' => 'required|string',
            'image'    => [$isRequired, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],

        ]);

        if ($id) {
            $feature = Feature::find($id);
            $message = "Feature updated successfully";
        } else {
            $feature = new Feature();
            $message = "Fetaure created successfully";
        }

        $feature->title    = $request->title;
        $feature->subtitle = $request->subtitle;

        if ($request->hasFile('image')) {
            try {
                $feature->image = fileUploader($request->image, getFilePath('featureImage'), getFileSize('featureImage'), $feature->image);
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }
        }
        $feature->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }
}
