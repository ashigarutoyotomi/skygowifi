<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Domains\Settings\Models\Setting;
use Illuminate\Support\Facades\Log;
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rowExpiry = DB::table('settings')->where('key','affiliate_link_expiry_time')->first();
        if($rowExpiry==null){
            DB::table('settings')->insert([
                'key'=>Setting::AFFILIATE_LINK_EXPIRY_TIME,
                'title'=>'Expiry Time',
                'type'=>Setting::TYPE_NUMBER,
                'value'=>0,
                'section'=>'affiliate',
                'created_at'=>now(),
            ]);
        }
        $rowSale = DB::table('settings')->where('key','affiliate_link_sale_commission')->first();
        if ($rowSale==null) {
            DB::table('settings')->insert([
            'key'=>Setting::AFFILIATE_LINK_SALE_COMISSION,
            'title'=>'Commission of sale using affiliate link',
            'type'=>Setting::TYPE_NUMBER,
            'value'=>10,
            'section'=>'affiliate',
            'created_at'=>now(),
        ]);
        }
    }
}
