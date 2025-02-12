<?php
/**
 * @author           Pierre-Henry Soria <hello@ph7builder.com>
 * @copyright        (c) 2012-2023, Pierre-Henry Soria. All Rights Reserved.
 * @license          MIT License; See LICENSE.md and COPYRIGHT.md in the root directory.
 */

defined('PH7') or exit('Restricted access');

//---------- Variables ----------//

//----- URL -----//
// Check the SSL protocol compatibility
// You need to clear caches if you move your server from HTTP to HTTPS. Admin Panel -> Tool -> Caches -> Caches Manager
$sUrlProtocol = (
    (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on') ||
    (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
    (!empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] === 'https') ||
    $_SERVER['SERVER_PORT'] === '443'
) ? 'https://' : 'http://';

// Determine the domain name, with the port if necessary
$sServerName = $_SERVER['SERVER_NAME'] !== $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
$sDomain = ($_SERVER['SERVER_PORT'] !== '80' && $_SERVER['SERVER_PORT'] !== '443' && strpos($sServerName, ':') === false) ? $sServerName . ':' . $_SERVER['SERVER_PORT'] : $sServerName;

// Determine the current file of the application
$sPhp_self = str_replace('\\', '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES))); // Remove backslashes for Windows compatibility

//---------- Constants ----------//

//----- Other -----//
define('PH7_ADMIN_MOD', 'admin123');
define('PH7_REQUIRED_SERVER_VERSION', '8.0.0');
define('PH7_REQUIRED_SQL_VERSION', '5.5.3');
define('PH7_ENCODING', 'utf-8');
define('PH7_DEFAULT_TIMEZONE', 'America/Chicago');
define('PH7_DS', DIRECTORY_SEPARATOR);
define('PH7_PS', PATH_SEPARATOR);

//----- URL -----//
define('PH7_URL_INSTALL', $sUrlProtocol . $sDomain . $sPhp_self . '/'); // INSTALL URL
define('PH7_URL_ROOT', dirname(PH7_URL_INSTALL) . '/'); // ROOT URL

//----- PATH -----//
define('PH7_ROOT_PUBLIC', dirname(__DIR__) . PH7_DS); // PUBLIC ROOT
define('PH7_ROOT_INSTALL', __DIR__ . PH7_DS); // ROOT INSTALL'
define('PH7_PATH_PUBLIC_DATA_SYS_MOD', PH7_ROOT_PUBLIC . 'data/system/modules/');
