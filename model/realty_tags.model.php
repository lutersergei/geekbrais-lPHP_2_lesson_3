<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 30.06.2016
 * Time: 13:30
 */
class RealtyTags
{
    /*______Поля класса_______*/

    private $tag_id;
    public $title;

    /*______Конструктор класса_____*/

    public function __construct($tag_id = NULL)
    {
        if ($tag_id !== NULL)
        {
            $this->tag_id = $tag_id;
            $this->get_tag();
        }
    }

    /*______Перегрузка класса_____*/
    
    public function __get($name)
    {
        if ($name === 'tag_id') return $this->tag_id;
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
        return ($this->tag_id !== NULL);
    }

    public static function get_all()
    {
        global $link;
        $query = "SELECT * FROM `tags`";
        $data_result = mysqli_query($link, $query);
        $tags = [];
        while ($row = mysqli_fetch_assoc($data_result)) 
        {
            $tag = new RealtyTags();
            $tag->load($row);
            $tags[] = $tag;
        }
        return $tags;
    }

    public function get_tag()
    {
        global $link;
        $query = "SELECT * FROM `tags` WHERE `tag_id` = '$this->tag_id'";
        $data_result = mysqli_query($link, $query);
        $tags = array();
        if ($row = mysqli_fetch_assoc($data_result)) 
        {
            $this->load($row);
            return $tags;
        } 
        else 
        {
            $this->tag_id = NULL;
            return false;
        }
    }

    public function update()
    {
        global $link;
        $query = "UPDATE `tags` SET `title` = '$this->title' WHERE `tags`.`tag_id` = '$this->tag_id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    public function add()
    {
        global $link;
        $query = <<<SQL
INSERT INTO `tags` (`tag_id`, `title`) VALUES (NULL, '$this->title')
SQL;
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    public function delete()
    {
        global $link;
        $query = "DELETE FROM `tags` WHERE `tags`.`tag_id` = '$this->tag_id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    public static function get_realtion_tag($realty_id)
    {
        global $link;
        $query = "SELECT `realty_tags`.`id` AS `relation_id`, `tags`.* FROM `realty_tags` JOIN `tags` ON `tags`.`tag_id`= `realty_tags`.`tag_id` WHERE `realty_tags`.`realty_id` = '$realty_id'";
        $data_result = mysqli_query($link, $query);
        $tags = array();
        while ($row = mysqli_fetch_assoc($data_result))
        {
            $tag = new RealtyTags();
            $tag->load($row);
            $tags[] = $tag;
        }
        return $tags;
    }
}