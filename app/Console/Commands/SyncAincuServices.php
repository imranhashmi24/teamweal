<?php

namespace App\Console\Commands;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncAincuServices extends Command
{
    protected $signature = 'sync:services';
    protected $description = 'Sync services and categories from demo API';

    public function handle()
    {
        $this->info('Starting sync from Aincu API...');

        try {
            //$response = Http::withoutVerifying()->get('https://demo.aincu.com/api/services');
            //$response = Http::withoutVerifying()->get('https://demo.clincu.com/api/services');
            $response = Http::withoutVerifying()->get('https://demo.cyincu.com/api/services');


            if (!$response->successful()) {
                $this->error('API request failed: ' . $response->status());
                return 1;
            }

            $data = $response->json();


            if (empty($data['data'])) {
                $this->error('No data received from API');
                return 1;
            }

            //dd($data);


            $this->processCategories($data['data']);

            $this->info('Sync completed successfully!');

            return 0;

        } catch (\Exception $e) {
            $this->error('Error during sync: ' . $e->getMessage());
            return 1;
        }
    }

    protected function processCategories(array $categories)
    {
        $bar = $this->output->createProgressBar(count($categories));

        foreach ($categories as $categoryData) {
            $category = Category::Create(
                [
                    'name' => $categoryData['name'],
                    'name_ar' => $categoryData['name_ar'] ?? null,
                    'is_featured' => $categoryData['is_featured'] ?? null,
                ]
            );

            if (!empty($categoryData['services'])) {
                $this->processServices($category, $categoryData['services']);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

   protected function processServices(Category $category, array $services)
    {
        $notify = [];

        foreach ($services as $serviceData) {
            try {

                // Create service with proper data
                Service::create([
                    'category_id'     => $category->id,
                    'title'          => $serviceData['title'] ?? null,
                    'title_ar'       => $serviceData['title_ar'] ?? null,
                    'slug'           => $serviceData['slug'] ?? Str::slug($serviceData['title']),
                    'image'          => $serviceData['image'],
                    'description'    => $serviceData['description'] ?? null,
                    'description_ar' => $serviceData['description_ar'] ?? null,
                ]);

            } catch (\Exception $e) {
                $notify[] = ['error', 'Failed to create service: ' . $e->getMessage()];
                continue;
            }
        }

        return $notify;
    }
}
