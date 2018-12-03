<?php
include_once 'Country.php';
include_once '../views/functions.php';
include_once 'City.php';
include_once 'Hotel.php';
connect();
//file_put_contents('test.txt', $_POST['insCity'].' '.$_POST['param'].' '.$_POST['insCountry'].' '.$_POST['token']);

//file_put_contents('test.txt', $_POST['param'].' '.$_POST['object'].' '.$_POST['token']);
if(checkToken($_POST['token'])){
    if($_POST['param'] == 'getCountries'){
        $items = [];
        $res = mysql_query('select * from countries');
        while ($row = mysql_fetch_array($res, MYSQL_ASSOC)){
            $items[] = new Country($row['id'], $row['countryName']);
        }
        //file_put_contents('test.txt', json_encode($items));
        echo json_encode($items);
    }

    if($_POST['param'] == 'GetCity' and $_POST['country']!=''){
        $items = [];
        $findCities=$_POST['country'];
        //file_put_contents('test.txt', $findCities);
        $res = mysql_query("SELECT cities.id, cities.cityName, cities.countryId, countries.countryName 
        from cities INNER JOIN countries 
        ON cities.countryId=countries.id WHERE countries.countryName='$findCities'");

        while ($row = mysql_fetch_array($res, MYSQL_ASSOC)){
            $items[]=new City($row['id'], $row['cityName'], $row['countryId']);
        }
        //file_put_contents('test.txt', json_encode($items));
        echo json_encode($items);
    }
    /*Получение отелей*/
    if($_POST['param'] == 'GetHotels' and $_POST['cities']!=''){
        //file_put_contents('test.txt', $_POST['cities']);
        $items = [];
        $findHotels=$_POST['cities'];
        //file_put_contents('test.txt', $findCities);
        $res = mysql_query("SELECT hotels.id, hotels.hotelName, hotels.cityId, hotels.countryId,
        hotels.cost, hotels.info, hotels.stars
        from hotels
        INNER JOIN cities
        ON hotels.cityId=cities.Id
        where cities.cityName='$findHotels'");

        while ($row = mysql_fetch_array($res, MYSQL_ASSOC)){
            $items[]=new Hotel($row['id'], $row['hotelName'], $row['cityId'], $row['countryId'], $row['stars'], $row['cost'], $row['info']);
        }
        //file_put_contents('test.txt', json_encode($items));
        echo json_encode($items);
    }

    if($_POST['param'] == 'insCountries'){
        //file_put_contents('test.txt', $_POST['param'].' '.$_POST['object'].' '.$_POST['token']);

        $items = json_decode($_POST['object'], true);
        $c = $items['countryName'];
        //file_put_contents('test.txt', $c);
        mysql_query("insert into countries(countryName)VALUES ('$c')");
        $err = mysql_errno();
        //file_put_contents('test.txt', $err);

        if(!$err){
            echo '200';
        }
    }

    if($_POST['param'] == 'insCity'){
        $items = [];
        $countryName=$_POST['insCountry'];
        $cityName=$_POST['insCityName'];
        $res = mysql_query("select id from countries where countryName='$countryName'");

        $num=mysql_fetch_row($res);   //id страны Ok

        file_put_contents('test.txt', $num[0]);

        $res=mysql_query("insert into cities(`cityName`, `countryId`) values ('$cityName', '$num[0]')");

        $err = mysql_errno();
        file_put_contents('test.txt', $err);
        if(!$err){
            echo '200';
        }
    }


}else
    echo '<h1>Gonduras!!!</h1>';