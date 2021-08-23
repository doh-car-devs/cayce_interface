<?php
namespace App\Http\Controllers\Traits;

trait APIAccess {
    function getAppkey($data)
    {
        $access = unserialize(base64_decode(session('access_tokens')));
        if (isset($access)) {
            switch (true) {
                case (isset($access[$data])):
                    return $access[$data];
                    break;
                default:
                    return 'NO_APP_KEY';
                    break;
            }
        }
    }

    function exporterKey($data)
    {
        $access = unserialize(base64_decode(session('access_tokens')));
        if (isset($access)) {
            switch (true) {
                case (isset($access[$data])):
                    return 'export_key_K2hKr7D0H9u';
                    break;
                default:
                    return 'NO_EXPORT_KEY';
                    break;
            }
        }
    }
}