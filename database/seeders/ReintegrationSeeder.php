<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Reintegration;
use Illuminate\Database\Seeder;

class ReintegrationSeeder extends Seeder
{
    public function run(): void
    {
        $children = Child::all();
        
        if ($children->isEmpty()) {
            $this->command->warn('No children found. Please run ChildSeeder first.');
            return;
        }

        $reintegrationTypes = [
            'Family Reunion',
            'Kinship Care',
            'Foster Care',
            'Independent Living',
            'Other',
        ];

        $relationships = [
            'Parent',
            'Guardian',
            'Relative',
            'Foster Parent',
            'Institution',
            'Other',
        ];

        $statuses = ['Planned', 'In Progress', 'Completed', 'Cancelled'];

        $receivingPersonNames = [
            'Mary Wanjiku',
            'John Kamau',
            'Grace Achieng',
            'Peter Mwangi',
            'Sarah Njeri',
            'David Ochieng',
            'Faith Wambui',
            'Samuel Kiprotich',
            'Agnes Nyambura',
            'Joseph Mutua',
        ];

        $authorizingPersons = [
            ['name' => 'Dr. Margaret Kinyua', 'designation' => 'Centre Director'],
            ['name' => 'Mr. James Omondi', 'designation' => 'Social Worker'],
            ['name' => 'Ms. Catherine Wanjiru', 'designation' => 'Program Manager'],
            ['name' => 'Mr. Francis Kibet', 'designation' => 'Child Protection Officer'],
        ];

        $exitReasons = [
            'Family reunification after successful tracing and assessment',
            'Placement with suitable foster family',
            'Kinship care arrangement with extended family',
            'Child reached age of majority and ready for independent living',
            'Transfer to specialized institution for continued care',
            'Adoption by approved family',
            'Medical referral to specialized facility',
            'Educational placement in boarding school',
        ];

        foreach ($children->take(15) as $index => $child) {
            $authorizingPerson = fake()->randomElement($authorizingPersons);
            $reintegrationType = fake()->randomElement($reintegrationTypes);
            $status = fake()->randomElement($statuses);
            
            $exitDate = fake()->dateTimeBetween($child->date_of_admission ?? '-1 year', 'now');
            $followUpDate = (clone $exitDate)->modify('+7 days');

            Reintegration::create([
                'child_id' => $child->id,
                'reintegration_number' => 'REINT-' . date('Y') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'child_name' => $child->full_name,
                'admission_number' => $child->admission?->admission_number,
                'child_sex' => 'Female',
                'child_age' => $child->date_of_birth ? $child->date_of_birth->age : fake()->numberBetween(5, 17),
                'date_of_admission' => $child->date_of_admission ?? fake()->dateTimeBetween('-2 years', '-6 months'),
                'date_of_birth' => $child->date_of_birth,
                'date_of_exit' => $exitDate,
                'reasons_for_exit' => fake()->randomElement($exitReasons),
                
                // Receiving person details
                'receiving_person_name' => fake()->randomElement($receivingPersonNames),
                'relationship_to_child' => fake()->randomElement($relationships),
                'receiving_person_telephone' => '+254' . fake()->numberBetween(700000000, 799999999),
                'receiving_person_address' => fake()->address(),
                'receiving_person_signature_date' => $exitDate,
                
                // Agreement details
                'parent_guardian_name' => fake()->randomElement($receivingPersonNames),
                'parent_guardian_signature_date' => $exitDate,
                'reintegration_agreement_text' => 'I, the undersigned parent/guardian, agree to receive the above-named child and undertake to provide proper care, protection, and support. I understand my responsibilities and commit to ensuring the child\'s welfare and development.',
                
                // Authorization details
                'authorizing_person_name' => $authorizingPerson['name'],
                'authorizing_person_designation' => $authorizingPerson['designation'],
                'authorization_date' => $exitDate,
                'official_stamp_applied' => fake()->boolean(80),
                'comments_remarks' => fake()->optional(0.7)->sentence(),
                
                // Follow-up and support
                'status' => $status,
                'reintegration_type' => $reintegrationType,
                'first_follow_up_date' => $followUpDate,
                'follow_up_plan' => 'Regular home visits will be conducted to monitor the child\'s adjustment and well-being. Support services will be provided as needed.',
                'success_indicators' => 'Child shows positive adjustment, maintains school attendance, demonstrates healthy relationships with family/caregivers, and exhibits overall well-being.',
                'support_services_provided' => fake()->optional(0.6)->randomElement([
                    'Counseling services, educational support',
                    'Medical follow-up, nutritional support',
                    'Vocational training, life skills development',
                    'Family counseling, parenting support',
                    'Educational materials, school fees support',
                ]),
                
                'created_at' => $exitDate,
                'updated_at' => $exitDate,
            ]);
        }

        $this->command->info('Created ' . Reintegration::count() . ' reintegration records.');
    }
}