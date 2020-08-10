<?php

namespace App\Http\Controllers;

use App\Imports\LeadsImport;
use App\Sheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class SheetController extends Controller
{

    public function index()
    {
        return Sheet::orderBy('id', 'DESC')->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $data['file'] = $request->file('file')->storeAs('sheets', $filename, 'public');
        }

        if ($sheet = Sheet::create($data)) {

            $this->leadStore($data['file'], $sheet->id);
            return response(['status' => 'success']);
        } else {
            return response(['status' => 'error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet)
    {
        //
    }

    // public function leadStore($file, $sheet_id)
    // {

    //     $file = public_path('storage/' . $file);
    //     $customerArr = csvToArray($file);
    //     //return dd($customerArr);
    //     for ($i = 0; $i < count($customerArr); $i++) {
    //         $lead = new Lead();
    //         $lead->sheet_id = $sheet_id;
    //         $lead->source_link = $customerArr[$i]['source_link'];
    //         $lead->company_name = $customerArr[$i]['company_name'];
    //         $lead->contact_name = $customerArr[$i]['contact_name'];
    //         $lead->first_name = $customerArr[$i]['first_name'];
    //         $lead->last_name = $customerArr[$i]['last_name'];
    //         $lead->email_address = $customerArr[$i]['email_address'];
    //         $lead->title = $customerArr[$i]['title'];
    //         $lead->tag = $customerArr[$i]['tag'];
    //         $lead->phone_number = $customerArr[$i]['phone_number'];
    //         $lead->web_link = $customerArr[$i]['web_link'];
    //         $lead->review_by = $customerArr[$i]['review_by'];
    //         $lead->linkedin_link = $customerArr[$i]['linkedin_link'];
    //         $lead->company_linkedin = $customerArr[$i]['company_linkedin'];
    //         $lead->working_duration = $customerArr[$i]['working_duration'];
    //         $lead->location = $customerArr[$i]['location'];
    //         $lead->address = $customerArr[$i]['address'];
    //         $lead->city = $customerArr[$i]['city'];
    //         $lead->state = $customerArr[$i]['state'];
    //         $lead->zip_code = $customerArr[$i]['zip_code'];
    //         $lead->country = $customerArr[$i]['country'];

    //         $lead->save();

    //     }

    //     // return redirect()->back()->with('success', $i . ' Cashout request processed successfully.');
    // }

    public function leadStore($file, $sheet_id)
    {

        $file = public_path('storage/' . $file);

        Excel::import(new LeadsImport($sheet_id), $file);

    }
}
