<?php
class Upload
{
    public static function save($dir)
    {
        $tmp = reset($_FILES);
        $tmp = reset($tmp);
        if (is_array($tmp)) {
            return static::saveMul($dir);
        } else {
            return static::saveSingle($dir);
        }

    }
    public static function saveSingle($dir)
    {
        return self::saveFlies($_FILES, $dir);
    }
    public static function saveMul($dir)
    {
        foreach ($_FILES as $key => $value) {
            foreach ($value as $kk => $vv) {
                foreach ($vv as $k => $v) {
                    $newArr[$k][$kk] = $v;
                }
            }
        }
        return self::saveFlies($newArr, $dir);
    }
    public static function saveFlies($arr, $dir)
    {
        $files = [];
        foreach ($arr as $key => $value) {
            $filename    = $value['tmp_name'];
            $uniqueName  = md5(microtime(true)) . mt_rand(1e8, 9e8);
            $ext         = pathinfo($value['name'], PATHINFO_EXTENSION);
            $destination = "{$dir}/{$uniqueName}.{$ext}";
            $suc         = move_uploaded_file($filename, $destination);
            if ($suc) {
                $file[] = "{$uniqueName}.{$ext}";
            }

        }
        return $files;
    }
}
