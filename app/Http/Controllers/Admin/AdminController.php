<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\TransactionModel;
use App\Models\Widget;
use App\Models\Cmscontent;
use App\Models\ContactUs;
use App\Models\User;
use App\Library\UpsShipping;
use App\Library\Clover;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;


class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //
    }


    public function dashboard()
    {
        $data = [];
        return view('admin.dashboard', $data);
    }

    public function profile()
    {
        $settings = Settings::first();
        return view('admin.profile', ['settings' => $settings]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'adminname' => 'required',
            'email' => 'required|email',
            'designation' => 'required',
        ], [
            'id.required' => 'The admin id field is required.',
            'adminname.required' => 'The admin name field is required.',
            'designation.required' => 'The admin designation field is required.',
            'email.required' => 'The email field is required.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstError = $errors->first();
            $output['res'] = 'error';
            $output['msg'] = $firstError;
        } else {
            $admin = new Admin;
            $admin = Admin::find($request->id);
            $admin->name = $request['adminname'];
            $admin->email = $request['email'];
            $admin->designation = $request['designation'];
            $admin->save();
            $output['res'] = 'success';
            $output['msg'] = 'Profile updated successfully';
        }
        echo json_encode($output);
    }

    public function changePassword(Request $request)
    {
        $admin = new Admin;
        $admin = Admin::find($request->id);
        if (Hash::check($request->old_password, $admin->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:5|confirmed', // Adding password and confirmation validation
            ], [
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least 5 characters long.',
                'password.confirmed' => 'The password confirmation does not match.',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $firstError = $errors->first();
                $output['res'] = 'error';
                $output['msg'] = $firstError;
            } else {
                // update password;
                $admin->password =  Hash::make($request->password);
                $admin->save();
                $output['res'] = 'success';
                $output['msg'] = 'password updated';
            }
        } else {
            // old password not matched;
            $output['res'] = 'error';
            $output['msg'] = 'old password not matched';
        }
        echo json_encode($output);
    }

    public function updateIcon(Request $request)
    {
        $admin = Admin::find($request->id);
        if ($request->hasFile('icon')) {
            $oldImagePath = $admin->designation_icon;
            $fileName = time() . '_' . $request->file('icon')->getClientOriginalName();
            $path = $request->file('icon')->storeAs('public/images/dashboard', $fileName);
            $filepath = 'images/dashboard/' . $fileName;
            if ($oldImagePath && Storage::exists('public/' . $oldImagePath)) {
                Storage::delete('public/' . $oldImagePath);
            }
            $output['msg'] = 'Icon updated';
        } else {
            $filepath = $admin->designation_icon;
            $output['msg'] = 'No changes';
        }
        $admin->designation_icon = $filepath;
        $admin->save();
        $output['res'] = 'success';
        echo json_encode($output);
    }




    public function updatePrifix(Request $request)
    {
        $request->validate([
            'route_web_prifix' => 'required|string|max:255',
        ]);
        $settings = Settings::first();
        $setting = Settings::find($settings->id);
        $setting->route_web_prifix = $request->route_web_prifix;
        $setting->save();
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        $url = url($setting->route_web_prifix . '/profile');
        // $url = 'http://127.0.0.1:8000/' . $setting->route_web_prifix . '/profile';
        return redirect(url($url))->with('success', 'Prefix updated successfully');
    }
}
