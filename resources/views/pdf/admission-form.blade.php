<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dorothea Rescue Centre - Admission Form</title>
    <style>
        @page {
            margin: 15mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #000;
        }
        .header {
            border: 2px solid #4E1B1B;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
        }
        .header-top {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .header-logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
            padding-right: 15px;
        }
        .header-logo img {
            max-width: 80px;
            max-height: 80px;
        }
        .header-title {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .header-title h1 {
            color: #4E1B1B;
            margin: 0;
            font-size: 20pt;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .header-title h2 {
            color: #000;
            margin: 5px 0 0 0;
            font-size: 14pt;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .header-bottom {
            border-top: 1px solid #4E1B1B;
            padding-top: 8px;
            margin-top: 10px;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #29AB87;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12pt;
            border-radius: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field-group {
            display: table;
            width: 100%;
            margin-bottom: 10px;
            border-collapse: separate;
            border-spacing: 0;
        }
        .field {
            display: table-row;
        }
        .field-label {
            display: table-cell;
            font-weight: bold;
            width: 40%;
            padding: 6px 8px;
            vertical-align: top;
            border-bottom: 1px solid #e0e0e0;
            background-color: #f9f9f9;
        }
        .field-value {
            display: table-cell;
            padding: 6px 8px;
            vertical-align: top;
            border-bottom: 1px solid #e0e0e0;
            border-left: 1px solid #e0e0e0;
        }
        .field-value:empty::after {
            content: "________________";
            color: #999;
        }
        .field:last-child .field-label,
        .field:last-child .field-value {
            border-bottom: none;
        }
        .signature-section {
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .signature-box {
            display: inline-block;
            width: 30%;
            margin: 10px 1%;
            vertical-align: top;
            border: 1px solid #000;
            padding: 10px;
            min-height: 80px;
        }
        .signature-box .name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .signature-box .signature {
            border-top: 1px solid #000;
            margin-top: 40px;
            padding-top: 5px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 9pt;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
        }
        table th {
            background-color: #29AB87;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 5px;
        }
        .checkbox.checked::after {
            content: "✓";
            position: absolute;
            margin-left: -10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-top">
            <div class="header-logo">
                @php
                    $logoPath = public_path('images/dorothea_rescue_logo.jpeg');
                @endphp
                @if(file_exists($logoPath))
                <img src="{{ $logoPath }}" alt="Dorothea Rescue Centre Logo">
                @endif
            </div>
            <div class="header-title">
                <h1>DOROTHEA RESCUE CENTRE</h1>
                <h2>ADMISSION FORM</h2>
            </div>
        </div>
        <div class="header-bottom">
            <strong>Official Admission Document</strong>
        </div>
    </div>

    <!-- Child Information -->
    <div class="section">
        <div class="section-title">1. CHILD INFORMATION</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">First Name:</div>
                <div class="field-value">{{ $child->first_name ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Middle Name:</div>
                <div class="field-value">{{ $child->middle_name ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Surname:</div>
                <div class="field-value">{{ $child->surname ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Nickname / Likes to be called:</div>
                <div class="field-value">{{ $child->nickname ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Sex:</div>
                <div class="field-value">{{ $child->gender ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Date of Birth:</div>
                <div class="field-value">{{ $child->date_of_birth ? $child->date_of_birth->format('d/m/Y') : '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Ethnicity:</div>
                <div class="field-value">{{ $child->ethnicity ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Religion:</div>
                <div class="field-value">{{ $child->religion ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Complexion:</div>
                <div class="field-value">{{ $child->complexion ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Distinguish Physical Features:</div>
                <div class="field-value">{{ $child->physical_features ?? '' }}</div>
            </div>
        </div>
    </div>

    <!-- Place of Birth -->
    <div class="section">
        <div class="section-title">2. PLACE OF BIRTH</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">County:</div>
                <div class="field-value">{{ $child->place_of_birth_county ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Sub-County:</div>
                <div class="field-value">{{ $child->sub_county ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Village:</div>
                <div class="field-value">{{ $child->village ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Sub-location:</div>
                <div class="field-value">{{ $child->sub_location ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Landmark:</div>
                <div class="field-value">{{ $child->landmark ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Place of Birth Known:</div>
                <div class="field-value">{{ $child->place_of_birth_known ? 'Yes' : 'No' }}</div>
            </div>
        </div>
    </div>

    <!-- Admission Details -->
    @if($child->admission)
    <div class="section">
        <div class="section-title">3. ADMISSION DETAILS</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">Date of Admission:</div>
                <div class="field-value">{{ $child->admission->date_of_admission ? \Carbon\Carbon::parse($child->admission->date_of_admission)->format('d/m/Y') : '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Age at Admission:</div>
                <div class="field-value">{{ $child->admission->age_at_admission ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Other Forms of Admission:</div>
                <div class="field-value">{{ $child->admission->other_forms_of_admission ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Admission Order Issued:</div>
                <div class="field-value">{{ $child->admission->admission_order_issued ? 'Yes' : 'No' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Committal Order #:</div>
                <div class="field-value">{{ $child->admission->committal_order_no ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Date of Committal:</div>
                <div class="field-value">{{ $child->admission->date_of_committal ? \Carbon\Carbon::parse($child->admission->date_of_committal)->format('d/m/Y') : '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">O.B Number:</div>
                <div class="field-value">{{ $child->admission->ob_number ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Referred By:</div>
                <div class="field-value">{{ $child->admission->referred_by_name ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Title:</div>
                <div class="field-value">{{ $child->admission->referred_by_title ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Relationship to Child:</div>
                <div class="field-value">{{ $child->admission->relationship_to_child ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Contact:</div>
                <div class="field-value">{{ $child->admission->contact ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Location:</div>
                <div class="field-value">{{ $child->admission->location ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Address of Current Care Provider:</div>
                <div class="field-value">{{ $child->admission->address_of_current_care_provider ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Current Care Type:</div>
                <div class="field-value">{{ $child->admission->current_care_type ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Current Care Address:</div>
                <div class="field-value">{{ $child->admission->current_care_address ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Registration Status:</div>
                <div class="field-value">{{ $child->admission->registration_status ?? '' }}</div>
            </div>
            @if($child->admission->admissionReasons && $child->admission->admissionReasons->count() > 0)
            <div class="field">
                <div class="field-label">Reasons for Admission:</div>
                <div class="field-value">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($child->admission->admissionReasons as $reason)
                            <li>{{ $reason->reason }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Rescue & Case History -->
    @if($child->rescueDetail)
    <div class="section">
        <div class="section-title">4. RESCUE & CASE HISTORY</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">Found By:</div>
                <div class="field-value">{{ $child->rescueDetail->found_by ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Found Location:</div>
                <div class="field-value">{{ $child->rescueDetail->found_location ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Date Found:</div>
                <div class="field-value">{{ $child->rescueDetail->date_found ? \Carbon\Carbon::parse($child->rescueDetail->date_found)->format('d/m/Y') : '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Case History:</div>
                <div class="field-value">{{ $child->rescueDetail->case_history ?? '' }}</div>
            </div>
        </div>
        @if($child->previousPlacements && $child->previousPlacements->count() > 0)
        <div style="margin-top: 10px;">
            <strong>Previous Placements:</strong>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($child->previousPlacements as $placement)
                    <tr>
                        <td>{{ $placement->placement_type ?? '' }}</td>
                        <td>{{ $placement->from ? \Carbon\Carbon::parse($placement->from)->format('d/m/Y') : '' }}</td>
                        <td>{{ $placement->to ? \Carbon\Carbon::parse($placement->to)->format('d/m/Y') : '' }}</td>
                        <td>{{ $placement->notes ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @endif

    <!-- Education Background -->
    @if($child->educationBackground)
    <div class="section">
        <div class="section-title">5. EDUCATION BACKGROUND</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">Previously Attended School:</div>
                <div class="field-value">{{ $child->educationBackground->previously_attended ? 'Yes' : 'No' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Previous School Name:</div>
                <div class="field-value">{{ $child->educationBackground->previous_school_name ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Previous School Location:</div>
                <div class="field-value">{{ $child->educationBackground->previous_school_location ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Previous School Type:</div>
                <div class="field-value">{{ $child->educationBackground->previous_school_type ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Previous School Day/Boarding:</div>
                <div class="field-value">{{ $child->educationBackground->previous_school_day_boarding ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Currently Attending School:</div>
                <div class="field-value">{{ $child->educationBackground->currently_attending ? 'Yes' : 'No' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Current School Name:</div>
                <div class="field-value">{{ $child->educationBackground->current_school_name ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Current School Location:</div>
                <div class="field-value">{{ $child->educationBackground->current_school_location ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Current School Type:</div>
                <div class="field-value">{{ $child->educationBackground->current_school_type ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Current School Day/Boarding:</div>
                <div class="field-value">{{ $child->educationBackground->current_school_day_boarding ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Education Level:</div>
                <div class="field-value">{{ $child->educationBackground->education_level ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Level Detail (ECD/Grade/Form/Vocational/Tertiary):</div>
                <div class="field-value">{{ $child->educationBackground->current_education_level_detail ?? '' }}</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Family Information -->
    <div class="section">
        <div class="section-title">6. FAMILY INFORMATION</div>
        
        @if($child->parents && $child->parents->count() > 0)
        <div style="margin-bottom: 15px;">
            <strong>Parents:</strong>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Other Names</th>
                        <th>Last Known Location</th>
                        <th>Contact</th>
                        <th>Occupation/Education</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($child->parents as $parent)
                    <tr>
                        <td>{{ $parent->type ?? '' }}</td>
                        <td>{{ $parent->name ?? '' }}</td>
                        <td>{{ $parent->other_names ?? '' }}</td>
                        <td>{{ $parent->last_known_location ?? '' }}</td>
                        <td>{{ $parent->contact ?? '' }}</td>
                        <td>{{ $parent->occupation_or_education ?? '' }}</td>
                        <td>{{ $parent->status ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if($child->siblings && $child->siblings->count() > 0)
        <div>
            <strong>Siblings:</strong>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Last Known Location</th>
                        <th>Contact</th>
                        <th>Occupation/Education</th>
                        <th>Living with Child</th>
                        <th>Admitted Elsewhere</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($child->siblings as $sibling)
                    <tr>
                        <td>{{ $sibling->name ?? '' }}</td>
                        <td>{{ $sibling->age ?? '' }}</td>
                        <td>{{ $sibling->last_known_location ?? '' }}</td>
                        <td>{{ $sibling->contact ?? '' }}</td>
                        <td>{{ $sibling->occupation_or_education ?? '' }}</td>
                        <td>{{ $sibling->living_with_child ? 'Yes' : 'No' }}</td>
                        <td>{{ $sibling->admitted_elsewhere ? 'Yes' : 'No' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Health Information -->
    @if($child->healthRecord)
    <div class="section">
        <div class="section-title">7. HEALTH INFORMATION</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">Hospitalized:</div>
                <div class="field-value">{{ $child->healthRecord->hospitalized ? 'Yes' : 'No' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Illness:</div>
                <div class="field-value">{{ $child->healthRecord->illness ?? '' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Health Notes:</div>
                <div class="field-value">{{ $child->healthRecord->health_notes ?? '' }}</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Signatures -->
    @if($child->signatures && $child->signatures->count() > 0)
    <div class="section signature-section">
        <div class="section-title">8. SIGNATURES</div>
        <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
            @foreach($child->signatures as $signature)
            <div class="signature-box">
                <div class="name">{{ $signature->role ?? '' }}</div>
                <div>{{ $signature->name ?? '' }}</div>
                <div style="margin-top: 5px; font-size: 9pt;">Date: {{ $signature->signed_date ? \Carbon\Carbon::parse($signature->signed_date)->format('d/m/Y') : '' }}</div>
                @if($signature->signature_file)
                <div class="signature">
                    @php
                        $signaturePath = storage_path('app/public/' . $signature->signature_file);
                        if (!file_exists($signaturePath)) {
                            $signaturePath = public_path('storage/' . $signature->signature_file);
                        }
                    @endphp
                    @if(file_exists($signaturePath))
                    <img src="{{ $signaturePath }}" alt="Signature" style="max-width: 100%; max-height: 50px;">
                    @else
                    <div style="font-size: 9pt; color: #999;">Signature image not found</div>
                    @endif
                </div>
                @else
                <div class="signature">Signature</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="footer">
        <p>Generated on {{ now()->format('d/m/Y H:i') }}</p>
        <p>Dorothea Rescue Centre - Admission Form</p>
    </div>
</body>
</html>

