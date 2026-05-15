# Dorothea Rescue Centre - Referral System

## Overview
The Referral System automates the "DOROTHEA RESCUE CENTRE REFERRAL FORM" process, which is the first step before admission. This system allows external organizations, social workers, and community members to submit referrals for children who need care and protection.

## Features

### 1. Comprehensive Referral Form
- **Referral Information**: Date and auto-generated referral number
- **Child Information**: Complete child details including personal information, location, and physical description
- **Referrer Information**: Details about the person/organization making the referral
- **Referral Details**: Reason for referral, circumstances, immediate needs, and background information
- **Current Situation**: Child's current living conditions and caregiver information
- **Health & Education**: Health status and educational background
- **Family Information**: Family details and tracing attempts
- **Assessment**: Urgency level and recommended actions

### 2. Status Management
Referrals can have the following statuses:
- **Pending**: Initial status when referral is submitted
- **Under Review**: Referral is being evaluated by staff
- **Approved**: Referral approved for admission process
- **Rejected**: Referral not suitable for admission
- **Admitted**: Child has been successfully admitted (linked to child record)

### 3. Urgency Levels
- **Low**: Non-urgent cases
- **Medium**: Standard priority (default)
- **High**: Requires prompt attention
- **Critical**: Immediate action required

### 4. Workflow Integration
- Referrals appear first in the Admissions navigation group
- Approved referrals can be converted to child admission records
- Automatic data transfer from referral to child record
- Status tracking and review history

## Usage

### Creating a Referral
1. Navigate to **Admissions > Referrals**
2. Click **New Referral**
3. Complete the wizard form with all available information
4. Submit the referral (status will be set to "Pending")

### Managing Referrals
1. **View Referrals**: See all referrals in the table with key information
2. **Filter**: Filter by status, urgency level, or other criteria
3. **Quick Status Update**: Update status directly from the table
4. **Detailed View**: Click on a referral to see complete information

### Converting to Admission
1. Open an **Approved** referral
2. Click **Convert to Admission**
3. System creates a child record with referral data
4. Referral status changes to "Admitted"
5. Redirects to child admission form to complete the process

## Data Fields

### Child Information
- Name (first, middle, surname, nickname)
- Gender (Female only for Dorothea)
- Date of birth or estimated age
- Physical features and description
- Location details (county, sub-county, village, etc.)
- Ethnicity and religion

### Referrer Information
- Name, title, and organization
- Contact information and address
- Relationship to child

### Assessment Information
- Reason for referral
- Circumstances leading to referral
- Immediate needs
- Background information
- Current living situation
- Health and education status
- Family information and tracing details
- Urgency level and recommendations

## Benefits

1. **Standardized Process**: Ensures all necessary information is collected
2. **Efficient Workflow**: Streamlines the referral-to-admission process
3. **Status Tracking**: Clear visibility of referral progress
4. **Data Integration**: Seamless transfer to admission records
5. **Priority Management**: Urgency levels help prioritize cases
6. **Audit Trail**: Complete history of referral decisions and actions

## Navigation
- **Referrals** appear first in the Admissions group (sort order: 1)
- **Children** appear second in the Admissions group (sort order: 2)

This ensures the proper workflow: Referral → Review → Approval → Admission