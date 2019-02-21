<?php
class FileSystem
{
    public static function mkdir($dir, $mode = 0777, $recursive = false)
    {
        return mkdir($dir, $mode, $recursive);
    }
    public static function rmdir($dir)
    {
        return rmdir($dir);
    }
    public static function rename($oldname, $newname)
    {
        return rename($oldname, $newname);
    }
    public static function scandir($dir)
    {
        return scandir($dir);
    }
    public static function touch($dir)
    {
        return touch($dir);
    }
    public static function unlink($dir)
    {
        if (file_exists($dir)) {
            return unlink($dir);
        }
    }
    public static function filePutContents($filename, $data)
    {
        return file_put_contents($filename, $data);
    }
    public static function fileGetContents($filename)
    {
        return file_get_contents($filename);
    }
    public static function getSize($path)
    {
        function getSize($path)
        {
            $bytes = filesize($path);

            $n = 0; //进位的次数
            //满足>1024 就说明可以进位
            while ($bytes >= 1024) {
                // 每次除以1024 就说明可以进一位, 所以+1
                $n++;
                // $bytes = $bytes / 1024; 获取进位后的大小
                $bytes /= 1024;
            }
            //按照进位关系, 摆放的单位数组
            $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
            //round() 保留几位小数
            //$units[$n]; 序号是进位次数, 从数组中读取对应的 单位
            return round($bytes, 2) . $units[$n];
        }
        return getSize($path);
    }
    public static function isFile($path)
    {
        return is_file($path);
    }
    public static function isDir($dir)
    {
        return is_dir($dir);
    }
    public static function isWritable($filename)
    {
        return is_writable($filename);
    }
    public static function isReadable($filename)
    {
        return is_readable($filename);
    }
    public static function copy($source, $dest)
    {
        return copy($source, $dest);
    }
    public static function read($path, $mode)
    {
        $mode = 'r';

        $handle = fopen('D:/php7.0/php.ini', $mode);
//2.读取一行
        // echo fgets($handle), '<br>';
        // echo fgets($handle), '<br>';
        // echo fgets($handle), '<br>';

//feof : file end of file; 判断是否读取到了结尾
        // 当 没有 读到结尾时, 就读取一行
        while (!feof($handle)) {
            echo fgets($handle), '<br>';
        }

//3.关闭文件
        fclose($handle);
        return read($path, $mode);
    }

}
