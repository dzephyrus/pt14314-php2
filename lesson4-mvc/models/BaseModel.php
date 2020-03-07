<?php
namespace Models;
use PDO;
use Exception;
class BaseModel{
    function __construct()
    {
        $host = "127.0.0.1";
        $dbname = 'pt14314-web';
        $dbusername = 'root';
        $dbpass = "";
        $this->connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
                                        $dbusername, $dbpass);
    }

    public function fill($dataArr){
        foreach ($this->fillable as $col) {
            $this->{$col} = $dataArr[$col];
        }
    }

    public static function getAll(){
        $model = new static();
        $sql = "select * from " . $model->table;
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $data;
    }

    public static function findOne($id){
        $model = new static();
        $sql = "select * from " . $model->table . " where id = $id";
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        if(!$data){
            return false;
        }
        return $data[0];
    }

    public static function destroy($id){

        try{
            $model = new static();
            $sql = "delete from " . $model->table . " where id = $id";
            $stmt = $model->connect->prepare($sql);
            $stmt->execute();
            return true;
        }catch (Exception $ex){
            var_dump($ex->getMessage());
            return false;
        }
    }

    public static function customQuery($sql){
        $model = new static();
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $data;
    }
}
?>