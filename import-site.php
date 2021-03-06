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
    $machinename = exec("terminus site:info $site_uuid --field Name");
    $framework = $SITE_CLASSIC_PMU_DATA['framework'];
    $git_url = $SITE_CLASSIC_PMU_DATA['config']['ci']['external_repo_url'];
    $owner = $SITE_CLASSIC_PMU_DATA['author']['email'];
    $vrt = urlencode(json_encode($SITE_CLASSIC_PMU_DATA['vrt']));
    $site_info['name'] = $name;
    $site_info['framework'] = $framework;
    $site_info['owner'] = $owner;
    $site_info['vrt'] = $vrt;
    $site_info['machinename'] = $machinename;
    if (!empty($git_url)) {
        $site_info['git_url'] = $git_url;
    }
    

}
else {
    $site_info['name'] = $name;
    $site_info['framework'] = $framework;
    $site_info['owner'] = $owner;
    $site_info['vrt'] = $vrt;
    $site_info['machinename'] = $machinename;
    if (!empty($git_url)) {
        $site_info['git_url'] = $git_url;
    }
}

// Write out data to pass to next steps.
$PATH_TO_module_UPDATE_DATA_JSON = "/tmp/update_data.json";
file_put_contents($PATH_TO_module_UPDATE_DATA_JSON, json_encode($site_info));