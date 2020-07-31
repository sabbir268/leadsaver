<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Lead::orderBy('id', 'DESC')->paginate(20);
    }

    public function search(Request $request)
    {
        $leads = Lead::orderBy('id', 'DESC');
        if ($request->has('title') && $request->title != '') {
            $leads->where('title', 'like', $request->title);
        }

        if ($request->has('tag') && $request->tag != '') {
            $tags = implode(",", $request->tag);
            $leads->where('tag', 'like', $tags);
        }

        if ($request->has('city') && $request->city != '') {
            $leads->where('city', 'like', $request->city);
        }

        if ($request->has('state') && $request->state != '') {
            $leads->where('state', 'like', $request->state);
        }

        if ($request->has('country') && $request->country != '') {
            $leads->where('country', 'like', $request->country);
        }

        return $leads->paginate(20);
    }

    public function csvDownload(Request $request)
    {
        $leads = Lead::orderBy('id', 'DESC');
        if ($request->has('title') && $request->title != '') {
            $leads->where('title', 'like', $request->title);
        }

        if ($request->has('tag') && $request->tag != '') {
            $tags = implode(",", $request->tag);
            $leads->where('tag', 'like', $tags);
        }

        if ($request->has('city') && $request->city != '') {
            $leads->where('city', 'like', $request->city);
        }

        if ($request->has('state') && $request->state != '') {
            $leads->where('state', 'like', $request->state);
        }

        if ($request->has('country') && $request->country != '') {
            $leads->where('country', 'like', $request->country);
        }

        // return $leads->paginate(20);

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=cashout_file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $data = $leads->select('source_link', 'company_Name', 'contact_name', 'first_name', 'last_name', 'email_address', 'title', 'tag', 'phone_number', 'web_link', 'review_by', 'linkedin_link', 'company_linkedin', 'working_duration', 'location', 'address', 'city', 'state', 'zip_code', 'country')->get();

        $columns = array('source_link', 'company_Name', 'contact_name', 'first_name', 'last_name', 'email_address', 'title', 'tag', 'phone_number', 'web_link', 'review_by', 'linkedin_link', 'company_linkedin', 'working_duration', 'location', 'address', 'city', 'state', 'zip_code', 'country');

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $item) {
                fputcsv($file, array($item->source_link, $item->company_Name, $item->contact_name, $item->first_name, $item->last_name, $item->email_address, $item->title, $item->tag, $item->phone_number, $item->web_link, $item->review_by, $item->linkedin_link, $item->company_linkedin, $item->working_duration, $item->location, $item->address, $item->city, $item->state, $item->zip_code, $item->country));
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function show(Leads $leads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leads $leads)
    {
        //
    }
}
