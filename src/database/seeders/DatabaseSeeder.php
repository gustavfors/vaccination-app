<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Vaccine;
use App\Models\Vaccination;
use App\Models\Recommendation;
use App\Models\User;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'admin@healthzone.com',
            'password' => bcrypt('healthzone123'),
            'role' => 'admin',
            'avatar' => 'avatars/5.png'
        ]);

        User::factory()->create([
            'name' => 'Christine Mcellar',
            'email' => 'demo@healthzone.com',
            'password' => bcrypt('healthzone123'),
            'avatar' => 'avatars/1.png',
        ]);

        //profiles
        $profile = Profile::create([
            'user_id' => 1,
            'name' => 'Jane Doe',
            'born' => Carbon::parse('1990-01-24'),
            'avatar' => 'avatars/5.png',
            'gender' => 'Female',
        ]);


        $profile1 = Profile::create([
            'user_id' => 2,
            'name' => 'Christine Mcellar',
            'born' => Carbon::parse('1988-04-12'),
            'avatar' => 'avatars/1.png',
            'gender' => 'Female',
        ]);

        $profile2 = Profile::create([
            'user_id' => 2,
            'name' => 'Andrew Mcellar',
            'born' => Carbon::parse('1990-02-05'),
            'avatar' => 'avatars/2.png',
            'gender' => 'Male',
        ]);

        $profile3 = Profile::create([
            'user_id' => 2,
            'name' => 'Jason Mcellar',
            'born' => Carbon::parse('2008-09-24'),
            'avatar' => 'avatars/4.png',
            'gender' => 'Male',
        ]);

        $profile4 = Profile::create([
            'user_id' => 2,
            'name' => 'Jennifer Mcellar',
            'born' => Carbon::parse('2010-11-12'),
            'avatar' => 'avatars/3.png',
            'gender' => 'Female',
        ]);
        
        //vaccines

        $pertussis = Vaccine::create([
            'name' => 'Pertussis',
            'description' => 'none',
            'active_for' => '2191',
            'gender' => 'all',
            'age' => 0,
            'priority' => 'low'
        ]);

        $hepatitisB = Vaccine::create([
            'name' => 'Hepatitis B',
            'description' => 'none',
            'active_for' => '7304',
            'gender' => 'all',
            'age' => 0,
            'priority' => 'medium'
        ]);

        $measles = Vaccine::create([
            'name' => 'Measles',
            'description' => 'none',
            'active_for' => '8594',
            'gender' => 'all',
            'age' => 0,
            'priority' => 'high'
        ]);

        $polio = Vaccine::create([
            'name' => 'Polio',
            'description' => 'none',
            'active_for' => '6574',
            'gender' => 'all',
            'age' => 0,
            'priority' => 'high'
        ]);
        

        $vaccination1 = new Vaccination();
        $vaccination1->user_id = 2;
        $vaccination1->profile_id = 2;
        $vaccination1->vaccine_id = 1;
        $vaccination1->date = Carbon::now()->subDays(365 * 12);
        $vaccination1->expire = $vaccination1->date->add(Vaccine::where('id', 1)->first()->active_for, 'days');
        $vaccination1->created_at = Carbon::now()->subDays(30);
        $vaccination1->save();

        $vaccination2 = new Vaccination();
        $vaccination2->user_id = 2;
        $vaccination2->profile_id = 3;
        $vaccination2->vaccine_id = 2;
        $vaccination2->date = Carbon::now()->subDays(365 * 18);
        $vaccination2->expire = $vaccination2->date->add(Vaccine::where('id', 2)->first()->active_for, 'days');
        $vaccination2->created_at = Carbon::now()->subDays(29);
        $vaccination2->save();

        $vaccination3 = new Vaccination();
        $vaccination3->user_id = 2;
        $vaccination3->profile_id = 4;
        $vaccination3->vaccine_id = 1;
        $vaccination3->date = Carbon::now()->subDays(365 * 2);
        $vaccination3->expire = $vaccination3->date->add(Vaccine::where('id', 1)->first()->active_for, 'days');
        $vaccination3->created_at = Carbon::now()->subDays(28);
        $vaccination3->save();

        $vaccination4 = new Vaccination();
        $vaccination4->user_id = 2;
        $vaccination4->profile_id = 3;
        $vaccination4->vaccine_id = 4;
        $vaccination4->date = Carbon::now()->subDays(365 * 19);
        $vaccination4->expire = $vaccination4->date->add(Vaccine::where('id', 4)->first()->active_for, 'days');
        $vaccination4->created_at = Carbon::now()->subDays(27);
        $vaccination4->save();

        $vaccination5 = new Vaccination();
        $vaccination5->user_id = 2;
        $vaccination5->profile_id = 5;
        $vaccination5->vaccine_id = 4;
        $vaccination5->date = Carbon::now()->subDays(364 * 18);
        $vaccination5->expire = $vaccination5->date->add(Vaccine::where('id', 4)->first()->active_for, 'days');
        $vaccination5->created_at = Carbon::now()->subDays(26);
        $vaccination5->save();

        $vaccination6 = new Vaccination();
        $vaccination6->user_id = 2;
        $vaccination6->profile_id = 4;
        $vaccination6->vaccine_id = 2;
        $vaccination6->date = Carbon::now()->subDays(362 * 6);
        $vaccination6->expire = $vaccination6->date->add(Vaccine::where('id', 2)->first()->active_for, 'days');
        $vaccination6->created_at = Carbon::now()->subDays(26);
        $vaccination6->save();

        $vaccination7 = new Vaccination();
        $vaccination7->user_id = 2;
        $vaccination7->profile_id = 2;
        $vaccination7->vaccine_id = 2;
        $vaccination7->date = Carbon::now()->addDays(12);
        $vaccination7->expire = $vaccination7->date->add(Vaccine::where('id', 1)->first()->active_for, 'days');
        $vaccination7->created_at = Carbon::now()->subDays(25);
        $vaccination7->save();

        $vaccination8 = new Vaccination();
        $vaccination8->user_id = 2;
        $vaccination8->profile_id = 3;
        $vaccination8->vaccine_id = 3;
        $vaccination8->date = Carbon::now()->subDays(365 * 23.1);
        $vaccination8->expire = $vaccination8->date->add(Vaccine::where('id', 3)->first()->active_for, 'days');
        $vaccination8->created_at = Carbon::now()->subDays(24);
        $vaccination8->save();

        $vaccination9 = new Vaccination();
        $vaccination9->user_id = 2;
        $vaccination9->profile_id = 5;
        $vaccination9->vaccine_id = 3;
        $vaccination9->date = Carbon::now()->addDays(4);
        $vaccination9->expire = $vaccination9->date->add(Vaccine::where('id', 3)->first()->active_for, 'days');
        $vaccination9->created_at = Carbon::now()->subDays(23);
        $vaccination9->save();

        $vaccination10 = new Vaccination();
        $vaccination10->user_id = 2;
        $vaccination10->profile_id = 4;
        $vaccination10->vaccine_id = 4;
        $vaccination10->date = Carbon::now()->subDays(365 * 5);
        $vaccination10->expire = $vaccination10->date->add(Vaccine::where('id', 3)->first()->active_for, 'days');
        $vaccination10->created_at = Carbon::now()->subDays(31);
        $vaccination10->save();
    }
}
