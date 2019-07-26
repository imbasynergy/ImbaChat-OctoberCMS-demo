<?php namespace ImbaSynergy\imbachatwidget;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'ImbaSynergy\imbachatwidget\Components\ImbaChat' => 'ImbaChat'
        ];
    }

    public function pluginDetails()
    {
        return [
            'name'        => 'ImbaChatWidget',
            'description' => 'ImbaChat integration'
        ];
    }

}
