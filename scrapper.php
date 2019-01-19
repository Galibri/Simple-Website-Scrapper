<?php

include_once('simple_html_dom.php');

$webstieUrl = $_POST['url'];

$html = file_get_html($webstieUrl);
$count = 1;
$fullArray = [];
$listArray = [];

foreach ($html->find('.cate-list-top') as $wrap) {
    $rowCount = 0;
    foreach($wrap->find('.row') as $row) {
        $count = 0;
        foreach($row->find('.col-sm-3') as $col) {
            if($rowCount == 0 ) continue;
            if($count == 0) {
                $listArray['district'] = $col->plaintext;
            } elseif($count == 1) {
                $listArray['thana'] = $col->plaintext;
            } elseif($count == 2) {
                $listArray['suboffice'] = $col->plaintext;
            } elseif($count == 3) {
                $listArray['postal_code'] = $col->plaintext;
            }

            $count++;

        }
        $rowCount++;
        array_push($fullArray, $listArray);
    }
}
array_shift($fullArray);
echo json_encode($fullArray);