<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Homepage_setting;
use App\Models\Popup_setting;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Testimonial;
use DB;
use Illuminate\Http\Request;
use Validator;

class WebsettingController extends Controller
{
    public function hero_setting()
    {
        $homepage_setting = Homepage_setting::first();
        return view('dashboard.hero_setting')->with('homepage_setting', $homepage_setting);
    }

    public function category_setting()
    {
        $homepage_setting = Homepage_setting::first();
        $category = Category::all();
        return view('dashboard.category_setting')->with('homepage_setting', $homepage_setting)->with('category', $category);
    }

    public function news_setting()
    {
        $news = News::all();
        return view('dashboard.news_setting')->with('news', $news);
    }

    public function add_news()
    {
        return view('dashboard.add_news');
    }

    public function add_news_api()
    {
        $title = request()->title ? request()->title : ' ';
        $description = request()->description ? request()->description : ' ';
        $status = request()->status ? request()->status : ' ';
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'created' => $today
        ];
        return News::insert($inputs);
    }

    public function edit_news($id)
    {
        $news =  News::where("id", "=", $id)->first();
        return view('dashboard.edit_news')->with('news', $news);
    }

    public function edit_news_api()
    {
        $id = request()->id;
        $news = News::find($id);
        $news->title = request()->title;
        $news->status = request()->status;
        $news->description = request()->description;
        $news->modified = date("Y-n-j H:i:s");
        $news->save();
        if ($news->wasChanged()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function del_news_api()
    {
        $id = request()->id;
        $news = News::find($id);
        return $news->delete();
    }

    public function announcements_setting()
    {
        $announcement = Announcement::all();
        return view('dashboard.announcements_setting')->with('announcement', $announcement);
    }

    public function add_announcements()
    {
        return view('dashboard.add_announcements');
    }

    public function add_announcements_api()
    {
        $title = request()->title ? request()->title : ' ';
        $description = request()->description ? request()->description : ' ';
        $status = request()->status ? request()->status : ' ';
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'created' => $today
        ];
        return Announcement::insert($inputs);
    }

    public function edit_announcements($id)
    {
        $announcements =  Announcement::where("id", "=", $id)->first();
        return view('dashboard.edit_announcements')->with('announcements', $announcements);
    }

    public function edit_announcements_api()
    {
        $id = request()->id;
        $announcements = Announcement::find($id);
        $announcements->title = request()->title;
        $announcements->status = request()->status;
        $announcements->description = request()->description;
        $announcements->modified = date("Y-n-j H:i:s");
        $announcements->save();
        if ($announcements->wasChanged()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function del_announcements_api()
    {
        $id = request()->id;
        $announcements = Announcement::find($id);
        return $announcements->delete();
    }

    public function testimonials_setting()
    {
        $testimonials = Testimonial::all();
        return view('dashboard.testimonials_setting')->with('testimonials', $testimonials);
    }

    public function add_testimonials()
    {
        return view('dashboard.add_testimonials');
    }

    public function add_testimonials_api()
    {
        $title = request()->title ? request()->title : ' ';
        $description = request()->description ? request()->description : ' ';
        $status = request()->status ? request()->status : ' ';
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'created' => $today
        ];
        return Testimonial::insert($inputs);
    }

    public function edit_testimonials($id)
    {
        $testimonials =  Testimonial::where("id", "=", $id)->first();
        return view('dashboard.edit_testimonials')->with('testimonials', $testimonials);
    }

    public function edit_testimonials_api()
    {
        $id = request()->id;
        $testimonials = Testimonial::find($id);
        $testimonials->title = request()->title;
        $testimonials->status = request()->status;
        $testimonials->description = request()->description;
        $testimonials->modified = date("Y-n-j H:i:s");
        $testimonials->save();
        if ($testimonials->wasChanged()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function del_testimonials_api()
    {
        $id = request()->id;
        $testimonials = Testimonial::find($id);
        return $testimonials->delete();
    }

    public function modal_setting()
    {
        $homepage_setting = Homepage_setting::first();
        return view('dashboard.modal_setting')->with('homepage_setting', $homepage_setting);
    }

    public function imgbar_setting()
    {
        $homepage_setting = Homepage_setting::first();
        return view('dashboard.imgbar_setting')->with('homepage_setting', $homepage_setting);
    }

    public function sideimg_setting()
    {
        $homepage_setting = Homepage_setting::first();
        return view('dashboard.sideimg_setting')->with('homepage_setting', $homepage_setting);
    }

    public function save_news_setting()
    {
        $news = request()->news;
        $testiminal = request()->testiminal;
        $announcements = request()->announcements;
        return DB::statement("UPDATE homepage_settings SET news = '{$news}', testiminal = '{$testiminal}', announcements = '{$announcements}'  where id = 1");
    }

    public function save_testimonials_setting()
    {
    }

    public function save_announcements_setting()
    {
    }

    public function save_category_setting()
    {
        $category = request()->category;
        $category_val = request()->category_val;
        return DB::statement("UPDATE homepage_settings SET {$category} = '{$category_val}' where id = 1");
    }

    public function save_category_image(Request $request)
    {
        $filename = Homepage_setting::first()->pluck($request->input('id'));
        if ($request->file('upload_files')) {
            $validation = Validator::make($request->all(), [
                'upload_files' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            ]);
            if ($validation->passes()) {
                if (file_exists('upload/website-setting-images/' . $filename[0])) {
                    unlink('upload/website-setting-images/' . $filename[0]);
                }
                $image = $request->file('upload_files');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/website-setting-images'), $new_name);

                DB::statement("UPDATE homepage_settings SET {$request->input('id')} = '{$new_name}' where id = 1");

                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function save_hero_title()
    {
        $hero_title = request()->hero_title;
        $hero_title_val = request()->hero_title_val;

        return DB::statement("UPDATE homepage_settings SET {$hero_title} = '" . addslashes($hero_title_val) . "' WHERE id = 1");
    }

    public function save_hero_text()
    {
        $hero_text = request()->hero_text;
        $hero_text_val = request()->hero_text_val;
        return DB::statement("UPDATE homepage_settings SET {$hero_text} = '{$hero_text_val}' where id = 1");
    }

    public function save_hero_image(Request $request)
    {
        $filename = Homepage_setting::first()->pluck($request->input('id'));
        if ($request->file('upload_files')) {
            $validation = Validator::make($request->all(), [
                'upload_files' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            ]);
            if ($validation->passes()) {
                if (file_exists('upload/website-setting-images/' . $filename[0])) {
                    unlink('upload/website-setting-images/' . $filename[0]);
                }
                $image = $request->file('upload_files');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/website-setting-images'), $new_name);

                DB::statement("UPDATE homepage_settings SET {$request->input('id')} = '{$new_name}' where id = 1");

                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function save_other_img(Request $request)
    {
        $filename = Homepage_setting::first();
        if ($request->file('upload_files')) {
            $validation = Validator::make($request->all(), [
                'upload_files' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            ]);
            if ($validation->passes()) {
                if (file_exists('upload/website-setting-images/'. $filename[$request->input('id')])) {
                    unlink('upload/website-setting-images/' . $filename[$request->input('id')]);
                }
                $image = $request->file('upload_files');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/website-setting-images'), $new_name);

                DB::statement("UPDATE homepage_settings SET {$request->input('id')} = '{$new_name}' where id = 1");
                // DB::statement("UPDATE homepage_settings SET {$request->input('id')} = '{$new_name}' where id = 1");

                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function popup_setting()
    {
        $popData = Popup_setting::all();
        return view('dashboard.popup_setting')->with('getData', $popData);
    }

    public function edit_popup_setting($rid)
    {
      $getData=Popup_setting::find($rid);
      return view('dashboard.edit_popup_setting')->with('getData', $getData);
    }

    public function save_popup_image(Request $request)
    {
        $rid=$request->input('row_id');
        $filename = Popup_setting::find($rid);
        if ($request->file('upload_files')) {
            $validation = Validator::make($request->all(), [
                'upload_files' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            ]);
            if ($validation->passes()) {
                if (file_exists('upload/popup_imagesp/' . $filename->image)) {
                    unlink('upload/popup_imagesp/' . $filename->image);
                }
                $image = $request->file('upload_files');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/popup_images'), $new_name);
                $row_id=$request->input('row_id');
                DB::statement("UPDATE popup_setting SET `image` = '$new_name' where `id` ='$row_id'");

                return redirect('websetting/popup-setting');
            } else {
           
                return redirect('websetting/edit-popup/'.$rid);
            }
        } else {
                
                return redirect('websetting/edit-popup/'.$rid);
        }
    }

    public function remove_img(Request $request) {
        DB::statement("UPDATE homepage_settings SET {$request->name} = '' where id = 1");
        return imgbar_setting();
    }

    // public function reload() {
    //     return 
    // }

    public function popup_status_toggle(Request $r)
    {
       $action=$r->input('act');
       $id=$r->input('id');

       switch($action)
       {
        case 1:
           DB::statement("UPDATE popup_setting SET `status` = '1' where `id` ='$id'");
        break;

        case 2:
          DB::statement("UPDATE popup_setting SET `status` = '2' where `id` ='$id'");
        break;
       }
    }
}
