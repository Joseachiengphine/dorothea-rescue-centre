<?php

namespace Database\Seeders;

use App\Models\StreetVisit;
use Illuminate\Database\Seeder;

class StreetVisitSeeder extends Seeder
{
    public function run(): void
    {
        StreetVisit::create([
            'visit_date' => now()->subDays(10),
            'street_base_name' => 'Kangemi Market Area',
            'area_in_nairobi' => 'Kangemi',
            'contact_person' => 'Market Chairman',
            'contact_tel' => '+254712345678',
            'purpose_of_visit' => 'Routine street outreach to identify and support girls living on the streets',
            'girl_name' => 'Mary',
            'girl_age' => 14,
            'duration_in_street' => '6 months',
            'reasons_for_being_in_street' => 'Parents died in accident, no relatives to care for her. Grandmother who was caring for her also passed away recently.',
            'activities_while_in_streets' => 'Begging for food, sleeping in market stalls, sometimes helps vendors carry goods for small money',
            'drugs_girl_is_using' => 'Glue sniffing occasionally when stressed',
            'parents_guardian_name' => 'Both parents deceased, grandmother deceased',
            'rural_particulars' => 'Originally from Nyeri County, family had small farm but no relatives remain there',
            'urban_particulars' => 'Knows Kangemi area well, has connections with some market vendors who sometimes help her',
            'encounter_number' => '1st',
            'encounter_findings' => 'Girl appears malnourished but alert. Shows signs of trauma but is communicative. Expressed desire for education and stable home.',
            'recommendations' => 'Immediate medical check-up needed. Consider referral to Dorothea Rescue Centre for admission. Follow-up visit in 1 week.',
            'officer_name' => 'Jane Wanjiku',
            'officer_signature_date' => now()->subDays(10),
            'status' => 'Active',
            'next_visit_date' => now()->subDays(3),
        ]);

        StreetVisit::create([
            'visit_date' => now()->subDays(5),
            'street_base_name' => 'Kawangware Base',
            'area_in_nairobi' => 'Kawangware',
            'contact_person' => 'Community Elder',
            'contact_tel' => '+254723456789',
            'purpose_of_visit' => 'Follow-up visit to previously identified girls',
            'girl_name' => 'Grace',
            'girl_age' => 12,
            'duration_in_street' => '3 months',
            'reasons_for_being_in_street' => 'Ran away from home due to abuse by stepfather. Mother unable to protect her.',
            'activities_while_in_streets' => 'Washing clothes for people, begging, scavenging for food',
            'drugs_girl_is_using' => 'None reported',
            'parents_guardian_name' => 'Mother - Sarah Akinyi (contact difficult)',
            'rural_particulars' => 'Family originally from Kisumu, still has some relatives there',
            'urban_particulars' => 'New to Nairobi streets, still learning to survive, vulnerable to exploitation',
            'encounter_number' => '2nd',
            'encounter_findings' => 'Girl shows improvement in trust level. More willing to talk about her situation. Still fearful of returning home.',
            'recommendations' => 'Continue building trust. Explore family mediation options. Consider temporary safe house placement.',
            'officer_name' => 'Peter Mwangi',
            'officer_signature_date' => now()->subDays(5),
            'status' => 'Active',
            'next_visit_date' => now()->addDays(2),
        ]);

        StreetVisit::create([
            'visit_date' => now()->subDays(2),
            'street_base_name' => 'Mathare Base',
            'area_in_nairobi' => 'Mathare',
            'purpose_of_visit' => 'Emergency response to report of new girl on streets',
            'girl_name' => 'Faith',
            'girl_age' => 16,
            'duration_in_street' => '2 weeks',
            'reasons_for_being_in_street' => 'Kicked out of home after becoming pregnant. Family rejected her.',
            'activities_while_in_streets' => 'Trying to find work, staying with different people temporarily',
            'drugs_girl_is_using' => 'None',
            'parents_guardian_name' => 'Parents - John and Mary Ochieng (relationship strained)',
            'rural_particulars' => 'Family from Siaya County, extended family may be supportive',
            'urban_particulars' => 'Has some education (Form 2), looking for employment opportunities',
            'encounter_number' => '1st',
            'encounter_findings' => 'Pregnant girl in need of immediate medical care and safe shelter. Shows maturity and determination.',
            'recommendations' => 'Urgent referral needed for prenatal care and safe accommodation. Consider specialized program for pregnant teens.',
            'officer_name' => 'Mary Njeri',
            'officer_signature_date' => now()->subDays(2),
            'status' => 'Referred',
            'follow_up_notes' => 'Referred to Dorothea Rescue Centre for specialized care',
        ]);
    }
}