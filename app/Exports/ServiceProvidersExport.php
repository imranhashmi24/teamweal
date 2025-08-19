<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceProvidersExport implements FromCollection, WithHeadings
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = User::query();
        
        if ($this->userId) {
            $query->where('id', $this->userId);
        }
        
        $users = $query->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'country_code' => is_object($user->country_id) 
                    ? ($user->country_id->code ?? $user->country_id->id ?? null)
                    : $user->country_id,
                'mobile' => $user->mobile,
                'person_in_charge' => $user->person_in_charge,
                'company_name' => $user->company_name,
                'job_title' => $user->job_title,
                'company_activity' => $user->company_activity,
                'address_headquarter' => $user->address_headquarter,
                'age_of_company' => $user->age_of_company,
                'number_of_work_team' => $user->number_of_work_team,
                'pre_experience_project' => $user->pre_experience_project,
                'website' => $user->website,
                'services_provided' => $this->formatJsonField($user->services_provided),
                'created_at' => $user->created_at,
                'status' => $user->status,
                'ev' => $user->ev,
                'sv' => $user->sv,
                'entity_type' => $user->entity_type,
                'service_description' => $user->service_description,
                'preferred_communication' => $this->formatJsonField($user->preferred_communication),
                'best_time_to_contact' => $user->best_time_to_contact,
                'estimated_response_time' => $user->estimated_response_time,
                'commercial_registration_no' => $user->commercial_registration_no,
                'social_media' => $this->formatJsonField($user->social_media),
                'category_id' => $user->category_id
            ];
        });

        return $users;
    }

    protected function formatJsonField($value)
    {
        if (is_array($value) || is_object($value)) {
            return json_encode($value);
        }
        return $value;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Username',
            'Email',
            'Country Code',
            'Mobile',
            'Person in Charge',
            'Company Name',
            'Job Title',
            'Company Activity',
            'Address Headquarter',
            'Age of Company',
            'Number of Work Team',
            'Previous Experience Project',
            'Website',
            'Services Provided',
            'Created At',
            'Status',
            'Email Verified',
            'Mobile Verified',
            'Entity Type',
            'Service Description',
            'Preferred Communication',
            'Best Time to Contact',
            'Estimated Response Time',
            'Commercial Registration No',
            'Social Media',
            'Category ID'
        ];
    }
}