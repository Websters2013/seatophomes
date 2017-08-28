<?php
$value = $_GET['value'];

$json_data = '["Заложенность носа", "Инфекции придаточных пазух носа", "Нос действует как фильтр","Носовые раковины сужаются", "Полностью раскрытые носовые"]';

$json_data = str_replace("\r\n",'',$json_data);
$json_data = str_replace("\n",'',$json_data);

echo $json_data;
exit;
?>
