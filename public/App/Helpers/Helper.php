<?php

namespace App\Helpers;

class Helper
{
    /**
     * @param string $code
     *
     * @return string
     */
    public static function config(string $code): string
    {
        $configParts = explode('.', $code);
        $folder = $configParts[0];
        unset($configParts[0]);

        return static::extractConfigValue(static::loadConfigFile($folder), $configParts);
    }

    /**
     * @param string $configCode
     *
     * @return array
     */
    protected static function loadConfigFile(string $configCode): array
    {
        return include($_SERVER['DOCUMENT_ROOT'] . '/config/' . $configCode . '.php');
    }

    /**
     * @param array $configArray
     * @param array $subCodes
     *
     * @return string
     */
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
