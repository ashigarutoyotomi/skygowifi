<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Domains\Settings\Models\Setting;
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = DB::where('key','affiliate_link_expiry_time')->first();
        if($row==null){
            DB::table('settings')->insert([
                'key'=>'affiliate_link_expiry_time',
                'title'=>'Expiry Time',
                'type'=>Setting::TYPE_NUMBER,
                'value'=>0,
                'section'=>'affiliate',
                'created_at'=>now(),
            ]);
        }
        $row1 = DB::where('key','affiliate_link_sale_commission')->first();
        if ($row1==null) {
            DB::table('settings')->insert([
            'key'=>'affiliate_link_sale_commission',
            'title'=>'Commission of sale using affiliate link',
            'type'=>Setting::TYPE_NUMBER,
            'value'=>10,
            'section'=>'affiliate',
            'created_at'=>now(),
        ]);
        }
    }
}
