<?php  

namespace App\Http\Providers;
  
interface Provider { 
   public function canProvide(); 
   public function fetch();
   public function take($count);
   public function count();
   public function setLimit($limit);
   public function offset();
   public function setOffset($offset);
   public function size();
   public function setAddationalOffset($addationalOffset);
   public function addationalOffset();
   public function identifySource();
   public function where($query);
   public function select($params);
}  
  
?> 