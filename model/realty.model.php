<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:31
 */
class Realty
{
    /*______Поля класса_______*/

    private $realty_id;
    public $rooms;
    public $floor;
    public $adress;
    public $wall_id;
    public $area;
    public $price;
    public $description;
    public $relations=[];

    /*______Конструктор класса_____*/
    
    public function __construct($id = NULL)
    {
        if ($id !== NULL)
        {
            $this->realty_id = $id;
            $this->get_realty();
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
        if ($name === 'realty_id') return $this->realty_id;
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

    public function is_loaded()
    {
        return ($this->realty_id !== NULL);
    }

    public function load($array = [])
    {
        foreach ($array as $item => $value)
        {
            $this->$item = $value;
        }
    }

    public static function get_all_realty()
    {
        global $link;
        $query = "
SELECT `realty`.*, `wall`.`material` AS `relation_wall_material`, `wall`.`id` AS `relation_wall_id` 
FROM `realty` LEFT JOIN `wall` ON `realty`.`wall_id`=`wall`.`id`
ORDER BY `realty`.`realty_id` ASC ";
        $data_result = mysqli_query($link, $query);
        $realty=[];
        while($row = mysqli_fetch_assoc($data_result))
        {
            $realty_one = new Realty();
            $realty_one->load($row);
            $realty[] = $realty_one;
        }
        return $realty;
    }

    public function add()
    {
        global $link;
        $query = <<<SQL
INSERT INTO `realty` (`realty_id`, `area`, `rooms`, `floor`, `adress`, `price`, `description`, `wall_id`) VALUES (NULL, '$this->area', '$this->rooms', '$this->floor', '$this->adress', '$this->price', '$this->description', '$this->wall_id');
SQL;
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }


    public function get_realty()
    {
        global $link;
        $query = "SELECT `realty`.*, `wall`.`material` AS `relation_wall_material` FROM `realty` LEFT JOIN `wall` ON `realty`.`wall_id`=`wall`.`id`  WHERE `realty_id` = '$this->realty_id'";
        $data_result = mysqli_query($link, $query);
        if ($row = mysqli_fetch_assoc($data_result))
        {
            $this->load($row);
            return true;
        }
        else
        {
            $this->realty_id = NULL;
            return false;
        }
    }


    public function update()
    {
        global $link;
        $query = <<<SQL
    UPDATE `realty` 
    SET 
    `area` = '$this->area', 
    `rooms` = '$this->rooms', 
    `floor` = '$this->floor', 
    `adress` = '$this->adress', 
    `price` = '$this->price', 
    `description` = '$this->description', 
    `wall_id` = '$this->wall_id' 
    WHERE `realty`.`realty_id` = '$this->realty_id'
SQL;
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }


    public function delete()
    {
        global $link;
        $query = "DELETE FROM `realty_tags` WHERE `realty_tags`.`realty_id` = '$this->realty_id'";
        mysqli_query($link, $query);
        $query = "DELETE FROM `realty` WHERE `realty_id` = '$this->realty_id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result)
        {
            $this->realty_id = NULL;
            return true;
        }
        else return false;
    }

    public static function load_wall_group($wall_id)
    {
        global $link;
        $query = "
SELECT `realty`.*, `wall`.`material` AS `relation_wall_material`, `wall`.`id` AS `relation_wall_id` 
FROM `realty` LEFT JOIN `wall` ON `realty`.`wall_id`=`wall`.`id`  
WHERE `wall_id` = '$wall_id' 
ORDER BY `realty`.`realty_id` ASC";
        $data_result = mysqli_query($link, $query);
        $realty=[];
        while($row = mysqli_fetch_assoc($data_result))
        {
            $realty_one = new Realty();
            $realty_one->load($row);
            $realty[] = $realty_one;
        }
        return $realty;
    }

    public static function load_tag_group($tag_id)
    {
        global $link;
        $query = "
SELECT `realty`.*,  `realty_tags`.`tag_id`, `tags`.`title` , `wall`.`material` AS `relation_wall_material` FROM `realty` 
JOIN `realty_tags` ON `realty`.`realty_id` = `realty_tags`.`realty_id`  
JOIN `tags` ON `realty_tags`.`tag_id` = `tags`.`tag_id`  
JOIN `wall` ON `realty`.`wall_id`=`wall`.`id` 
WHERE `realty_tags`.`tag_id` = '$tag_id'";
        $data_result = mysqli_query($link, $query);
        $realty=[];
        while($row = mysqli_fetch_assoc($data_result))
        {
            $realty_one = new Realty();
            $realty_one->load($row);
            $realty[] = $realty_one;
        }
        return $realty;
    }

    public function realty_add_tag()
    {
        global $link;
        $query = "INSERT INTO `realty_tags` (`id`, `realty_id`, `tag_id`) VALUES (NULL, '$this->realty_id', '$this->relation_tag_id')";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
//        if ($data_result) 
//        {
//            $id = mysqli_insert_id($link);
//            return $id;
//        } 
//        else 
//        {
//            return false;
//        }
    }

    public function realty_delete_tag()
    {
        global $link;
        $query = "DELETE FROM `realty_tags` WHERE `id` = '$this->relation_id' LIMIT 1";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }
}