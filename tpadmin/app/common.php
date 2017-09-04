<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

    /**
    * excel表格导出
    * @param string $fileName 文件名称
    * @param array $headArr 表头名称
    * @param array $data 要导出的数据
    * @param array $setWidth 要调整行宽的格
    * @author static7  
    */
    function excelExport($fileName = '', $headArr = [], $data = [] , $setWidth = []) {
        
        $fileName .= date("Ymdhis",time()).".xls";
        
        $objPHPExcel = new \PHPExcel();
        
        $objPHPExcel->getProperties();
        
        $key = ord("A"); // 设置表头
        
        foreach ($headArr as $v) {
        
            $colum = chr($key);
        
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
               
            $key += 1;
        
        }
        
        $column = 2;
        
        $objActSheet = $objPHPExcel->getActiveSheet();
        
        foreach ($data as $key => $rows) { // 行写入
        
            $span = ord("A");
        
            foreach ($rows as $keyName => $value) { // 列写入
        
                $objActSheet->setCellValue(chr($span) . $column, $value);
        
                $span++;
        
            }
        
            $column++;
        
        }
        
        foreach ($setWidth as $k => $v) {
        
            $objPHPExcel->getActiveSheet()->getColumnDimension($k)->setWidth($v);//对某列单元格设置宽度
        
        }
        
        $fileName = iconv("utf-8", "gb2312", $fileName); // 重命名表
        
        $objPHPExcel->setActiveSheetIndex(0); // 设置活动单指数到第一个表,所以Excel打开这是第一个表

        $objPHPExcel->getActiveSheet()->setTitle('sheet1');
        
        header('Content-Type: application/vnd.ms-excel');
        
        header("Content-Disposition: attachment;filename='$fileName'");
        
        header('Cache-Control: max-age=0');

        header('Cache-Control: max-age=1');

        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        
        $objWriter->save('php://output'); // 文件通过浏览器下载
        
        exit();
    
    }

    /**
    * 对象转数组
    * @param object $object 对象
    */
    function object2array($object) {
        $array = array();
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        }else{
            $array = $object;
      }
      return $array;
    }