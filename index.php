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
printf ($dolgota);
echo "<br>Широта: ";
printf ($shirota);

?>

