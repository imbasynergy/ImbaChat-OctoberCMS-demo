<?php namespace ImbaSynergy\imbachatwidget\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'ImbaSynergy_imbachatwidget_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

}