<?php

use Database\ProductDao;

require_once (__DIR__ . '/autoload.php');
spl_autoload_register("autoload");

$productDao = new ProductDAO();

echo "insert" . PHP_EOL;
debug($productDao->insert(array("name", "price"), array("Товар1", 500.50)));

echo "update" . PHP_EOL;
debug($productDao->update(1, array("name" => "Товар1", "price" => 500.50)));

echo "find" . PHP_EOL;
debug($productDao->find(2));

echo "delete" . PHP_EOL;
debug($productDao->delete(5));

function debug($obj)
{
    echo dump($obj);
}

function dump($obj): string
{
    if (is_array($obj)) {
        $str = "";
        foreach ($obj as $k => $v) {
            $str .= ($k . "=>" . dump($v) . " ");
        }
        return $str . PHP_EOL;
    }
    return var_export($obj, true) . PHP_EOL;
}