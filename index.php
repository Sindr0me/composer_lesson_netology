<?php 
require __DIR__.'/vendor/autoload.php';
$api = new \Yandex\Geo\Api();

// Можно искать по точке
// $api->setPoint(30.5166187, 50.4452705);
$adress = $_POST['adress'];
// Или можно икать по адресу
$api->setQuery($adress);

// Настройка фильтров
$api
    // ->setLimit(1) // кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
    ->load();

$response = $api->getResponse();
$response->getFoundCount(); // кол-во найденных адресов
$response->getQuery(); // исходный запрос
$response->getLatitude(); // широта для исходного запроса
$response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
$collection = $response->getList();
foreach ($collection as $item) {
    $item->getAddress(); // вернет адрес
    $shirota = $item->getLatitude(); // широта
    $dolgota = $item->getLongitude(); // долгота
    $item->getData(); // необработанные данные
}
echo "Долгота: ";
echo $dolgota;
echo '<script language="javascript">var a = parseFloat('.$dolgota.');</script>';


echo "<br>Широта: ";
echo $shirota;
echo '<script language="javascript">var b = parseFloat('.$shirota.');</script>';
// $shir = printf ($shirota);
// echo "$shir";
// echo '<script language="javascript">var b = parseFloat('.$shir.');</script>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Задание собственного изображения для метки</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...)-->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <!-- <script src="icon_customImage.js" type="text/javascript"></script> -->
    <script type="text/javascript">

    ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [(b), (a)], //1 - широта. 2 - долгота
            zoom: 9
        }, {
            searchControlProvider: 'yandex#search'
        }),

        // Создаём макет содержимого.
        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        ),

        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'Собственный значок метки',
            balloonContent: 'Это красивая метка'
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: 'images/myIcon.gif',
            // Размеры метки.
            iconImageSize: [30, 42],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-5, -38]
        });



    myMap.geoObjects
        .add(myPlacemark)
        .add(myPlacemarkWithContent);
});
	</script>
	<style>
        html, body, #map {
            width: 400px; height: 400px; padding: 0; margin: 0;
        }
    </style>
</head>
<body>
<div id="map"></div>



</body>
</html>
