<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Users extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{users}}';
    }
    
    public static function getDb()
    {
        return \Yii::$app->db;
    }
    
    
    public function setFirstname($value)
    {
        $this->setAttribute("firstname" , $value);
    }
    
    public function getFirstname()
    {
        return $this->getAttribute("firstname");
    }
    
    public function setSecondname($value)
    {
        $this->setAttribute("secondname" , $value);
    }
    
    public function getSecondname()
    {
        return $this->getAttribute("secondname");
    }
    
    public function setSurname($value)
    {
        $this->setAttribute("surname" , $value);
    }
    
    public function getSurname()
    {
        return $this->getAttribute("surname");
    }
    
    public function setId($value)
    {
        $this->setAttribute("id", $value);
        return $this;
    }
    
    public function getId()
    {
        return $this->getAttribute("id");
    }
    
    
    public function count()
    {
        $count = (new Query())->select('COUNT(*)')->from('users')->count();
        return $count;
    }
    
}