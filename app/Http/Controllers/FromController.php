<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteInfo;
use App\Models\FormField;
use App\Models\AdvisorClientDetails;
use Auth;

class FromController extends Controller
{
    public function index()
    {
        $data['info'] = SiteInfo::first();
        return view('baseform', $data);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'advisor_name' => 'required',
            'advoisor_designation' => 'required',
            'advoisor_phone' => 'required',
            'date' => 'required',
            'client_name' => 'required',
            'client_city' => 'required',
            'client_email' => 'required',
        ], [
            'advisor_name.required' => 'The advisor name field is required.',
            'advoisor_designation.required' => 'The advoisor designation field is required.',
            'advoisor_phone.required' => 'The advoisor phone no. field is required.',
            'date.required' => 'The date field is required.',
            'client_name.required' => 'The client name field is required.',
            'client_city.required' => 'The client city/towm field is required.',
            'client_email.required' => 'The client email field is required.',
        ]);

        $advisor_id = Auth::user()->id;

        // $is_exist = AdvisorClientDetails::where('advisor_id',$advisor_id);
        // if($is_exist)
        // {

        // }
        // else
        // {
            // insert data in db
            $advisorclient = new AdvisorClientDetails;
            $advisorclient->advisor_id = $advisor_id;
            $advisorclient->advisor_name = $request->advisor_name;
            $advisorclient->advoisor_designation = $request->advoisor_designation;
            $advisorclient->advoisor_phone = $request->advoisor_phone;
            $advisorclient->date = $request->date;
            $advisorclient->client_name = $request->client_name;
            $advisorclient->client_city = $request->client_city;
            $advisorclient->client_email = $request->client_email;
            $advisorclient->save();
            return redirect()->route('from.step2')->with('data', $advisorclient);
        // }





    }

    public function secondStep(Request $req)
    {
        $advisor_id = Auth::user()->id;
        $options = FormField::where('user_id',$advisor_id)->get();
        $data = [
            'info'=> SiteInfo::first(),
            'options'=> $options,
        ];
        return view('secondstepfrom', $data);
    }
}
