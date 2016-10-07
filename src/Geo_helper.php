<?php

namespace Dreper;

class Geo_helper {

    // 位置是否在范围顶点
    public $pointOnVertex = true; // Check if the point sits exactly on one of the vertices?
 
    function pointInPolygon($point, $polygon, $pointOnVertex = true) {

        $this->pointOnVertex = $pointOnVertex;

        // 参照坐标数组
        $point = $this->pointStringToCoordinates($point);

        // 多边形坐标数组
        $vertices = array(); 

        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex); 
        }
 
        // 坐标是否在顶点
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "vertex";
        }
 
        // 判断坐标是都在多边形内部或边缘上
        $intersections = 0; 
        $vertices_count = count($vertices);
        for ($i=1; $i < $vertices_count; $i++) {

            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];

            if (    $vertex1['y'] == $vertex2['y'] 
                    and $vertex1['y'] == $point['y'] 
                    and $point['x'] > min($vertex1['x'], $vertex2['x']) 
                    and $point['x'] < max($vertex1['x'], $vertex2['x'])
               ) 
               { 
                return "boundary";
               }
            if (    $point['y'] > min($vertex1['y'], $vertex2['y']) 
                    and $point['y'] <= max($vertex1['y'], $vertex2['y']) 
                    and $point['x'] <= max($vertex1['x'], $vertex2['x']) 
                    and $vertex1['y'] != $vertex2['y']
               ) 
               { 
                    $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                    if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                        return "boundary";
                    }
                    if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                        $intersections++; 
                    }
               } 
        } 
        // If the number of edges we passed through is odd, then it's in the polygon. 
        if ($intersections % 2 != 0) {
            return "inside";
        } else {
            return "outside";
        }
    }
    /**
     * 判断坐标是否在多边形顶点上
     * 
     * 如果多边形其中一个坐标与参照坐标相等
     * 被判定为在顶点上
     */ 
    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
 
    }
    /**
     * 坐标参数格式化
     * 坐标参数以空格分隔,并添加x,y key
     *
     * return array
     */ 
    function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }


}
