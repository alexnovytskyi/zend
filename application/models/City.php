<?php

/**
 * Description of City
 *
 * @author alexandr
 */
class Model_City {

    //put your code here
    public static function search($key) {
        $filter = function($city) use ($key) {
                    if (stristr($city, $key))
                        return true;
                    return false;
                };
        return array_filter(self::$cities, $filter);
    }

    protected static $cities = array(
        'Odessa',
        'Kiev',
        'Moscow',
        'St.Petersbourgh',
        'Minsk',
        'New york',
        'Dagestan',
        'Kazakhstan',
        'Cossackstan',
        'Ilyichevsk',
        'Molodezhnoe'
    );

}

?>
