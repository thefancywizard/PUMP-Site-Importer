# site-importer
Imports and updates PMU sites into the ClientDB

The following site attributes are inserted and updated by this Action:
- `migrate` - If "true", will call the PMU Classic API to pull over the site data from the Wordpress API into the new DB. If this is used, only have to provide `uuid` to query against PMU Classic API.
- `name` - The site label on Pantheon
- `uuid` - the site UUID
- `framework` - The site framework - "drupal", "wordpress", "wordpress_network"
- `vrt` - A JSON object with a "urls" key which is an array of the VRT URLs to test, and a "on_ready_script_base64" which is the site's onReadyScript to use in VRT in base64 format
- `contacts` - A JSON object with keys of "staff" and "clients". Both "staff" and "clients" are arrays of email addresses.
- `dedicated_staff` - The "author" from the Classic API who is assigned as designated manager for the site. Is an email address.
