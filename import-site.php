<?php
require( __DIR__ . '/vendor/autoload.php' );

/**
 * Helper function get use default for env var if not exist.
 */
function env($varname, $default) {
    $var = getenv($varname);
    if (empty($var)) {
        return $default;
    }
    else {
        return $var;
    }
}

$migrate = env('migrate', NULL);
$name = env('name', NULL);
$uuid = env('uuid', NULL);
$framework = env('framework', NULL);
$vrt = env('vrt', NULL);
$contacts = env('contacts', NULL);
$owner = env('owner', NULL);

if ($migrate == "true") {
    // Migrate the site from PMU API.
    $PMU_CLASSIC_API_USER = getenv('PMU_CLASSIC_API_USER');
    $PMU_CLASSIC_API_PASSWORD = getenv('PMU_CLASSIC_API_PASSWORD');
    $AUTH = shell_exec("echo -ne \"$PMU_CLASSIC_API_USER:$PMU_CLASSIC_API_PASSWORD\" | base64 --wrap 0");
    $MIGRATABLE_SITE_DATA = shell_exec("curl --header \"Content-Type: application/json\" --header \"Authorization: Basic $AUTH\" \https://mu.ps-pantheon.com/api/uw/v2/site/$uuid");
    echo "Migratable site data: " . PHP_EOL;
    print_r(json_decode($MIGRATABLE_SITE_DATA, TRUE), TRUE) . PHP_EOL;
}
else {
    echo "TODO: Non migrated import" . PHP_EOL;
}