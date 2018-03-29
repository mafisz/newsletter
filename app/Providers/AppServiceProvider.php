<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale('pl');
        $translator = \Carbon\Carbon::getTranslator();
        $resources = $translator->getCatalogue('pl')->all('messages');
        $resources['after'] = ':time temu';
        $resources['before'] = 'za :time';
        $translator->addResource('array', $resources, 'pl');

        $mail_config = Config::get();
        $mail_config = $mail_config->keyBy('key');

        if($mail_config->get('mail_host'))
            config(['mail.host' => $mail_config->get('mail_host')->value]);

        if($mail_config->get('mail_port'))
            config(['mail.port' => $mail_config->get('mail_port')->value]);

        if($mail_config->get('mail_username'))
            config(['mail.username' => $mail_config->get('mail_username')->value]);

        if($mail_config->get('mail_password'))
            config(['mail.password' => $mail_config->get('mail_password')->value]);

        if($mail_config->get('mail_encryption')){
            if($mail_config->get('mail_encryption')->value == "null")
                config(['mail.encryption' => null]);
            else
                config(['mail.encryption' => $mail_config->get('mail_encryption')->value]);
        }

        if($mail_config->get('mail_from_address'))
            config(['mail.from.address' => $mail_config->get('mail_from_address')->value]);

        if($mail_config->get('mail_from_name'))
            config(['mail.from.name' => $mail_config->get('mail_from_name')->value]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
