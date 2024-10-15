<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TemplateContent;
use App\Models\Settings;

class TemplateContentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'distributor relationship contant',
            'list' => TemplateContent::first(),
        ];
        return view('admin.distributor_relationship', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ], [
            'content.required' => 'The content field is required.',
        ]);

        $query = TemplateContent::first();
        if ($query) {
            $query->update(['content' => $request->content]);
            $msg = 'Data updated successfully';
        } else {
            $temp = new TemplateContent;
            $temp->content = $request->content;
            $temp->save();
            $msg = 'Data inserted successfully';
        }
        return redirect()->back()->with('success', $msg);
    }
}
