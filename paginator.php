<?php
/**
 * Created by PhpStorm.
 * User: alexanderpanteleev
 * Date: 30.08.18
 * Time: 17:22
 */
$goods =[ [ "title" => "Lenovo", "price" => 9e3, "reviews" => 107, "rating" => 11], [ "title" => "iPhone", "price" => 9e4, "reviews" => 120, "rating" => 12], [ "title" => "Samsung", "price" => 5e4, "reviews" => 110, "rating" => 14], [ "title" => "Lenovo", "price" => 2e4, "reviews" => 130, "rating" => 15], [ "title" => "Xiaomi ", "price" => 7e3, "reviews" => 110, "rating" => 13],[ "title" => "Panasonic", "price" => 8e3, "reviews" => 104, "rating" => 10], [ "title" => "Huawei", "price" => 4e3, "reviews" => 117, "rating" => 9] ];

const ITEMS = 3;    // кол-во элементов на странице
$page = empty($_GET['page']) ? '1' : (int) $_GET['page'];   // страница
/**
 * @param array $array - массив товаров
 * @param int $page - текущая страница
 * @return string - рендеринг товаров
 */
function renderList(array $array, int $page){
    $list='<ul class="list-group">';
    for($i = ($page-1)*ITEMS; $i < min($page*ITEMS, count($array)); $i++){
        //if($i === count($array)) break;
        $list .= "<li class=\"list-group-item\">Товар:".$array[$i]['title']."<br>Цена:".$array[$i]['price']."<br>Рейтинг:".$array[$i]['rating']."</li>";
    }
    return $list .= "</ul>";
    
};
/**
 * @param int $quantity - кол-во элементов
 * @return string - рендер пагинатора
 */
function insertPaginator(int $quantity){
  global $page;
  $pages = ceil($quantity/ITEMS);
  $list='';
  // параметр активации 'previous'
  $disabled = $page === 1 ? 'disabled': '' ;
  $disabledNext = $page == $pages ? "disabled":"";
  for($i = 1; $i <= $pages; $i++){
      $list .= "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
  }
  return "<nav aria-label=\"Page navigation example\">
    <ul class=\"pagination pagination-sm\">
        <li class=\"page-item $disabled\">
            <a class=\"page-link\" href=\"?page=".($page-1)."\" tabindex=\"-1\">Previous</a>
        </li>$list
        <li class=\"page-item $disabledNext\">
            <a class=\"page-link\" href=\"?page=".($page+1)."\">Next</a>
        </li>
    </ul>
</nav>";
};

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .list-group-item {
          height: 90px;
          font-size: 14px;
      }
    </style>
</head>
<body>
    <?=renderList($goods, $page)?>
    <?=insertPaginator(count($goods))?>
</body>
</html>
