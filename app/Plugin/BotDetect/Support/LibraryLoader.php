<?php

final class BDCAKE_LibraryLoader {

    /**
     * Disable instance creation.
     */
    private function __construct() {}

    /**
     * The the BotDetect CAPTCHA Library and override captcha library settings.
     *
     * @return void
     */
    public static function load() {
        // load bd php library
        self::loadBotDetectLibrary();

        // load the captcha configuration defaults
        self::loadCaptchaConfigDefaults();
    }

    /**
     * Load BotDetect CAPTCHA Library.
     *
     * @return void
     */
    private static function loadBotDetectLibrary() {
        // determine the bd library location and define a constant for the path to the library
        self::determineLibraryLocation();
        self::includeFile(BDCAKE_PLUGIN_PATH . 'Provider' . DS . 'botdetect.php', true);
    }

    /**
     * Load the captcha configuration defaults.
     *
     * @return void
     */
    private static function loadCaptchaConfigDefaults()
    {
        self::includeFile(BDCAKE_PLUGIN_PATH . 'Support' . DS . 'CaptchaConfigDefaults.php', true);
    }

    /**
     * Define a constant for the path to the bd library.
     * 
     * @param string $path
     * @return void
     */
    private static function defineLibraryPath($path) {
        if (!defined('BDCLIB_PATH')) {
            define('BDCLIB_PATH', dirname($path) . DS . 'botdetect/');    
        }
    }

    /**
     * Determine the bd library location and define a constant for the path to the bd library.
     * 
     * @return void
     */
    private static function determineLibraryLocation() {
        $outerLib = realpath(ROOT . '/../lib/botdetect.php'); // Path to BotDetect shared library
        $innerRootDirLib = ROOT . '/lib/botdetect.php'; // MYWEBROOT/lib
        $innerAppDirLib = APP . 'Lib/botdetect.php'; // MYWEBROOT/app/Lib/

        if (is_readable($outerLib)) {
            self::defineLibraryPath($outerLib);
        } else if (is_readable($innerAppDirLib)) {
            self::defineLibraryPath($innerAppDirLib);
        } else if (is_readable($innerRootDirLib)) {
            self::defineLibraryPath($innerRootDirLib);
        } else {
            // show an error message if user does not yet included lib
            self::showErrorLibraryIncludeMessage();
        }
    }

    /**
     * Show an error message if user does not yet include the BD libarry into the lib/ folder.
     */
    private static function showErrorLibraryIncludeMessage() {
        $destinationPath = APP . 'Lib';
        echo '
            <br>to: ' . $destinationPath . '
            <br>';
        die;
    }

    /**
     * Include a file.
     *
     * @param string  $filePath
     * @param bool    $once
     * @param mix     $includeData
     * @return void
     */
    private static function includeFile($filePath, $once = false, $includeData = null) {
        if (is_file($filePath)) {
            $once ? include_once($filePath) : include($filePath);
        }
    }
}
