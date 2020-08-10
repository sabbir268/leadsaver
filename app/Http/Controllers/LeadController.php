<?php

namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

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
        $title = "";
        $tags = "";
        $city = "";
        $state = "";
        $country = "";

        if ($request->has('title') && $request->title != '') {
            $title = $request->title;
        }

        if ($request->has('tag') && $request->tag != '') {
            $tags = $request->tag;
        }

        if ($request->has('city') && $request->city != '') {
            $city = $request->city;
        }

        if ($request->has('state') && $request->state != '') {
            $state = $request->state;
        }

        if ($request->has('country') && $request->country != '') {
            $country = $request->country;
        }

        $fileName = "lead" . date("d_m_Y_hms", time()) . ".xlsx";

        Excel::store(new LeadsExport($title, $tags, $city, $state, $country), $fileName, 'public');

        return "/storage/" . $fileName;
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

    public function export()
    {
        return Excel::download(new LeadsExport, 'Lead.xlsx');
    }
}
