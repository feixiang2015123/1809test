<?php
abstract class People
{
    public $name;
    public $age;
    public $sex;
    abstract public function eat();

}
class Student extends People
{
    // public $name;
    // public $age;
    // public $sex;
    public function eat()
    {
        echo '肯德基';
    }
    public function study()
    {
        echo "学习";
    }
}
class Teacher extends People
{
    // public $name;
    // public $age;
    // public $sex;
    public function teach()
    {
        echo "教学";
    }
    public function eat()
    {
        echo '中餐';
    }

}
