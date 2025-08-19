<!DOCTYPE html>
<html>
<head>
    <title>Service Provider Details - {{ $user->name }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px;
            line-height: 1.5;
        }
        .header { 
            text-align: center; 
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }
        .logo { 
            height: 40px;
            margin-bottom: 5px;
        }
        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .date { 
            font-size: 10px; 
            color: #666;
        }
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 5px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 5px;
            margin-bottom: 3px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .long-text {
            padding: 5px;
            border: 1px solid #eee;
            background-color: #f9f9f9;
            border-radius: 3px;
            margin-top: 5px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 15px;
            padding-top: 5px;
            border-top: 1px solid #ddd;
        }
        .status-active {
            color: green;
            font-weight: bold;
        }
        .status-banned {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="report-title">Service Provider Details</div>
        <div class="date">Generated on: {{ date('Y-m-d H:i:s') }}</div>
    </div>

    <!-- Basic Information Section -->
    <div class="section">
        <div class="section-title">Basic Information</div>
        <div class="info-grid">
            <div class="label">ID:</div>
            <div>{{ $user->id }}</div>
            
            <div class="label">Full Name:</div>
            <div>{{ $user->name }}</div>
            
            <div class="label">Username:</div>
            <div>{{ $user->username }}</div>
            
            <div class="label">Email:</div>
            <div>{{ $user->email }}</div>
            
            <div class="label">Mobile:</div>
            <div>{{ $user->mobile }}</div>
            
            <div class="label">Status:</div>
            <div class="{{ $user->status ? 'status-active' : 'status-banned' }}">
                {{ $user->status ? 'Active' : 'Banned' }}
            </div>
            
            <div class="label">Registered On:</div>
            <div>{{ $user->created_at->format('Y-m-d') }}</div>
        </div>
    </div>

    <!-- Company Information Section -->
    <div class="section">
        <div class="section-title">Company Information</div>
        <div class="info-grid">
            <div class="label">Company Name:</div>
            <div>{{ $user->company_name ?? 'N/A' }}</div>
            
            <div class="label">Entity Type:</div>
            <div>{{ $user->entity_type ?? 'N/A' }}</div>
            
            <div class="label">Commercial Reg. No:</div>
            <div>{{ $user->commercial_registration_no ?? 'N/A' }}</div>
            
            <div class="label">Company Activity:</div>
            <div>{{ $user->company_activity ?? 'N/A' }}</div>
            
            <div class="label">Years in Business:</div>
            <div>{{ $user->age_of_company ?? 'N/A' }}</div>
            
            <div class="label">Team Size:</div>
            <div>{{ $user->number_of_work_team ?? 'N/A' }}</div>
            
            <div class="label">Headquarter Address:</div>
            <div>{{ $user->address_headquarter ?? 'N/A' }}</div>
        </div>
    </div>

    <!-- Contact Information Section -->
    <div class="section">
        <div class="section-title">Contact Information</div>
        <div class="info-grid">
            <div class="label">Contact Person:</div>
            <div>{{ $user->person_in_charge ?? 'N/A' }}</div>
            
            <div class="label">Job Title:</div>
            <div>{{ $user->job_title ?? 'N/A' }}</div>
            
            <div class="label">Website:</div>
            <div>
                @if($user->website)
                    {{ $user->website }}
                @else
                    N/A
                @endif
            </div>
            
            <div class="label">Preferred Contact:</div>
            <div>{{ $user->preferred_communication ?? 'N/A' }}</div>
            
            <div class="label">Best Time to Contact:</div>
            <div>{{ $user->best_time_to_contact ?? 'N/A' }}</div>
            
            <div class="label">Response Time:</div>
            <div>{{ $user->estimated_response_time ?? 'N/A' }}</div>
            
            <div class="label">Social Media:</div>
            <div>{{ $user->social_media ?? 'N/A' }}</div>
        </div>
    </div>

    <!-- Service Information Section -->
    <div class="section">
        <div class="section-title">Service Information</div>
        <div class="info-grid">
            <div class="label">Primary Service:</div>
            <div>{{ $user->services_provided ?? 'N/A' }}</div>
            
            <div class="label">Category ID:</div>
            <div>{{ $user->category_id ?? 'N/A' }}</div>
        </div>
        
        <div style="margin-top: 10px;">
            <div class="label">Service Description:</div>
            <div class="long-text">
                {{ $user->service_description ?? 'No description provided' }}
            </div>
        </div>
        
        <div style="margin-top: 10px;">
            <div class="label">Previous Experience/Projects:</div>
            <div class="long-text">
                {{ $user->pre_experience_project ?? 'No experience provided' }}
            </div>
        </div>
    </div>

    <!-- Verification Status Section -->
    <div class="section">
        <div class="section-title">Verification Status</div>
        <div class="info-grid">
            <div class="label">Email Verification:</div>
            <div>{{ $user->ev ? 'Verified' : 'Not Verified' }}</div>
            
            <div class="label">Mobile Verification:</div>
            <div>{{ $user->sv ? 'Verified' : 'Not Verified' }}</div>
        </div>
    </div>

    <div class="footer">
        Confidential Document - {{ config('app.name') }}
    </div>
</body>
</html>