<?php

namespace Database\Seeders;

use App\Models\Referral;
use Illuminate\Database\Seeder;

class ReferralSeeder extends Seeder
{
    public function run(): void
    {
        Referral::create([
            'referral_date' => now()->subDays(5),
            'child_first_name' => 'Grace',
            'child_middle_name' => 'Wanjiku',
            'child_surname' => 'Mwangi',
            'child_gender' => 'Female',
            'child_date_of_birth' => now()->subYears(8)->subMonths(3),
            'child_county' => 'Nairobi',
            'child_sub_county' => 'Westlands',
            'child_village' => 'Kangemi',
            'referrer_name' => 'Mary Njeri',
            'referrer_title' => 'Social Worker',
            'referrer_organization' => 'Nairobi Children Services',
            'referrer_contact' => '+254712345678',
            'referrer_address' => 'P.O. Box 12345, Nairobi',
            'reason_for_referral' => 'Child found abandoned at Kangemi market. No family members have been located despite extensive search efforts.',
            'circumstances_leading_to_referral' => 'The child was found by market vendors early morning, crying and alone. She appears to have been there for several hours. Local community members attempted to locate family but were unsuccessful.',
            'immediate_needs' => 'Safe shelter, food, medical examination, psychological support',
            'background_information' => 'Child appears well-nourished and cared for, suggesting recent separation from family. No visible signs of abuse or neglect.',
            'current_location' => 'Temporary shelter at Nairobi Children Services',
            'current_caregiver' => 'Nairobi Children Services staff',
            'health_status' => 'Generally good health, minor cold symptoms',
            'attending_school' => true,
            'school_name' => 'Kangemi Primary School',
            'education_level' => 'Class 2',
            'family_information' => 'No family information available. Child unable to provide details about parents or relatives.',
            'family_tracing_attempted' => true,
            'family_tracing_details' => 'Community search conducted, local authorities notified, no missing child reports match this case.',
            'urgency_level' => 'High',
            'recommended_action' => 'Immediate placement in appropriate care facility while family tracing continues.',
            'status' => 'Pending',
        ]);

        Referral::create([
            'referral_date' => now()->subDays(2),
            'child_first_name' => 'Faith',
            'child_surname' => 'Akinyi',
            'child_gender' => 'Female',
            'child_estimated_age' => 12,
            'child_county' => 'Kisumu',
            'child_sub_county' => 'Kisumu Central',
            'referrer_name' => 'John Ochieng',
            'referrer_title' => 'Chief',
            'referrer_organization' => 'Kisumu County Government',
            'referrer_contact' => '+254723456789',
            'reason_for_referral' => 'Child living on the streets after death of grandmother who was her caregiver.',
            'circumstances_leading_to_referral' => 'Grandmother passed away 3 months ago. Child has been living on the streets, begging for food and sleeping in market stalls.',
            'immediate_needs' => 'Safe accommodation, medical care, education support, counseling',
            'current_location' => 'Streets of Kisumu town',
            'health_status' => 'Malnourished, needs medical attention',
            'attending_school' => false,
            'family_information' => 'Parents deceased, grandmother was sole caregiver. No known relatives in the area.',
            'family_tracing_attempted' => false,
            'urgency_level' => 'Critical',
            'recommended_action' => 'Immediate rescue and placement in care facility.',
            'status' => 'Under Review',
        ]);
    }
}