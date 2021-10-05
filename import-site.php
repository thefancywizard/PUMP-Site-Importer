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
    print_r("Going to import queried data:" . PHP_EOL);
    $SITE_CLASSIC_PMU_DATA = getenv('SITE_CLASSIC_PMU_DATA');
    print_r($SITE_CLASSIC_PMU_DATA);
}
else {
    echo "TODO: Non migrated import" . PHP_EOL;
}