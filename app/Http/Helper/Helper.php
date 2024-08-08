<?php


use App\Models\BusinessSetting;
use Illuminate\Support\Facades\File;


if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $setting = BusinessSetting::where('type', $key)->first();
        return $setting == null ? $default : $setting->value;
    }
}



if (! function_exists('showPrices')) {
    function showPrices($product)
    {
        $lowest_price = $product->buying_price;
        $highest_price = $product->buying_price;

        if (true) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }
        $lowest_price = floatval($lowest_price);
        $highest_price = floatval($highest_price);

        if($lowest_price == $highest_price){
            return formatPrice($lowest_price);
        }
        else{
            return formatPrice($lowest_price).' - '.formatPrice($highest_price);
        }
    }
}

if(! function_exists('formatPrice')){
    function formatPrice($price): string
    {
        return get_setting('pre', false) ? get_setting('currency_symbol').$price : $price.get_setting('currency_symbol');
    }
}




if (!function_exists('overWriteEnv')){
    function overWriteEnv($key, $value){
        $envFile = base_path('.env');
//        $key = "VARIABLE_NAME";
//        $value = "new value";

        if (File::exists($envFile)) {
            // Read the contents of the .env file
            $contents = File::get($envFile);

            // Replace the existing value with the new value
            $updatedContents = Str::replaceFirst(
                "{$key}=" . env($key),
                "{$key}={$value}",
                $contents
            );

            // Write the updated contents back to the .env file
            File::put($envFile, $updatedContents);

            return "Environment variable updated successfully!";
        }

    }
}


if(!function_exists('getRandomStringRand')){
    function getRandomStringRand($length = 10): string
    {
        $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringLength = strlen($stringSpace);
        $randomString = '';
        for ($i = 0; $i < $length; $i ++) {
            $randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
        }
        return $randomString;
    }
}



function sms_send($numbers, $messages): bool|string
{
    $url = "https://bulksmsbd.net/api/smsapi";
    $api_key = env("API_KYE");
    $senderid = env("SENDER_ID");

    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $numbers,
        "message" => $messages
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}






