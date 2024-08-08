<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advised;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Product;
use App\Models\SubCategory;
use Dotenv\Dotenv;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class BusinessSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'bSettings' =>[
                'navCats' => json_decode(get_setting('navCats')),
                'homeCats' => json_decode(get_setting('homeCats')),
                'headerPages' => json_decode(get_setting('headerPages')),
                'footPages' => json_decode(get_setting('footerPages')),
                'topBarText' => get_setting('topBarText'),
                'sealsTarget' => get_setting('sealsTarget'),
                'posPaymentMethods' => get_setting('posPaymentMethods'),
            ]
        ];

        if(!empty(\request()->input('settings'))){
            return response()->json(get_setting(\request()->input('settings')));
        }

        return response()->json($settings);
    }

    public function updateSetting()
    {
        foreach (Request::all() as $type => $value){
            $business_settings = BusinessSetting::where('type', $type)->first();
            if($business_settings != null) {
                if ($value != null){
                    if ($type == 'timezone' && gettype($value) != 'array'){
                        $value = $business_settings->value;
                    }
                    if(gettype($value) == 'array'){
                        $business_settings->value = json_encode($value);
                    }
                    else {
                        $business_settings->value = $value;
                    }
                    $business_settings->save();
                }
            } else{
                if ($value != null){
                    $business_settings = new BusinessSetting;
                    $business_settings->type = $type;
                    if(gettype($value) == 'array'){
                        $business_settings->value = json_encode($value);
                    }
                    else {
                        $business_settings->value = $value;
                    }
                    $business_settings->save();
                }
            }
        }

        return response()->json([
            'message' => 'Update Business Settings...'
        ]);
    }

    public function logoUpdate(){


        if (Request::hasFile('header_logo')){
            $business_settings = BusinessSetting::where('type', 'header_logo')->first();
            if ($business_settings?->value != null){
                Storage::disk('public')->delete($business_settings->value);
            }
            $value = Request::file('header_logo')->store('settings', 'public');
            $business_settings->value = $value;
            $business_settings->save();
        }
        if (Request::hasFile('footer_logo')){
            $business_settings = BusinessSetting::where('type', 'footer_logo')->first();
            if ($business_settings?->value != null){
                Storage::disk('public')->delete($business_settings->value);
            }
            $value = Request::file('footer_logo')->store('settings', 'public');
            $business_settings->value = $value;
            $business_settings->save();
        }

        return redirect()->route('setting.index');
    }


    public function updateSmtp(){
        foreach (Request::all() as $type => $value) {
            $business_settings = BusinessSetting::where('type', $type)->first();
            if ($type == 'mailDriver' && $value != null){
                overWriteEnv("MAIL_MAILER", $value);
            }
            if ($type == 'mailHost' && $value != null){
                overWriteEnv("MAIL_HOST", $value);
            }
            if ($type == 'mailPort' && $value != null){
                overWriteEnv("MAIL_PORT", $value);
            }
            if ($type == 'username' && $value != null){
                overWriteEnv("MAIL_USERNAME", $value);
            }
            if ($type == 'password' && $value != null){
                overWriteEnv("MAIL_PASSWORD", $value);
            }
            if ($type == 'fromEmail' && $value != null){
                overWriteEnv("MAIL_FROM_ADDRESS", $value);
            }
            if ($type == 'fromName' && $value != null){
                overWriteEnv("MAIL_FROM_NAME", $value);
            }
            if ($type == 'encryption' && $value != null){
                overWriteEnv("MAIL_ENCRYPTION", $value);
            }


            if($business_settings != null) {
                if ($value != null){
                    if(gettype($value) == 'array'){
                        $business_settings->value = json_encode($value);
                    }
                    else {
                        $business_settings->value = $value;
                    }
                    $business_settings->save();
                }
            } else{
                if ($value != null){
                    $business_settings = new BusinessSetting;
                    $business_settings->type = $type;
                    if(gettype($value) == 'array'){
                        $business_settings->value = json_encode($value);
                    }
                    else {
                        $business_settings->value = $value;
                    }
                    $business_settings->save();
                }
            }


        }
        return back();
    }

    public function getFooterSettings()
    {
        $items = json_decode(get_setting('footerPages'));
        $sections = array_map(function ($item){
            $item->pages = Page::query()->whereIn('id', $item->pages)->select(['id', 'title', 'slug'])->get();
            return $item;
        }, $items);

        return response()->json($sections, 200);
    }


}
