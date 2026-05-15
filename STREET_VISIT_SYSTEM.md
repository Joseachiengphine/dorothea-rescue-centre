# Dorothea Rescue Centre - Street Visit System

## Overview
The Street Visit System automates the "STREET VISIT FORM" process, which is the very first step in identifying and documenting girls living on the streets. This system enables outreach officers to systematically record encounters with street girls and track their progress through multiple visits.

## Purpose
This tool is used to collect information about girls who are on the streets for identification and recruitment purposes, serving as the entry point into the care system.

## Features

### 1. Comprehensive Street Visit Form
- **Visit Information**: Date, auto-generated visit number, and encounter tracking (1st, 2nd, 3rd)
- **Street/Base Information**: Location details, contact persons, and purpose of visit
- **Girl Identification**: Name, age, duration on street, and reasons for being there
- **Activities & Circumstances**: Street activities, substance use, and family information
- **Background Information**: Rural and urban particulars
- **Findings & Recommendations**: Encounter results and recommended actions
- **Officer Information**: Officer details and signature date

### 2. Multi-Encounter Tracking
The system tracks multiple encounters with the same girl:
- **1st Encounter**: Initial contact and assessment
- **2nd Encounter**: Follow-up and trust building
- **3rd Encounter**: Final assessment and decision making

### 3. Status Management
Street visits can have the following statuses:
- **Active**: Ongoing case, more visits planned
- **Referred**: Girl has been referred to the formal referral system
- **Lost Contact**: Unable to locate girl for follow-up
- **Completed**: Case closed successfully

### 4. Workflow Integration
- Street Visits appear first in the Admissions navigation group (sort order: 0)
- Active street visits can be converted to formal referrals
- Automatic data transfer from street visit to referral record
- Follow-up scheduling and tracking

## Usage

### Creating a Street Visit
1. Navigate to **Admissions > Street Visits**
2. Click **New Street Visit**
3. Complete the wizard form with all encounter information
4. Submit the visit record

### Managing Street Visits
1. **View Visits**: See all visits in the table with key information
2. **Filter**: Filter by status, encounter number, or area
3. **Quick Status Update**: Update status and next visit date from table
4. **Detailed View**: Click on a visit to see complete information

### Converting to Referral
1. Open an **Active** street visit
2. Click **Create Referral**
3. System creates a referral record with street visit data
4. Street visit status changes to "Referred"
5. Redirects to referral view to complete the process

## Data Fields

### Visit Information
- Visit date and auto-generated visit number
- Encounter number (1st, 2nd, 3rd)
- Status tracking

### Street/Base Information
- Street/base name and area in Nairobi
- Contact person and telephone
- Purpose of visit explanation

### Girl Identification
- Name and age of the girl
- Duration living on the street
- Reasons for being on the street
- Current activities and circumstances
- Substance use information
- Parents/guardian information

### Background Information
- Rural particulars (family background, origins)
- Urban particulars (connections, survival strategies)

### Assessment Information
- Encounter findings and observations
- Recommendations for next steps
- Follow-up planning and notes
- Next visit scheduling

### Officer Information
- Officer name and signature date
- Follow-up responsibility

## Workflow Process

### Step 1: Street Identification
- Officers conduct street visits to identify girls
- Document initial contact and basic information
- Assess immediate needs and safety

### Step 2: Trust Building
- Multiple encounters to build trust
- Gather more detailed background information
- Assess readiness for intervention

### Step 3: Decision Making
- Evaluate suitability for referral
- Document comprehensive assessment
- Make recommendations for next steps

### Step 4: Referral Creation
- Convert successful street visits to formal referrals
- Transfer all collected information
- Begin formal admission process

## Benefits

1. **Systematic Approach**: Ensures consistent data collection across all street encounters
2. **Multi-Visit Tracking**: Supports relationship building through multiple encounters
3. **Progress Monitoring**: Clear visibility of case progression and outcomes
4. **Data Integration**: Seamless transfer to referral and admission systems
5. **Officer Accountability**: Clear documentation of officer activities and decisions
6. **Area Mapping**: Tracks street activity across different areas of Nairobi

## Navigation Priority
- **Street Visits** (sort order: 0) - appears first
- **Referrals** (sort order: 1) - appears second  
- **Children** (sort order: 2) - appears third

This ensures the proper workflow: Street Visit → Referral → Admission

## Reporting Capabilities
- Track encounter success rates
- Monitor area-specific activities
- Officer performance tracking
- Conversion rates from street visits to referrals
- Follow-up compliance monitoring