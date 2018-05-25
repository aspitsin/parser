<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
$link = mysqli_connect('localhost', 'root', '', 'parser');

    // $html = file_get_contents('https://www.kolesa-darom.ru/moskva/diski/');
    $doc = \phpQuery::newDocument($html);
    $lists = pq('.offer-v1-container')->children('li');
    $links = array();

    foreach($lists as $item){
      $product = pq($item);
      $links[] = 'https://www.kolesa-darom.ru' . $product->find('.offer-v1-img > a')->attr('href');
    };
    $i = 0;
    $data = array();

    foreach($links as $item){
      $html = file_get_contents($item);
      $doc = \phpQuery::newDocument($html);

      $title = pq('h1')->text();
      $product_price = pq('.offer-page-price-new')->text();
      $image = pq('.lgallery')->attr('data-src');
      $color = pq('td.page-table-spec-attr:contains("Цвет")')->next('')->text();
      $diametr = pq('td.page-table-spec-attr:contains("Тип диска")')->next('')->text();
  
      $data[$i]['title'] = $title;
      $data[$i]['price'] = $product_price;
      $data[$i]['image'] = $image;
      $data[$i]['color'] = $color;
      $data[$i]['diametr'] = $diametr;
      $i++;
      \phpQuery::unloadDocuments();

       $link->query(" INSERT INTO `diski`(`title`, `price`, `image`, `color`, `diametr`) VALUES ('$title','$product_price','$image','$color','$diametr')");
    }
    
   

    }

    
?>

