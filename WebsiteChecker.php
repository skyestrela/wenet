<?php
/**
 * @author         Pierre-Henry Soria <hello@ph7builder.com>
 * @copyright      (c) 2018-2023, Pierre-Henry Soria. All Rights Reserved.
 * @license        See LICENSE.md and COPYRIGHT.md in the root directory.
 * @link           https://ph7builder.com
 * @package        PH7 / ROOT
 */

declare(strict_types=1);

namespace PH7;

defined('PH7') or exit(header('Location: ./'));

use RuntimeException;

class WebsiteChecker
{
    private const REQUIRED_SERVER_VERSION = '8.0.0';
    private const REQUIRED_CONFIG_FILE_NAME = '_constants.php';
    private const INSTALL_FOLDER_NAME = '_install/';

    private const PHP_VERSION_ERROR_MESSAGE = 'ERROR: Your current PHP version is %s. pH7Builder requires PHP %s or newer.<br /> Please ask your Web host to upgrade PHP to %s or newer.';
    private const NO_CONFIG_FOUND_ERROR_MESSAGE = 'CONFIG FILE NOT FOUND! If you want to make a new installation, please re-upload _install/ folder and clear your database.';

    /**
     * @throws RuntimeException
     */
    public function checkPhpVersion(): void
    {
        if ($this->isIncompatiblePhpVersion()) {
            throw new RuntimeException(
                sprintf(
                    self::PHP_VERSION_ERROR_MESSAGE,
                    PHP_VERSION,
                    self::REQUIRED_SERVER_VERSION,
                    self::REQUIRED_SERVER_VERSION
                )
            );
        }
    }

    /**
     * Clear redirection cache since some folks get it cached.
     *
     * @return void
     */
    public function clearBrowserCache(): void
    {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
    }

    public function moveToInstaller(): void
    {
        // Remove backslashes for Windows compatibility
        $sUrlPath = str_replace('\\', '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES)));
        $sUrlPath = substr($sUrlPath, -1) !== '/' ? $sUrlPath . '/' : $sUrlPath;

        header('Location: ' . $sUrlPath . self::INSTALL_FOLDER_NAME);
    }

    public function doesConfigFileExist(): bool
    {
        return is_file(__DIR__ . '/' . self::REQUIRED_CONFIG_FILE_NAME);
    }

    public function getNoConfigFoundMessage(): string
    {
        return self::NO_CONFIG_FOUND_ERROR_MESSAGE;
    }

    public function doesInstallFolderExist(): bool
    {
        return is_dir(__DIR__ . '/' . self::INSTALL_FOLDER_NAME);
    }

    private function isIncompatiblePhpVersion(): bool
    {
        return version_compare(PHP_VERSION, self::REQUIRED_SERVER_VERSION, '<');
    }
}
