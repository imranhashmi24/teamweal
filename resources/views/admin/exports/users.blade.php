<table>
    <thead>
    <tr>
        <th>@lang('Id')</th>
        <th>@lang('Name')</th>
        <th>@lang('Username ')</th>
        <th>@lang('Email')</th>
        <th>@lang('Country code')</th>
        <th>@lang('Mobile')</th>
        <th>@lang('Person in charge')</th>
        <th>@lang('Company name')</th>
        <th>@lang('Job Title')</th>
        <th>@lang('Company Activity')</th>
        <th>@lang('Address headquarter')</th>
        <th>@lang('Age of company')</th>
        <th>@lang('Number of work team')</th>
        <th>@lang('Pre experience project')</th>
        <th>@lang('Website')</th>
        <th>@lang('Services provided')</th>
        <th>@lang('Address')</th>
        <th>@lang('Created At')</th>
        <th>@lang('Status')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->country_code }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->person_in_charge }}</td>
            <td>{{ $user->company_name }}</td>
            <td>{{ $user->job_title }}</td>
            <td>{{ $user->company_activity }}</td>
            <td>{{ $user->address_headquarter }}</td>
            <td>{{ $user->age_of_company }}</td>
            <td>{{ $user->number_of_work_team }}</td>
             <td>{{ $user->pre_experience_project }}</td>
            <td>{{ $user->website }}</td>
            <td>{{ $user->services_provided }}</td>
            <td>
               @if($user->address)
                    @php
                        // Check if the address is an array or object
                        if (is_array($user->address) || is_object($user->address)) {
                            $addresses = $user->address;
                        } else {
                            // If it's a JSON string, decode it
                            $addresses = json_decode($user->address, true);
                        }
                    @endphp
                
                    @if(is_array($addresses))
                        @foreach ($addresses as $u_address)
                            {{ $u_address }},
                        @endforeach
                    @endif
                @endif
            </td>
            <td>{{ $user->created_at->format('d-m-Y') }}</td>
            <td>@if($user->status == 1) Active @endif </td>
        </tr>
    @endforeach
    </tbody>
</table>
