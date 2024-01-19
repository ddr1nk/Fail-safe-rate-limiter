<?php

namespace App\Helpers;

class Helper
{
    public static function config(string $code): string
    {
        $configParts = explode('.', $code);
        $folder = $configParts[0];
        unset($configParts[0]);

        return static::extractConfigValue(static::loadConfigFile($folder), $configParts);
    }

    protected static function loadConfigFile(string $configCode): array
    {
        return include($_SERVER['DOCUMENT_ROOT'] . '/config/' . $configCode . '.php');
    }

    protected static function extractConfigValue(array $configArray, array $subCodes): string
    {
        $guardian = $configArray;
        foreach ($subCodes as $key) {
            if (isset($guardian[$key])) {
                $guardian = $guardian[$key];
            } else {
                $guardian = null;
                break;
            }
        }

        return $guardian ?? '';
    }
}
