<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 31/10/2016
 * Time: 22:43
 */

namespace Samcrosoft\GeoBuzz\Repository;


use GeoIp2\Database\Reader;
use Illuminate\Support\Fluent;

/**
 * Class GeoBuzzRepository
 * @package Samcrosoft\GeoBuzz\Repository
 */
class GeoBuzzRepository
{

    public static function parseIPToDetails($sIPAddress)
    {
        // This creates the Reader object, which should be reused across // lookups.
        $reader = new Reader(__DIR__.'/../data/city/GeoLite2-City.mmdb');

        // Replace "city" with the appropriate method for your database, e.g., // "country".
        $record = $reader->city($sIPAddress);

        header('Content-Type: application/json');
        $oRJson = $record->jsonSerialize();
        echo collect($oRJson)->toJson();
        dd($oRJson);

        print($record->country->isoCode . "\n"); // 'US'
        print($record->country->name . "\n"); // 'United States'
        print($record->country->names['zh-CN'] . "\n"); // '美国'

        print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
        print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

        print($record->city->name . "\n"); // 'Minneapolis'

        print($record->postal->code . "\n"); // '55455'

        print($record->location->latitude . "\n"); // 44.9733
        print($record->location->longitude . "\n"); // -93.2323
        echo "getting inside here";
    }
}