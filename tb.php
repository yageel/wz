<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016/10/24
 * Time: 20:18
 */
set_time_limit(0);
ini_set('memory_limit', '1024M');
header("Content-type: text/html; charset=utf-8");
require_once("./auto/config.php");
require_once("./Classes/PHPExcel.php");
$filename = "./2016-10-24.xls";

$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
$objPHPExcel = $objReader->load($filename);

$objWorksheet = $objPHPExcel->getActiveSheet();
$i = 0;
foreach($objWorksheet->getRowIterator() as $row){
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    $i=0;
    $data = [];
    foreach($cellIterator as $cell){

        if($i == 0)$data['num_iid'] = trim($cell->getValue());
        if($i == 1)$data['title'] = trim($cell->getValue());
        if($i == 2)$data['pic_url'] = trim($cell->getValue());
        if($i == 3)$data['url'] = trim($cell->getValue());
        if($i == 4)$data['shop_name'] = trim($cell->getValue());
        if($i == 5)$data['price'] = trim($cell->getValue());
        if($i == 6)$data['total_sell'] = trim($cell->getValue());
        if($i == 7)$data['bilv'] = trim($cell->getValue());
        if($i == 8)$data['credit'] = trim($cell->getValue());
        if($i == 9)$data['wangwang'] = trim($cell->getValue());
        if($i == 10)$data['jump_url'] = trim($cell->getValue());
        if($i == 11)$data['total_num'] = trim($cell->getValue());
        if($i == 12)$data['left_num'] = trim($cell->getValue());
        if($i == 13)$data['remark'] = trim($cell->getValue());
        if($i == 14)$data['start_date'] = trim($cell->getValue());
        if($i == 15)$data['end_date'] = trim($cell->getValue());
        if($i == 16)$data['youhui_url'] = trim($cell->getValue());

        $i++;
    }
    $data['create_time'] = time();
    $data['update_time'] = time();
    if($data['num_iid'] == '商品id'){continue;}
    $info = M('goods')->where(['num_iid'=>$data['num_iid']])->field('id')->find();
    if($info){
        M('goods')->where(['id'=>$info['id']])->save($data);
    }else{
        M('goods')->add($data);
    }
}