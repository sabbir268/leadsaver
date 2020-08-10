<?php

namespace App\Exports;

use App\Lead;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct($title = "", $tag = "", $city = "", $state = "", $country = "")
    {
        $this->title = $title;
        $this->tag = $tag;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    public function headings(): array
    {
        return [
            '#', 'sheet_id', 'source_link', 'company_name', 'contact_name', 'first_name', 'last_name', 'email_address', 'title', 'tag', 'phone_number', 'web_link', 'review_by', 'linkedin_link', 'company_linkedin', 'working_duration', 'location', 'address', 'city', 'state', 'zip_code', 'country', 'created_at', 'updated_at',
        ];
    }

    public function query()
    {
        $leads = Lead::query()->orderBy('id', 'ASC');

        if ($this->title != '') {
            $leads->where('title', 'like', $this->title);
        }

        if ($this->tag != '') {
            $tags = implode(",", $this->tag);
            $leads->where('tag', 'like', $tags);
        }

        if ($this->city != '') {
            $leads->where('city', 'like', $this->city);
        }

        if ($this->state != '') {
            $leads->where('state', 'like', $this->state);
        }

        if ($this->country != '') {
            $leads->where('country', 'like', $this->country);
        }
        return $leads;
    }
}
