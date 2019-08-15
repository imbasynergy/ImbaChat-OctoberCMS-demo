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
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'ImbaChat',
                'description' => 'ImbaChat Settings.',
                'icon'        => 'icon-location-arrow',
                'class'       => 'ImbaSynergy\imbachatwidget\Models\Settings',
                'order'       => 100,
                'permissions' => ['ImbaSynergy.imbachatwidget.access_settings'],
            ]
        ];
    }
}
