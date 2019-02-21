<?php

// DB.php
// 目标: 让不会SQL 不会MySQLi的 早退同学 也能做数据库操作

class DB
{
    protected $table;
    protected $where;
    protected $limit;
    protected $orderby;
    protected $cols;
    protected $values;
    protected $set;

    protected $link;

    protected $host;
    protected $dbname;
    protected $port;
    protected $pwd;
    protected $user;

    //构造: 链接数据库
    public function __construct($conf = [])
    {
        $this->dbname = $conf['dbname'] ?? 'psd1809';
        $this->host   = $conf['host'] ?? 'localhost';
        $this->port   = $conf['port'] ?? 3306;
        $this->user   = $conf['user'] ?? 'root';
        $this->pwd    = $conf['pwd'] ?? '';

        $this->link = mysqli_connect($this->host, $this->user, $this->pwd, $this->dbname, $this->port);
    }

    //析构
    public function __destruct()
    {
        mysqli_close($this->link);
    }

    //不用写 链式写法的 中间写法
    public function __call($method, $args)
    {
        $this->$method = $args[0];
        return $this;
    }

    public function delete()
    {
        $sql = "DELETE FROM $this->table";

        if (isset($this->where)) {
            $sql .= " WHERE $this->where";
        }

        return $this->query($sql);
    }

    public function fetchAll()
    {
        $field = $this->cols ?? '*';

        $sql = "SELECT $field FROM $this->table";

        //where语句不一定存在, 必须要判断
        if (isset($this->where)) {
            // where左侧必须有空格
            $sql .= " WHERE $this->where";
        }

        //select语句拼接是有顺序要求的
        if (isset($this->orderby)) {
            $sql .= " ORDER BY $this->orderby";
        }

        if (isset($this->limit)) {
            $sql .= " LIMIT $this->limit";
        }

        //清理
        $res = $this->query($sql);

        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table($this->cols) VALUES($this->values)";

        return $this->query($sql);
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET $this->set ";

        if (isset($this->where)) {
            $sql .= " WHERE $this->where";
        }

        return $this->query($sql);

    }

    //提取
    public function query($sql)
    {
        $this->clear();

        $res = mysqli_query($this->link, $sql);

        if ($res === false) {
            echo 'SQL: ', $sql, '<hr>';
            die(mysqli_error($this->link));
        }
        return $res;
    }

    //清理链式写法的 变量
    public function clear()
    {
        $this->table   = null;
        $this->where   = null;
        $this->limit   = null;
        $this->orderby = null;
        $this->cols    = null;
        $this->values  = null;
        $this->set     = null;
    }

}
