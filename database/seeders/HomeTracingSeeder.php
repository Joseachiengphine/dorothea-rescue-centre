<?php

namespace Database\Seeders;

use App\Models\HomeTracing;
use App\Models\Child;
use Illuminate\Database\Seeder;

class HomeTracingSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing children to create home tracings for
        $children = Child::with('admission')->get();
        
        if ($children->count() > 0) {
            $child1 = $children->first();
            
            HomeTracing::create([
                'tracing_date' => now()->subDays(15),
                'child_id' => $child1->id,
                'girl_name' => $child1->full_name,
                'girl_age' => $child1->date_of_birth ? $child1->date_of_birth->age : 14,
                'home_place' => 'Nyeri County, Tetu Constituency',
                'landmark' => 'Near Tetu Secondary School, opposite the main market',
                'nearest_town' => 'Nyeri Town',
                'nearest_school' => 'Tetu Secondary School',
                'nearest_church' => 'St. Peters Catholic Church',
                'nearest_chief_name' => 'Chief Samuel Mwangi',
                'nearest_chief_office' => 'Tetu Chief Office',
                'chief_contact' => '+254722334455',
                'permission_granted' => true,
                'permission_purpose' => 'Home visit for family assessment and potential reintegration',
                'leave_from_date' => now()->addDays(5),
                'leave_to_date' => now()->addDays(8),
                'leave_duration_days' => 3,
                'expected_return_date' => now()->addDays(8),
                'expected_return_time' => '16:00',
                'parents_first_meeting_attitude' => 'Initially defensive but became more cooperative after explanation. Mother showed remorse and willingness to change. Father was more reserved but agreed to family counseling.',
                'purpose_of_visit' => 'To assess home environment, evaluate family readiness for reintegration, and establish support systems for the child\'s return.',
                'reasons_child_went_to_streets' => 'Family conflict after father lost job. Mother started drinking heavily. Child felt unwanted and unsafe at home. No proper meals or school fees.',
                'parental_guardian_relatives' => [
                    [
                        'name' => 'Mary Wanjiku (Mother)',
                        'occupation' => 'Small-scale farmer',
                        'age' => 35,
                        'contacts' => '+254712345678'
                    ],
                    [
                        'name' => 'John Mwangi (Father)',
                        'occupation' => 'Casual laborer',
                        'age' => 40,
                        'contacts' => '+254723456789'
                    ],
                    [
                        'name' => 'Grace Nyambura (Grandmother)',
                        'occupation' => 'Retired teacher',
                        'age' => 68,
                        'contacts' => '+254734567890'
                    ]
                ],
                'siblings_information' => [
                    [
                        'name' => 'Peter Mwangi',
                        'occupation_class' => 'Class 6',
                        'age' => 12,
                        'contacts' => 'Lives with parents'
                    ],
                    [
                        'name' => 'Ann Wanjiku',
                        'occupation_class' => 'Class 3',
                        'age' => 9,
                        'contacts' => 'Lives with grandmother'
                    ]
                ],
                'home_situation_observation' => 'Three-room mud house with iron sheet roof. Basic furniture present. Compound is clean and well-maintained. Family has small farm with maize and beans. Water source is 200m away. No electricity but solar panel for lighting. Family shows genuine concern for child\'s welfare. Grandmother is very supportive and offers to be primary caregiver.',
                'staff_in_charge' => 'Sister Mary Njeri',
                'staff_signature_date' => now()->subDays(15),
                'social_worker_name' => 'James Kiprotich',
                'social_worker_signature_date' => now()->subDays(14),
                'director_signature' => 'Sr. Caroline Ngatia',
                'director_signature_date' => now()->subDays(13),
                'status' => 'Completed',
                'outcome' => 'Successful Reintegration',
                'follow_up_notes' => 'Family has shown significant improvement. Father found stable employment. Mother joined support group and stopped drinking. Child successfully reintegrated and attending local school.',
                'next_visit_date' => now()->addDays(30),
            ]);
        }

        // Create another sample if we have more children
        if ($children->count() > 1) {
            $child2 = $children->skip(1)->first();
            
            HomeTracing::create([
                'tracing_date' => now()->subDays(8),
                'child_id' => $child2->id,
                'girl_name' => $child2->full_name,
                'girl_age' => $child2->date_of_birth ? $child2->date_of_birth->age : 12,
                'home_place' => 'Kisumu County, Kisumu Central',
                'landmark' => 'Behind Kisumu Boys High School, near the railway line',
                'nearest_town' => 'Kisumu Town',
                'nearest_school' => 'Kisumu Primary School',
                'nearest_church' => 'ACK St. Luke\'s Church',
                'nearest_chief_name' => 'Chief Grace Achieng',
                'nearest_chief_office' => 'Kisumu Central Chief Office',
                'chief_contact' => '+254733445566',
                'permission_granted' => false,
                'parents_first_meeting_attitude' => 'Hostile and uncooperative. Blamed child for family problems. Showed no remorse or willingness to change behavior. Mother appeared intoxicated during visit.',
                'purpose_of_visit' => 'Initial family assessment to determine suitability for reintegration.',
                'reasons_child_went_to_streets' => 'Severe physical abuse by stepfather. Mother chose stepfather over child. No food or care provided. Child feared for her safety.',
                'parental_guardian_relatives' => [
                    [
                        'name' => 'Susan Achieng (Mother)',
                        'occupation' => 'Unemployed',
                        'age' => 28,
                        'contacts' => '+254745678901'
                    ],
                    [
                        'name' => 'David Ochieng (Stepfather)',
                        'occupation' => 'Fisherman',
                        'age' => 35,
                        'contacts' => '+254756789012'
                    ]
                ],
                'siblings_information' => [
                    [
                        'name' => 'Baby Achieng',
                        'occupation_class' => 'Infant',
                        'age' => 2,
                        'contacts' => 'Lives with mother'
                    ]
                ],
                'home_situation_observation' => 'Single room rental house in poor condition. No proper sanitation. Strong smell of alcohol. Minimal furniture. No food visible. Environment unsuitable for child. Neighbors confirm ongoing domestic violence. Child safety cannot be guaranteed.',
                'staff_in_charge' => 'Brother Paul Otieno',
                'staff_signature_date' => now()->subDays(8),
                'social_worker_name' => 'Margaret Wanjala',
                'social_worker_signature_date' => now()->subDays(7),
                'director_signature' => 'Sr. Caroline Ngatia',
                'director_signature_date' => now()->subDays(6),
                'status' => 'Completed',
                'outcome' => 'Failed',
                'follow_up_notes' => 'Home environment deemed unsafe for child return. Recommend alternative care arrangement or extended stay at center. Consider legal intervention for child protection.',
                'next_visit_date' => now()->addDays(60),
            ]);
        }

        // Create a third sample - ongoing case
        if ($children->count() > 2) {
            $child3 = $children->skip(2)->first();
            
            HomeTracing::create([
                'tracing_date' => now()->subDays(3),
                'child_id' => $child3->id,
                'girl_name' => $child3->full_name,
                'girl_age' => $child3->date_of_birth ? $child3->date_of_birth->age : 16,
                'home_place' => 'Nakuru County, Nakuru Town East',
                'landmark' => 'Near Nakuru Municipal Stadium, Section 58',
                'nearest_town' => 'Nakuru Town',
                'nearest_school' => 'Nakuru Day Secondary School',
                'nearest_church' => 'PCEA Nakuru East Church',
                'nearest_chief_name' => 'Chief Robert Kimani',
                'nearest_chief_office' => 'Nakuru East Chief Office',
                'chief_contact' => '+254767890123',
                'permission_granted' => true,
                'permission_purpose' => 'Weekend visit to assess family progress and child readiness',
                'leave_from_date' => now()->addDays(2),
                'leave_to_date' => now()->addDays(4),
                'leave_duration_days' => 2,
                'expected_return_date' => now()->addDays(4),
                'expected_return_time' => '17:00',
                'parents_first_meeting_attitude' => 'Cautiously optimistic. Parents have been attending counseling sessions. Show genuine desire to rebuild relationship with child. Some tension still exists but willingness to work through issues.',
                'purpose_of_visit' => 'Progressive reintegration visit to test family dynamics and child comfort level.',
                'reasons_child_went_to_streets' => 'Parents divorced, child caught in custody battle. Emotional neglect and constant conflict at home. Child ran away to escape toxic environment.',
                'parental_guardian_relatives' => [
                    [
                        'name' => 'Jane Wanjiru (Mother)',
                        'occupation' => 'Shop keeper',
                        'age' => 32,
                        'contacts' => '+254778901234'
                    ],
                    [
                        'name' => 'Samuel Kimani (Father)',
                        'occupation' => 'Mechanic',
                        'age' => 36,
                        'contacts' => '+254789012345'
                    ]
                ],
                'siblings_information' => [
                    [
                        'name' => 'Michael Kimani',
                        'occupation_class' => 'Form 2',
                        'age' => 15,
                        'contacts' => 'Lives with father'
                    ]
                ],
                'home_situation_observation' => 'Parents now living separately but cooperating for children\'s sake. Both homes are suitable. Child will alternate between parents. Family counseling ongoing. Positive changes observed in communication patterns.',
                'staff_in_charge' => 'Sister Agnes Muthoni',
                'staff_signature_date' => now()->subDays(3),
                'social_worker_name' => 'Peter Macharia',
                'social_worker_signature_date' => now()->subDays(2),
                'status' => 'In Progress',
                'outcome' => 'Ongoing',
                'follow_up_notes' => 'Gradual reintegration plan in progress. Weekend visits going well. Child showing positive response. Plan to extend to week-long visits next month.',
                'next_visit_date' => now()->addDays(14),
            ]);
        }
    }
}