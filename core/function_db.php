<?php
/**
 * Created by PhpStorm.
 * User: junjie
 * Date: 2015/8/31
 * Time: 14:24
 */




function table($name){
    global $config;
    return '`'.$config['db_pre']. $name.'`';
}

//$sql = "INSERT INTO `php_msg`.`pre_article_title`(";
//$sql.= "`title`,";
//$sql.= "`desc`";
//$sql.= ") VALUES (";
//$sql.= "$title,";
//$sql.= "$desc";
//$sql.= ")";

$data = array(
    'title' => 'aa',
    'desc' => '999'
);



function parseData($value){
    if(is_string($value)){
        return "'".$value."'";
    }else{
        return $value;
    }
}
//insert('abc',$data);
function insert($table,$data,$return = true){
    $sql = " INSERT INTO  ".table($table). "(";
    $keys = array_keys($data);
    $fields = $values = array();
    foreach($keys as $v){
        $fields[] = '`'.$v.'`';
        $values[] = parseData($data[$v]);
    }
    $sql.= implode(',',$fields);
    $sql.= " ) VALUE (";
    $sql.= implode(',',$values);
    $sql.= "); ";

    mysql_query($sql);
    if($return){
        return mysql_insert_id();
    }
}



$data2 = array(
    array(
        'b' => 'aa',
        'y' => '999'
    ),
    array(
        'b' => '77',
        'y' => '00'
    )


);

//batchInsert('a',$data2);
function batchInsert($table,$data){
    $sql = "INSERT INTO" .table($table). "(";
    $array = $data;
    $keys =  array_keys(array_shift($array));
    //print_r($keys);
    $fields = $values = array();
    foreach($keys as $v){
        $fields[] =  '`'.$v.'`';

    }
    $sql.= implode(',',$fields);
    $sql.= ") VALUES  ";
    foreach($data as $k1=>$v1){
         $val = array();
        foreach($v1 as  $v2){
            //print_r($v2);exit;
            $val[] = $v2;
            //print_r($val);exit;
        }
        $values[] = '('.implode(',',$val).')';
    }

    $sql.= implode(',',$values);
    $sql.= ";";
    mysql_query($sql);




}