<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing orders
        DB::table('orders')->truncate();

        // Sample orders for testing
        $orders = [
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '(555) 123-4567',
                'order_type' => 'pickup',
                'pickup_date' => now()->addDays(2)->toDateString(),
                'pickup_time' => '9:00 AM',
                'products' => ['bread', 'pastries'],
                'dietary' => null,
                'order_details' => 'I would like 2 sourdough loaves and 6 croissants. Please make sure the croissants are fresh in the morning.',
                'newsletter' => true,
                'sms_alerts' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Chen',
                'email' => 'michael.chen@example.com',
                'phone' => '(555) 234-5678',
                'order_type' => 'custom-cake',
                'pickup_date' => now()->addDays(7)->toDateString(),
                'pickup_time' => '2:00 PM',
                'products' => ['cakes'],
                'dietary' => null,
                'order_details' => 'Birthday cake for my daughter turning 8. She loves unicorns! Vanilla cake with buttercream frosting, serves 15-20 people. Purple and pink colors preferred.',
                'newsletter' => false,
                'sms_alerts' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Rodriguez',
                'email' => 'emily.rodriguez@example.com',
                'phone' => '(555) 345-6789',
                'order_type' => 'catering',
                'pickup_date' => now()->addDays(10)->toDateString(),
                'pickup_time' => '7:00 AM',
                'products' => ['bread', 'pastries', 'cookies'],
                'dietary' => 'gluten-free',
                'order_details' => 'Corporate breakfast for 50 people. Need assorted pastries, bagels, and gluten-free options. Please include cream cheese, butter, and jam.',
                'newsletter' => true,
                'sms_alerts' => false,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Thompson',
                'email' => 'david.thompson@example.com',
                'phone' => '(555) 456-7890',
                'order_type' => 'weekly',
                'pickup_date' => now()->addDays(1)->toDateString(),
                'pickup_time' => '8:00 AM',
                'products' => ['bread'],
                'dietary' => null,
                'order_details' => 'Weekly subscription for 1 whole wheat loaf and 1 multigrain loaf. Pickup every Monday morning.',
                'newsletter' => true,
                'sms_alerts' => true,
                'created_at' => now()->subWeeks(2),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jessica',
                'last_name' => 'Martinez',
                'email' => 'jessica.martinez@example.com',
                'phone' => '(555) 567-8901',
                'order_type' => 'pickup',
                'pickup_date' => now()->addDays(1)->toDateString(),
                'pickup_time' => '11:00 AM',
                'products' => ['cookies', 'desserts'],
                'dietary' => 'vegan',
                'order_details' => '2 dozen vegan chocolate chip cookies and 1 vegan chocolate cake (8 inch). It\'s for a vegan potluck!',
                'newsletter' => true,
                'sms_alerts' => false,
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Williams',
                'email' => 'robert.williams@example.com',
                'phone' => '(555) 678-9012',
                'order_type' => 'custom-cake',
                'pickup_date' => now()->addDays(14)->toDateString(),
                'pickup_time' => '3:00 PM',
                'products' => ['cakes'],
                'dietary' => 'nut-free',
                'order_details' => 'Wedding anniversary cake - 25 years! 3-tier cake, serves 50. White chocolate with raspberry filling. Elegant design with gold accents. Must be nut-free due to allergies.',
                'newsletter' => false,
                'sms_alerts' => true,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'first_name' => 'Amanda',
                'last_name' => 'Taylor',
                'email' => 'amanda.taylor@example.com',
                'phone' => '(555) 789-0123',
                'order_type' => 'pickup',
                'pickup_date' => now()->toDateString(),
                'pickup_time' => '4:00 PM',
                'products' => ['pastries', 'desserts'],
                'dietary' => null,
                'order_details' => 'Quick order for today - 4 eclairs, 2 fruit tarts, and 1 tiramisu. Having guests over for dinner tonight!',
                'newsletter' => false,
                'sms_alerts' => false,
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],
            [
                'first_name' => 'Christopher',
                'last_name' => 'Brown',
                'email' => 'chris.brown@example.com',
                'phone' => '(555) 890-1234',
                'order_type' => 'catering',
                'pickup_date' => now()->addDays(5)->toDateString(),
                'pickup_time' => '10:00 AM',
                'products' => ['bread', 'pastries', 'specialty'],
                'dietary' => null,
                'order_details' => 'Baby shower for 30 guests. Need finger sandwiches, assorted pastries, and specialty desserts. Pink and white theme preferred.',
                'newsletter' => true,
                'sms_alerts' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        // Insert orders
        foreach ($orders as $order) {
            Order::create($order);
        }

        $this->command->info('Successfully seeded ' . count($orders) . ' sample orders!');
    }
}
