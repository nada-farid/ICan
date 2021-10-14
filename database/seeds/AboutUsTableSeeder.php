<?php

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $about = [
            [
                'description'             => 'i can',
                'vision'           => 'can',
                'message'          => 'can can can',
                'goals'       => 'we can',
                'email' => 'info@domainname.com',
                'phone_1'=>'      +666-22417522',
                'time' =>        ' الأحد - الخميس: من  9-1 ظهرا ومن 4-7 مساءا
              السبت:  8 ص - 1 م 
الجمعة : الراحة الإسبوعية',
               'address' =>'           المملكة العربية السعودية',

            ],
        ];

        AboutUs::insert($about);
    }
    }

