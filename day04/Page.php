<?php

//Page.php
// $page = new Page(总个数, 每页数量);
// $page->show(); //呈现出分页效果

class Page
{
    protected $total;
    protected $num;

    protected $pages; //总页数

    protected $p; //页数

    public function __get($key)
    {
        return $this->$key;
    }

    public function __construct($total, $num)
    {
        $this->total = $total;
        $this->num   = $num;

        //为什么可以通过超链接读取p
        //因为当前代码实际运行时会被include到指定页面中, 一定有p参数
        $this->p = $_GET['p'] ?? 1;

        $this->pages = ceil($total / $num);
    }

    //首页
    public function firstPage()
    {
        if ($this->p == 1) {
            echo "<span>首页</span>";
        } else {
            echo "<a href='?p=1'>首页</a>";
        }
    }

    //上一页
    public function prevPage()
    {
        if ($this->p > 1) {
            $prevPage = $this->p - 1;
            echo "<a href='?p={$prevPage}'>上一页</a>";
        } else {
            echo "<span>上一页</span>";
        }
    }

    //中间页
    public function midPage()
    {
        $min = max($this->p - 5, 1); //较小值 最小是1
        //右极限 = 左极限 + 9, 右极限不能超过总页数
        $max = min($min + 9, $this->pages);
// 右极限-9, 算回左极限, 左极限不能小于1,  这是为了不足10页的情况
        $min = max($max - 9, 1);

        for ($i = $min; $i <= $max; $i++) {
            if ($this->p == $i) {
                echo "<span>{$i}</span>";
            } else {
                echo "<a href='?p={$i}'>{$i}</a>";
            }

        }
    }

    //下一页
    public function nextPage()
    {
        if ($this->p < $this->pages) {
            $nextPage = $this->p + 1;
            echo "<a href='?p={$nextPage}'>下一页</a>";
        } else {
            echo "<span>下一页</span>";
        }
    }

    //末页
    public function lastPage()
    {
        if ($this->p == $this->pages) {
            echo "<span>末页</span>";
        } else {
            echo "<a href='?p={$this->pages}'>末页</a>";
        }
    }

    public function show()
    {
        //首页
        $this->firstPage();
        //上一页
        $this->prevPage();
        //中间页: 保持10页
        $this->midPage();
        //下一页:
        $this->nextPage();
        //末页
        $this->lastPage();
    }
}
