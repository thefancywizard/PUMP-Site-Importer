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
$site_uuid = env('site_uuid', NULL);
$framework = env('framework', NULL);
$vrt = env('vrt', NULL);
$contacts = env('contacts', NULL);
$owner = env('owner', NULL);

$site_info = [];
if ($migrate == "true") {
    // Migrate the site from PMU API.
    print_r("Going to import queried data:" . PHP_EOL);
    $SITE_CLASSIC_PMU_DATA = getenv('SITE_CLASSIC_PMU_DATA');
    $SITE_CLASSIC_PMU_DATA = json_decode($SITE_CLASSIC_PMU_DATA, TRUE);
    $name = $SITE_CLASSIC_PMU_DATA['name'];
    $framework = $SITE_CLASSIC_PMU_DATA['framework'];
    $owner = $SITE_CLASSIC_PMU_DATA['author']['email'];
    $site_info['name'] = $name;
    $site_info['framework'] = $framework;
    $site_info['owner'] = $owner;

}
else {
    echo "TODO: Non migrated import" . PHP_EOL;
}

// Write out data to pass to next steps.
$PATH_TO_module_UPDATE_DATA_JSON = "/tmp/update_data.json";
file_put_contents($PATH_TO_module_UPDATE_DATA_JSON, json_encode($site_info));