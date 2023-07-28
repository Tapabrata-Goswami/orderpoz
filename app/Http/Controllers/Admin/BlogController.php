<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\blog;
use App\CPU\ImageManager;

class BlogController extends Controller
{
    public function blog_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $blog = blog::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('blog_title', 'like', "%{$value}%")->orWhere('blog_person', 'like', "%{$value}%")->orWhere('blog_description', 'like', "%{$value}%");
                }
            })->orderBy('blog_id', 'desc');
            $query_param = ['search' => $request['search']];
        }else{
            $blog = blog::orderBy('blog_id', 'desc');
        }
        $blog = $blog->paginate(config('default_pagination'))->appends($query_param);

        return view('Admin.blog', compact('blog','search'));
    }

    public function insert_blog(Request $request)
    {
        $data = new blog();
        $data->blog_title = $request->blog_title;
        $data->blog_person = $request->blog_person;
        $data->blog_description = $request->blog_description;
        $data->blog_image = ImageManager::upload('modal/', 'png', $request->file('image'));
        $data->save();

        Toastr::success('Success! Blog Inserted');
        return redirect()->back();
    }

    public function update_blog_status($blog_id,$blog_status)
    {
        $data = blog::find($blog_id);
        $data->blog_status=$blog_status;
        $data->save();

        Toastr::success('Success! Status updated');
        return redirect()->back();
    }


    public function update_blog(Request $request)
    {
        $data = blog::find($request->blog_id);
        if ($request->has('image')) {
            $data->blog_image = ImageManager::update('modal/', $data['blog_image'], 'png', $request->file('image'));
         }
        $data->blog_title = $request->blog_title;
        $data->blog_person = $request->blog_person;
        $data->blog_description = $request->blog_description;
        $data->save();

        Toastr::success('Success! Blog updated');
        return redirect()->back();
    }

    public function delete_blog($blog_id)
    {
        $blog=blog::find($blog_id);
        ImageManager::delete($blog['blog_image']);
        $blog->delete();
        Toastr::success('Success! Deleted');
        return redirect()->back();
    }
}
