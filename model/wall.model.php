<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:30
 */
class Wall
{
    /*______Поля класса_______*/
    
    private $id;
    public $material;
    public $description;
    public $relations = [];

    /*______Конструктор класса_____*/
    
    public function __construct($id = NULL)
    {
        if ($id !== NULL)
        {
            $this->id = $id;
            $this->get_wall();
        }
    }

    /*______Перегрузка класса_____*/
    
    public function __set($name, $value)
    {
        if (mb_substr($name, 0, 9, 'utf-8') === 'relation_')
        {
            $field = mb_substr($name, 9, NULL, 'utf-8');
            $this->relations[$field] = $value;
        }
    }

    public function __get($name)
    {
        if ($name === 'id') return $this->id;
        if (mb_substr($name, 0, 9, 'utf-8') === 'relation_')
        {
            $field = mb_substr($name, 9, NULL, 'utf-8');
            if (isset($this->relations[$field]))
            {
                return $this->relations[$field];
            }
        }
        return NULL;
    }

    /*______Методы класса_____*/

    public function load($array = [])
    {
        foreach ($array as $item => $value)
        {
            $this->$item = $value;
        }
    }
    
    public function is_loaded()
    {
        return ($this->id !== NULL);
    }
    
    public static function get_all()
    {
        global $link;
        $query = "
SELECT `wall`.*, COUNT(`realty`.`realty_id`) AS `relation_count` 
FROM `wall` 
LEFT JOIN `realty` 
ON `realty`.`wall_id` = `wall`.`id` 
GROUP BY `wall`.`id`";
        $data_result = mysqli_query($link, $query);
        $walls = [];
        while ($row = mysqli_fetch_assoc($data_result)) {
            $wall = new Wall();
            $wall->load($row);
            $walls[] = $wall;
        }
        return $walls;
    }

    public function get_wall()
    {
        global $link;
        $query = "
SELECT `wall`.*, COUNT(`realty`.`realty_id`) AS `relation_count` 
FROM `wall` 
LEFT JOIN `realty` 
ON `realty`.`wall_id` = `wall`.`id` 
WHERE `wall`.`id` = '$this->id'";
        $data_result = mysqli_query($link, $query);
        if ($row = mysqli_fetch_assoc($data_result))
        {
            $this->load($row);
            return true;
        }
        else
        {
            $this->id = NULL;
            return false;
        }
    }

    public function update()
    {
        global $link;
        $query = "UPDATE `wall` 
SET `material` = '$this->material', `description` = '$this->description' 
WHERE `wall`.`id` = '$this->id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    public function add()
    {
        global $link;
        $query = <<<SQL
INSERT INTO `wall` (`id`, `material`, `description`) VALUES (NULL, '$this->material', '$this->description');
SQL;
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    public function delete()
    {
        global $link;
        $query = "DELETE FROM `wall` WHERE `id` = '$this->id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result)
        {
            $this->id = NULL;
            return true;
        }
        else return false;
    }
}