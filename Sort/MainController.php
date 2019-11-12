<?php

class MainController
{
    const ARRAY_LENGTH = 100;
    
    static public function execute()
    {
        $input = self::getInput();
        
        if (isset($input['new_array'])) {
            $ar = self::newArray();
            
            return [serialize($ar), implode(', ', $ar), '', ''];
        }
        
        if (isset($input['sort_array'])) {
            if (!isset($input['array'])) {
                $ar = self::newArray();
            } else {
                try {
                    $ar = unserialize($input['array']);
                    if (empty($ar)) {
                        $ar = self::newArray();
                    }
                } catch (Exception $exc) {
                    $ar = self::newArray();
                }
            }
                
            $sortMethod = self::getSortMethodName($input['sort_name']);

            if ($sortMethod) {
                $time1 = microtime(true);
                $arSorted = $ar;
                self::$sortMethod($arSorted);
                $time2 = microtime(true);
                
                return [
                    serialize($ar),
                    implode(', ', $ar),
                    implode(', ', $arSorted),
                    $time2 - $time1
                ];
            }
        }
        
        return [serialize([]), '', '', ''];
    }
    
    static private function getInput()
    {
        $input = [];
        
        if (isset($_POST['new_array'])) {
            $input = ['new_array' => 'new_array'];
        }
        
        if (isset($_POST['sort_array'])) {
            $input = ['sort_array' => 'sort_array'];
            $input['sort_name'] = $_POST['sort_name'];            
            if (isset($_POST['array']) && $_POST['array'] !== '') {
                $input['array'] = $_POST['array'];
            }
        }
        
        return $input;
    }
    
    static private function newArray()
    {
        $ar = [];
        
        for ($i = 0; $i < self::ARRAY_LENGTH; $i++) {
            $ar[] = random_int(0, 1000);
        }
        
        return $ar;
    }
    
    static private function getSortMethodName($input)
    {
        $method = null;
        
        switch ($input) {
            case 'bubble_sort':
                $method = 'bubbleSort'; break;
            case 'insertion_sort':
                $method = 'insertionSort'; break;
            case 'selection sort':
                $method = 'selectionSort'; break;
            case 'quick_sort':
                $method = 'quickSort'; break;
            case 'shell_sort':
                $method = 'shellSort'; break;
            case 'merge_sort':
                $method = 'mergeSort'; break;
            case 'heap_sort':
                $method = 'heapSort'; break;
            case 'j_sort':
                $method = 'jSort'; break;
        }
        
        return $method;
    }
    
    static private function bubbleSort(&$ar)
    {
        $count = count($ar) - 2;
        $changed = true;
        
        while ($count > 1 && $changed) {
            $changed = false;
            
            for ($i = 0; $i < $count; $i++) {
                if ($ar[$i] >= $ar[$i + 1]) {
                    
                    $buf = $ar[$i];
                    $ar[$i] = $ar[$i + 1];
                    $ar[$i + 1] = $buf;
                    
                    $changed = true;
                }
            }
            
            $count--;
        }
    }
    
    static private function insertionSort(&$ar)
    {   
        for ($i = 1; $i < count($ar); $i++) {
            $j = $i;
            while ($j > 0 && $ar[$j] < $ar[$j - 1]) {
                list ($ar[$j], $ar[$j - 1]) = [$ar[$j - 1], $ar[$j]];
                $j--;
            }
        }
    }
    
    static private function selectionSort(&$ar)
    {
        $count = count($ar);
        for ($i = 0; $i < $count - 1; $i++) {
            $index = $i;
            
            for ($j = $i + 1; $j < $count; $j++) {
                if ($ar[$j] < $ar[$index]) {
                    $index = $j;
                }
            }
            
            if ($index !== $i) {
                list ($ar[$i], $ar[$index]) = [$ar[$index], $ar[$i]];
            }
        }
    }
    
    private static function quickSort(&$ar, $left = null, $right = null)
    {
        if (is_null($left)) {
            $left = 0;
        }
        if (is_null($right)) {
            $right = count($ar) - 1;
        }
        
        $l = $left;
        $r = $right;
        $div = $ar[(int) (($left + $right) / 2)];
        
        do {
            while ($ar[$l] < $div) {
                $l++;
            }
            while ($ar[$r] > $div) {
                $r--;
            }
            
            if ($l <= $r) {
                if ($ar[$l] > $ar[$r]) {
                    list ($ar[$l], $ar[$r]) = [$ar[$r], $ar[$l]];
                }

                $l++;
                $r--;
            }
        } while ($l <= $r);
        
        if ($l < $right) {
            self::quickSort($ar, $l, $right);
        }
        
        if ($r > $left) {
            self::quickSort($ar, $left, $r);
        }
    }
    
    static private function shellSort(&$ar)
    {
        $inc = [];
        $size = count($ar);
        $s = 0;
        
        do {
            if ($s % 2 === 0) {
                $i = 9 * 2 ** $s - 9 * 2 ** ($s / 2) + 1;
            } else {
                $i = 8 * 2 ** $s - 6 * 2 ** (($s + 1) / 2) + 1;
            }
            
            $inc[$s] = $i;
            $s++;
        } while (3 * $i <= $size);
        
        for ($i = count($inc) - 1; $i >= 0; $i--) {
            for ($k = 0; $k < $inc[$i]; $k++) {
                $m = 0;
                $index = $subar = [];
                
                for ($j = 0; $j < $size; $j = $m * $inc[$i] + $k) {
                    $index[] = $j;
                    $subar[] = $ar[$j];
                    $m++;
                }
                
                self::insertionSort($subar);
                $r = 0;
                foreach ($index as $ind) {
                    $ar[$ind] = $subar[$r];
                    $r++;
                }
            }
        }
    }
    
    static private function mergeSort(&$ar)
    {
        $size = count($ar);
        
        for ($i = 0; 2 ** $i < $size; $i++) {
            for ($j = 0, $l = 0; $j < $size; $l++, $j = $l * 2 ** ($i + 1)) {
                $a = array_slice($ar, $j, 2 ** $i);
                $b = array_slice($ar, $j + 2 ** $i, 2 ** $i);
                
                $k = $m = 0;
                $v = -1;
                while ($k < count($a) || $m < count($b)) {
                    $v++;
                    $exist = array_key_exists($m, $b) && array_key_exists($k, $a);
                    if (!array_key_exists($m, $b) || $exist && $a[$k] < $b[$m]) {
                        $ar[$j + $v] = $a[$k];
                        $k++;
                        continue;
                    }
                    if (!array_key_exists($k, $a) || $exist && $b[$m] <= $a[$k]) {
                        $ar[$j + $v] = $b[$m];
                        $m++;
                    }
                }
            }
        }
    }
    
    static private function heapSort(&$ar)
    {
        $size = count($ar);
        
        while ($size > 1) {
            for ($i = (int) ($size / 2) - 1; $i >= 0; $i--) {
                $l = 2 * $i + 1;
                $r = 2 * $i + 2;

                if ($l < $size && $ar[$l] > $ar[$i]) {
                    list ($ar[$l], $ar[$i]) = [$ar[$i], $ar[$l]];
                }

                if ($r < $size && $ar[$r] > $ar[$i]) {
                    list ($ar[$r], $ar[$i]) = [$ar[$i], $ar[$r]];
                }
            }
            
            list($ar[0], $ar[$size - 1]) = [$ar[$size - 1], $ar[0]];
            $size--;
        }        
        
    }
    
    static private function jSort(&$ar)
    {
        $size = count($ar);
        
        for ($i = (int) ($size / 2) - 1; $i >= 0; $i--) {
            $l = 2 * $i + 1;
            $r = 2 * $i + 2;
            
            if ($r < $size && $ar[$r] < $ar[$i]) {
                list ($ar[$r], $ar[$i]) = [$ar[$i], $ar[$r]];
            }

            if ($l < $size && $ar[$l] < $ar[$i]) {
                list ($ar[$l], $ar[$i]) = [$ar[$i], $ar[$l]];
            }
        }

        for ($i = (int) ($size / 2); $i < $size; $i++) {
            $l = 2 * $i - $size;
            $r = 2 * $i - $size - 1;

            if ($l >= 0 && $ar[$l] > $ar[$i]) {
                list ($ar[$l], $ar[$i]) = [$ar[$i], $ar[$l]];
            }

            if ($r >= 0 && $ar[$r] > $ar[$i]) {
                list ($ar[$r], $ar[$i]) = [$ar[$i], $ar[$r]];
            }
        }
        
        self::insertionSort($ar);
    }
}
