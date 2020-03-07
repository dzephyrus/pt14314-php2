<?php
namespace Models;

class Product extends BaseModel{
    public $table = 'products';
    protected $fillable = ['name', 'price', 'views',
                            'short_desc', 'star', 'detail'];
    public function insert(){
        try{
            $insertQuery = "insert into $this->table 
                          (name, price, views,
                            short_desc, star, detail, image)
                        values 
                             ('$this->name', '$this->price', '$this->views',
                            '$this->short_desc', '$this->star', '$this->detail', '$this->image')";
            $stmt = $this->connect->prepare($insertQuery);
            $stmt->execute();
            return true;
        }catch (Exception $ex){
            var_dump($ex->getMessage());
            return false;
        }
    }
    public function update(){
        try{
            $updateQuery = "update $this->table 
                            set 
                                name = '$this->name', 
                                price = '$this->price', 
                                views = '$this->views',
                                
                                short_desc = '$this->short_desc', 
                                star = '$this->star', 
                                detail = '$this->detail', 
                                image = '$this->image'
                            where id = $this->id";
//            dd($updateQuery);
            $stmt = $this->connect->prepare($updateQuery);
            $stmt->execute();
            return true;
        }catch (Exception $ex){
            var_dump($ex->getMessage());
            return false;
        }
    }
}


?>