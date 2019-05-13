<?php
function leveling($source, $indent="\t", $i=0) { // leveled string => leveled array
    $current_indent = str_repeat($indent, $i);
    $list = preg_split("/\n$current_indent(?!$indent)/", $source);
    $list = array_filter($list);

    if ( count($list) >= 1 ) {
        $return = [];

        foreach ( $list as $item ) {
            $temp = preg_split("/\n$current_indent/", $item, 2);

            if ( count($temp)==1 ) {
                $return[] = trim($item);
            } else {
                $return[trim($temp[0])] = leveling($temp[1], $indent, $i+1);
            }
        }

        return $return;
    } else {
        return $list;
    }
}
function unleveling($source, $indent="\t", $i=0) { // leveled array => leveled string
    $return = "";

    foreach ( $source as $key => $item ) {
        if ( is_array($item) ) {
            $return .= str_repeat($indent, $i) . $key . "\n";
            $return .= unleveling($item, $indent, $i+1);
        } else {
            $return .= str_repeat($indent, $i) . $item . "\n";
        }
    }

    return $return;
}
function flating($source, $fields=[], $i=0) { // leveled array => database array
    $return = [];

    $field = array_shift($fields);
    if ( !$field ) $field = 'field' . ($i+1);

    foreach ( $source as $key => $value ) {
        if ( is_array($value) ) {
            $temp = flating($value, $fields, $i+1);

            foreach ( $temp as $k => $item ) {
                $temp[$k][$field] = $key;
            }

            $return = array_merge($return, $temp);
        } else {
            $return[] = [
                $field => $value,
            ];
        }
    }

    return $return;
}
function unflating($source, $fields=[], $i=0, $compare_fields=[]) { // database array => leveled_array
    $return = [];

    $field = array_shift($fields);
    if ( !$field ) $field = 'field' . ($i+1);

    foreach ( $source as $item ) {
        $flag = 1;

        if ( $compare_fields ) {
            foreach ( $compare_fields as $key => $value ) {
                if ( $item[$key] != $value ) $flag = 0;
            }
        }

        if ( $flag ) {
            if ( !$fields ) {
                $return[] = $item[$field];
            } else {
                $return[$item[$field]] = unflating($source, $fields, $i+1, [$field => $item[$field]]);
            }            
        }
    }

    return $return;
}