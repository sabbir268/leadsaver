<?php

namespace App\Imports;

use App\Lead;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{

    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function __construct(int $sheet_id)
    {
        $this->sheet_id = $sheet_id;
    }

    public function model(array $row)
    {
        return new Lead([
            'sheet_id' => $this->sheet_id,
            'source_link' => $row['source_link'],
            'company_name' => $row['company_name'],
            'contact_name' => $row['contact_name'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email_address' => $row['email_address'],
            'title' => $row['title'],
            'tag' => $row['tag'],
            'phone_number' => $row['phone_number'],
            'web_link' => $row['web_link'],
            'review_by' => $row['review_by'],
            'linkedin_link' => $row['linkedin_link'],
            'company_linkedin' => $row['company_linkedin'],
            'working_duration' => $row['working_duration'],
            'location' => $row['location'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip_code' => $row['zip_code'],
            'country' => $row['country'],
        ]);
    }
}
