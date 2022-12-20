<?php namespace App\Lib;

//Bootstrap your app: beállítunk az alkalmazás indításakor néhány konfigot
class App
{
    public static function run()
    {
        Logger::enableSystemLogs();
    }
}