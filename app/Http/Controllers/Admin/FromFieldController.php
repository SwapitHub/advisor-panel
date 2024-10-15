<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormField;
use App\Models\Settings;
use Auth;

class FromFieldController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $options = FormField::where('user_id', $user)->paginate(10);
        $data = [
            'title' => 'Checkbox list',
            'viewurl' => route('from.field.add'),
            'editurl' => 'from.field.edit',
            'list' => $options,
            'prifix' => Settings::first()->route_web_prifix,
        ];
        return view('admin.checkboxlist', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New Option',
            'backtrack' => 'from.field.list',
            'url_action' => route('from.field.postadd'),
            'roles' => FormField::orderBy('id', 'desc')->get(),
            "obj" => '',
        ];
        return view('admin.checkboxoption', $data);
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'label' => 'required',
            'value' => 'required',
        ], [
            'label.required' => 'The Label field is required.',
            'value.required' => 'The value field is required.',
        ]);
        $checkbox = new FormField;
        $checkbox->user_id = Auth::user()->id;
        $checkbox->label = $request->label;
        $checkbox->value = $request->value;
        $checkbox->save();
        return redirect()->back()->with('success', 'Options added successfully.');
    }

    public function edit($id)
    {
        $editdata = FormField::find($id);
        if ($editdata == null) {
            return 'no data';
        }
        $data = [
            'url_action' => route('from.field.update', ['id' => $editdata['id']]),
            'backtrack' => 'from.field.list',
            'title' => 'Edit Option',
            'obj' => $editdata,
        ];
        return view('admin.checkboxoption', $data);
    }

    public function update(Request $request, $id)
    {
        $options  = FormField::find($id);
        $this->validate($request, [
            'label' => 'required',
            'value' => 'required',
        ], [
            'label.required' => 'The label field is required.',
            'value.required' => 'The value field is required.',
        ]);

        $options->user_id = Auth::user()->id;
        $options->label = $request->label;
        $options->value = $request->value;
        $options->save();
        return redirect()->back()->with('success', 'Option updated successfully.');
    }

    public function distroy($id)
    {
        if ($id) {
            $obj =  FormField::find($id);
            $obj->delete();
            $output['res'] = 'success';
            $output['msg'] = 'Data Deleted';
        } else {
            $output['res'] = 'error';
            $output['msg'] = 'Option Id Required';
        }
        echo json_encode($output);
    }
}
