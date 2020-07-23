<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;

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
            $leads->orWhere('title', 'like', $request->title);
        }

        if ($request->has('tag') && $request->tag != '') {
            $tags = \implode(",", $request->tag);
            $leads->orWhere('tag', 'like', $tags);
        }

        if ($request->has('city') && $request->city != '') {
            $leads->orWhere('city', 'like', $request->city);
        }

        if ($request->has('state') && $request->state != '') {
            $leads->orWhere('state', 'like', $request->state);
        }

        if ($request->has('country') && $request->country != '') {
            $leads->orWhere('country', 'like', $request->country);
        }

        return $leads->paginate(20);
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
