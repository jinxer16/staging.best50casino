Geot Maxmind
=========================

WordPress plugin built for [GeotargetingWP](https://geotargetingwp.com) subscription users that will download and update [Maxmind Geolite 2](https://dev.maxmind.com/geoip/geoip2/geolite2/) database automatically.
 
Installation
--------
Like any other WordPress plugin, upload zip and activate using wp-admin plugins page.

Settings
--------
No settings are needed for GeotargetingWP users. Simple install and activate and it will work.

If you want to change database or local path use the following filters:
````
self::$url_maxmind_db = apply_filters( 'geotmax/url_external', 'http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.tar.gz' );
   
self::$path_maxmind_geo = apply_filters( 'geotmax/path_local', $path_upload['basedir'] . '/geot_plugin/GeoLite2-City.mmdb' );
````
   		
   		

Requirements
--------
* PHP >= 5.4
* WordPress 3.6