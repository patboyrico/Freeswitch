<?php

use App\User;
use App\Country;
use App\EndUser;
use App\Currency;
use App\UserExtension;
use App\UserConfiguration;
use PharIo\Manifest\Extension;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'Mark';
        $user->last_name = 'Adetayo';
        $user->username = 'mark_tunde';
        // $user->image_url = 'Mark';
        // $user->means_of_id = 'Mark';
        $user->email = 'mark_tunde@gmail.com';
        $user->role = 'user';
        $user->email_verified_at = now();
        $user->password = bcrypt('password');
        $user->first_name = 'Mark';
        $user->save();

        $endUser = new EndUser();
        $endUser->user_id = $user->id;
        $endUser->save();

        $currency = new Currency();
        $currency->currency_name = 'Naira';
        $currency->currency_slug = 'naira';
        $currency->save();

        $country = new Country();
        $country->country_name = 'Nigeria';
        $country->country_slug ='NG';
        $country->save();

        $userconfiguration = new UserConfiguration();
        $userconfiguration->user_id = $user->id;
        $userconfiguration->currency_id = $currency->id;
        $userconfiguration->country_id = $country->id;
        $userconfiguration->phone_number = '08169755335';
        $userconfiguration->four_digit_pin = '1234';
        $userconfiguration->save();

        $userextension = new UserExtension();
        $userextension->J_Number = 'J1234';
        $userextension->user_id = $user->id;
        $userextension->save();


    }
}
