<?php
/**
 * Created by PhpStorm.
 * User: fangaolin
 * Date: 2018/7/5
 * Time: 17:01
 */


/**
 * 重构数组，将指定字段设置为键值
 * @param array $array  源数组
 * @param string $key   重构的键名
 * @return array|bool   重构后的数组
 */
function refactor_array(array $array, $key = 'id')
{
    if (!is_array($array)){
        return false;
    }
    $new_array = array();
    foreach ($array as $val) {
        $new_array[$val[$key]] = $val;
    }

    return $new_array;
}


/**
 * 将数组转换为树状数组
 * @param array $array 源数组（此数组应当以关联键作为键值）
 * @param string $pk 关联的键
 * @param string $relation 相关联的键
 * @return array|bool 处理后的数组
 */
function tree_array(array $array, $pk = 'id', $relation = 'parent_id')
{
    if (!$array || empty($pk) || empty($relation)) {
        return false;
    }

    $pk = trim($pk);
    $relation = trim($relation);

    $tree = array();
    foreach ($array as $val) {
        if (isset($array[$val[$relation]])) {
            $array[$val[$relation]]['children'][] = &$array[$val[$pk]];
        } else {
            $tree[] = &$array[$val[$pk]];
        }
    }

    return $tree;
}