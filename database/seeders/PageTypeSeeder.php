<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageType;
use Carbon\Carbon;

class PageTypeSeeder extends Seeder
{
    public function run(): void
    {
        $pageTypes = [
            ['title' => 'Normal',            'created_at' => Carbon::now()],
            ['title' => 'Group',             'created_at' => Carbon::now()],
            ['title' => 'Photo Gallery',     'created_at' => Carbon::now()],
            ['title' => 'Video Gallery',     'created_at' => Carbon::now()],
            ['title' => 'Link',              'created_at' => Carbon::now()],
            ['title' => 'Slider',            'created_at' => Carbon::now()],
            ['title' => 'Attachment',        'created_at' => Carbon::now()],
            ['title' => 'Audio Gallery',     'created_at' => Carbon::now()],
            ['title' => 'Message',           'created_at' => Carbon::now()],
            ['title' => 'Team',              'created_at' => Carbon::now()],
            ['title' => 'Group Project',     'created_at' => Carbon::now()],
            ['title' => 'Group News',        'created_at' => Carbon::now()],
            ['title' => 'Projectdetails',    'created_at' => Carbon::now()],
            ['title' => 'Notice Download',   'created_at' => Carbon::now()],
            ['title' => 'Group Jobcategory', 'created_at' => Carbon::now()],
            ['title' => 'Group Jobs',        'created_at' => Carbon::now()],
        ];

        foreach ($pageTypes as $type) {
            PageType::create($type);
        }
    }
}
