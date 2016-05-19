<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 5/13/16
 * Time: 3:46 PM
 */

namespace App\Helpers;

/**
 * Class CoreHelpersLibrary
 * This class conveniently consolidates helper functions that does not fit well in other libraries/classes.
 * @package App\Libraries
 */
class Util
{
    public static function env($varName, $defaultValue = NULL)
    {
        if(isset($varName)||!empty($varName)) {
            return getenv($varName);
        }
        return $defaultValue;
    }
}