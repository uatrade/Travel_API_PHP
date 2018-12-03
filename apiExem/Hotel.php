<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr
 * Date: 30.11.2018
 * Time: 10:37
 */

class Hotel
{
    public $id;
    public $hotelName;
    public $cityId;
    public $countryId;
    public $stars;
    public $cost;
    public $info;

    public function __construct($id, $hotelName, $cityId, $countryId, $stars, $cost, $info)
    {
        $this->id = $id;
        $this->hotelName = $hotelName;
        $this->countryId = $countryId;
        $this->cityId=$cityId;
        $this->stars=$stars;
        $this->cost=$cost;
        $this->info=$info;
    }
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return 'Ты дебил!! Такого свойства нет';
    }
}