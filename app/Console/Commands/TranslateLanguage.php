<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TranslateLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:trans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate Language Files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $source = $this->ask('Translate From?', config('app.locale', 'en'));
        $target = $this->ask('Target Locale?', 'fr');

        $sourcePath = base_path("resources/lang/{$source}.json");
        $targetPath = base_path("resources/lang/{$target}.json");

        $bladeFiles = File::allFiles(resource_path('views'));
        $keys = [];

        foreach ($bladeFiles as $file) {
            $content = File::get($file->getRealPath());

            preg_match_all("/__\(['\"](.*?)['\"]\)/", $content, $matches1);

            preg_match_all("/@lang\(['\"](.*?)['\"]\)/", $content, $matches2);

            $keys = array_merge($keys, $matches1[1], $matches2[1]);
        }

        $keys = array_unique($keys);

        $sourceData = File::exists($sourcePath)
            ? json_decode(File::get($sourcePath), true)
            : [];

        foreach ($keys as $key) {
            if (!isset($sourceData[$key])) {
                $sourceData[$key] = $key;
            }
        }

        File::put($sourcePath, json_encode($sourceData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        $targetData = [];

        foreach ($keys as $key) {
            $targetData[$key] = ''; 
        }

        File::put($targetPath, json_encode($targetData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        $this->info("✅ Extracted " . count($keys) . " keys.");
        $this->info("🔤 Source: {$sourcePath}");
        $this->info("🌍 Target: {$targetPath} (empty values — ready to translate manually)");
    }

    
}
