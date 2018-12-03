<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr
 * Date: 29.11.2018
 * Time: 17:56
 */

class City
{
    public $id;
    public $cityName;
    public $countryId;

    public function __construct($id, $cityName, $countryId)
    {
        $this->id = $id;
        $this->cityName = $cityName;
        $this->countryId = $countryId;
    }
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return 'Ты дебил!! Такого свойства нет';
    }
}