<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\ServiceOfficer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data in FK-safe order
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ServiceOption::truncate();
        Service::truncate();
        ServiceOfficer::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Document Processing
        $bwPrinting = Service::create([
            'title' => 'Black & White Printing',
            'slug' => 'black-white-printing',
            'description' => 'High-quality black and white printing for documents and handouts.',
            'icon' => '🖨️',
            'price_bw' => 2.00,
            'price_label' => 'per page',
            'category' => 'Document Processing',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $colorPrinting = Service::create([
            'title' => 'Color Printing',
            'slug' => 'color-printing',
            'description' => 'Vibrant color printing for presentations, brochures, and creative outputs.',
            'icon' => '🎨',
            'price_color' => 5.00,
            'price_label' => 'per page',
            'category' => 'Document Processing',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $photocopy = Service::create([
            'title' => 'Photocopying',
            'slug' => 'photocopying',
            'description' => 'Quick copies for notes and handouts.',
            'icon' => '📑',
            'price_bw' => 1.00,
            'price_label' => 'per page',
            'category' => 'Document Processing',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $laminating = Service::create([
            'title' => 'Laminating',
            'slug' => 'laminating',
            'description' => 'Protect your IDs and covers with lamination.',
            'icon' => '🪧',
            'price_color' => 20.00,
            'price_label' => 'per sheet',
            'category' => 'Document Processing',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        $binding = Service::create([
            'title' => 'Binding',
            'slug' => 'binding',
            'description' => 'Ring or soft binding for theses and capstone projects.',
            'icon' => '📚',
            'price_color' => 35.00,
            'price_label' => 'per set',
            'category' => 'Document Processing',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        $scanning = Service::create([
            'title' => 'Scanning',
            'slug' => 'scanning',
            'description' => 'Convert physical notes to searchable PDFs.',
            'icon' => '📠',
            'price_color' => 3.00,
            'price_label' => 'per page',
            'category' => 'Document Processing',
            'is_active' => true,
            'sort_order' => 6,
        ]);

        // Paper size options (linked to B/W printing for sample)
        ServiceOption::create([
            'service_id' => $bwPrinting->id,
            'name' => 'Short Bond',
            'dimensions' => '8.5" × 11"',
            'price_bw' => 1.50,
            'price_color' => 4.00,
            'size_class' => 'short',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        ServiceOption::create([
            'service_id' => $bwPrinting->id,
            'name' => 'A4 Paper',
            'dimensions' => '8.27" × 11.69"',
            'price_bw' => 2.00,
            'price_color' => 5.00,
            'size_class' => 'standard',
            'badge' => 'MOST POPULAR',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        ServiceOption::create([
            'service_id' => $bwPrinting->id,
            'name' => 'Long Bond',
            'dimensions' => '8.5" × 13"',
            'price_bw' => 2.50,
            'price_color' => 6.00,
            'size_class' => 'long',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // IT Technical Support
        Service::create([
            'title' => 'Reformat & OS Install',
            'slug' => 'reformat-os-install',
            'description' => 'Speed up laptops with clean OS install and drivers.',
            'icon' => '💻',
            'price_color' => 300.00,
            'price_label' => 'per device',
            'category' => 'IT Support',
            'is_active' => true,
            'sort_order' => 10,
        ]);

        Service::create([
            'title' => 'Software Installation',
            'slug' => 'software-install',
            'description' => 'Install Office, VS Code, design tools, and antivirus.',
            'icon' => '🧩',
            'price_color' => 150.00,
            'price_label' => 'per request',
            'category' => 'IT Support',
            'is_active' => true,
            'sort_order' => 11,
        ]);

        Service::create([
            'title' => 'Virus & USB Cleanup',
            'slug' => 'virus-cleanup',
            'description' => 'Remove malware from laptops and infected flash drives.',
            'icon' => '🛡️',
            'price_color' => 120.00,
            'price_label' => 'per device',
            'category' => 'IT Support',
            'is_active' => true,
            'sort_order' => 12,
        ]);

        // Digital Services
        Service::create([
            'title' => 'Layout & Design',
            'slug' => 'layout-design',
            'description' => 'Posters, tarps, and presentation templates for org events.',
            'icon' => '🎨',
            'price_color' => 500.00,
            'price_label' => 'starting rate',
            'category' => 'Digital Services',
            'is_active' => true,
            'sort_order' => 20,
        ]);

        Service::create([
            'title' => 'Data Recovery',
            'slug' => 'data-recovery',
            'description' => 'Attempt to recover files from corrupted USBs.',
            'icon' => '💾',
            'price_color' => 250.00,
            'price_label' => 'per attempt',
            'category' => 'Digital Services',
            'is_active' => true,
            'sort_order' => 21,
        ]);

        Service::create([
            'title' => 'WiFi Voucher Management',
            'slug' => 'wifi-voucher',
            'description' => 'Manage or distribute campus WiFi vouchers (if applicable).',
            'icon' => '📶',
            'price_color' => 0.00,
            'price_label' => 'per voucher',
            'category' => 'Digital Services',
            'is_active' => true,
            'sort_order' => 22,
        ]);

        // System Development
        Service::create([
            'title' => 'Simple Web/System Builds',
            'slug' => 'system-development',
            'description' => 'Build simple sites or systems for orgs (e.g., voting, inventory).',
            'icon' => '🛠️',
            'price_color' => 1500.00,
            'price_label' => 'starting rate',
            'category' => 'System Development',
            'is_active' => true,
            'sort_order' => 30,
        ]);

        // Create officers
        $officers = [
            ['name' => 'Kate Russel Relator', 'messenger_url' => 'https://www.messenger.com/e2ee/t/9440180662663186'],
            ['name' => 'Aleila Eunice Escoton', 'messenger_url' => 'https://www.messenger.com/e2ee/t/1861893691098871'],
            ['name' => 'Lorraine Grace Dangautan', 'messenger_url' => 'https://www.messenger.com/e2ee/t/8770965666351694'],
            ['name' => 'Karl Calimotan', 'messenger_url' => 'https://www.messenger.com/e2ee/t/7459672660760522'],
            ['name' => 'Jan Allysandra Espia', 'messenger_url' => 'https://www.messenger.com/e2ee/t/9341669029194575'],
            ['name' => 'Katherine Bicode', 'messenger_url' => 'https://www.messenger.com/e2ee/t/27543992281913946'],
            ['name' => 'Selwyn Adia', 'messenger_url' => 'https://www.messenger.com/e2ee/t/1821283922599976'],
            ['name' => 'Jeff Martinez', 'messenger_url' => 'https://www.messenger.com/t/100009387982974'],
        ];

        foreach ($officers as $index => $officer) {
            ServiceOfficer::create([
                'name' => $officer['name'],
                'title' => 'PRINTING OFFICER',
                'messenger_url' => $officer['messenger_url'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
