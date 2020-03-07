<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;
class Product extends Model{
   
    public $table = 'products';

    protected $fillable = ['name', 'price', 'views',
                            'short_desc', 'star', 'detail'];
    protected $attributes = [
        'image' => "public/images/default-image.jpg",
    ];

    public function getCategoryName(){
        $cate = Category::find($this->cate_id);
        if($cate){
            return $cate->cate_name;
        }


        return null;
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