<?php

namespace ImbaSynergy\imbachatwidget\Components;

use ReallySimpleJWT\Token;

class ImbaChat extends \Cms\Classes\ComponentBase {

    public function componentDetails() {
        return [
            'name' => 'ImbaChat',
            'description' => 'Add chat widget to page'
        ];
    }

    /**
     * Формирует строки настроек для инициализации виджета
     * @return string
     */
    public function getJsSettingsString($opt = []) {

        $user_id = \Auth::getUser()->id;
        $token = self::getJWT();

        $extend_settings = array_merge(
            [
                // Предустановленные значения по умолчанию
                "language" => self::property('language'),
                "user_id" => $user_id,
                "token" => $token,
                "resizable" => self::property('resizable'),
                "draggable" => self::property('draggable'),
                "theme" => self::property('theme'),
                "position" => self::property('position'),
                "useFaviconBadge" => self::property('useFaviconBadge'),
                "updateTitle" => self::property('updateTitle'),
            ], $opt);

        // Событие для дополнения настроек из других плагинов
        \Event::fire('ImbaSynergy.ImbaChat.default.settings', [&$extend_settings]);

        // Итоговые настройки виджета
        return json_encode($extend_settings);
    }
    public function getUserID(){
        return \Auth::getUser() ? \Auth::getUser()->id : 0;
    }
    function getJWT()
    {
// Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $pass = \Config::get('imbasynergy.imbachatwidget::in_password');
        $data = array();
        $data['exp'] = (int)date('U')+3600*7;
        $data['user_id'] = \Auth::getUser()->id;

        if(isset($data['user_id']))
        {
            $data['user_id'] = (int)$data['user_id'];
        }

// Create token payload as a JSON string
        $payload = json_encode($data);

// Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

// Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

// Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $pass, true);

// Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

// Create JWT
        return trim($base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature);
    }
    public function renderJsSettingsString() {
        return self::getJsSettingsString();
    }
    // Настройки конфигурируемые в компоненте чата
    public function defineProperties() {
        return [
            'theme' => [
                'title' => 'Theme',
                'type' => 'dropdown',
                'default' => \Config::get('imbasynergy.imbachatwidget::theme'),
                'placeholder' => 'Select theme',
                'options' => ['default' => 'Default theme', 'dark' => 'Dark theme'],
                'showExternalParam' => false
            ],
            'position' => [
                'title' => 'Messages window position',
                'type' => 'dropdown',
                'default' => \Config::get('imbasynergy.imbachatwidget::position'),
                'placeholder' => 'Select position',
                'options' => ['right' => 'Right', 'left' => 'Left'],
                'showExternalParam' => false
            ],
            'language' => [
                'title' => 'Language',
                'type' => 'dropdown',
                'default' => \Config::get('imbasynergy.imbachatwidget::language'),
                'placeholder' => 'Select language',
                'options' => ['eng' => 'eng'],
                'showExternalParam' => false
            ],
            'resizable' => [
                'title' => 'resizable',
                'type' => 'checkbox',
                'default' => \Config::get('imbasynergy.imbachatwidget::resizable'),
                'showExternalParam' => false
            ],
            'draggable' => [
                'title' => 'draggable',
                'type' => 'checkbox',
                'default' => \Config::get('imbasynergy.imbachatwidget::draggable'),
                'showExternalParam' => false
            ],
            'useFaviconBadge' => [
                'title' => 'useFaviconBadge',
                'type' => 'checkbox',
                'default' => \Config::get('imbasynergy.imbachatwidget::useFaviconBadge'),
                'showExternalParam' => false
            ],
            'updateTitle' => [
                'title' => 'updateTitle',
                'type' => 'checkbox',
                'default' => \Config::get('imbasynergy.imbachatwidget::updateTitle'),
                'showExternalParam' => false
            ],
            'dev_id' => [
                'title' => 'Developer id',
                'default' => \Config::get('imbasynergy.imbachatwidget::dev_id')
            ]
        ];
    }
}
