<?php
namespace App\Http\Providers;

class BaseProvider implements Provider{
	protected $page;
	protected $source;
	protected $canProvide;
	protected $limit;
	protected $count;
	protected $offset;
	protected $data;
	protected $addationalOffset;
	protected $identifySource;
	protected $whereElements;
	protected $selectParams;
	protected $selectKeys;

	function __construct($page,$source,$data = null,$limit = 10){
		$this->whereElements = [];
		$this->selectParams = [];
		$this->selectKeys = [];
		$this->identifySource = false;
		$this->source = $source;
		$this->setAddationalOffset(0);
		$this->setPage($page);
		$this->setLimit($limit);
		$this->setOffset(0);
		$this->setData($data);
		$this->setCanProvide(true);		
		$this->adjustCounters();
	}

	private function adjustCounters(){
		if($this->data != null){
			$crumbs = count($this->data) % $this->limit;
			$chunks = $crumbs > 0 ? intval((count($this->data) / $this->limit)) + 1:intval(count($this->data) / $this->limit);

			$this->take($this->limit);
			if($this->page > $chunks || $this->page < 1){
				$this->setOffset(count($this->data));
				$this->take(0);
				$this->setCanProvide(false);
			}else{
				$this->setOffset(($this->page - 1) * $this->limit);
				if($this->page == $chunks && $crumbs > 0){
					$this->take($crumbs);
				}
			}
		}
	}

	private function filterData(){
		$condition = "";
		$newData = [];
		foreach ($this->whereElements as $query) {
			if($condition != ""){
				$condition .= " && ";
			}
			if(is_numeric($query[2])){
				$condition .= '$element["'.$query[0].'"]'." ".$query[1]." ".$query[2];
			}else{
				$condition .= '$element["'.$query[0].'"]'." ".$query[1]." '".$query[2]."'";
			}
		}

		$condition .= ";";

		//echo $condition;
		//exit;

		foreach ($this->data as $element) {
			$result = eval("return ".$condition);

			if($result){
				array_push($newData, $element);
			}
		}

		$this->setData($newData);
	}

	public function where($query){
		array_push($this->whereElements, $query);
		$this->filterData();
		$this->adjustCounters();
	}

	public function select($params){
		$this->selectParams = $params;
		foreach ($params as $param) {
			array_push($this->selectKeys, $param['key']);
		}
	}

	public function whereDateBetween($query){
		$dateFrom = str_replace("-", "", $query[2]);
		$dateTo = str_replace("-", "", $query[3]);
		array_push($this->whereElements,[$query[0],'<=',$dateFrom]);
		array_push($this->whereElements,[$query[1],'>=',$dateTo]);
		$this->filterData();
		$this->adjustCounters();
	}

	public function size(){
		return count($this->data);
	}

	public function canProvide(){
		return $this->canProvide;
	}

	public function setCanProvide($canProvide){
		$this->canProvide = $canProvide;
	}

	public function limit(){
		return $this->limit;
	}

	public function setLimit($limit){
		$this->limit = $limit;
	}

	public function count(){
		return $this->count;
	}

	public function take($count){
		if($this->offset + $this->addationalOffset + $count - 1 > count($this->data)){
			$this->count = count($this->data) - $this->offset - $this->addationalOffset;
		}else if($count < 0){
			$this->count(0);
		}else{
			$this->count = $count;
		}
	}

	public function offset(){
		return $this->offset;
	}

	public function setOffset($offset){
		$this->offset = $offset;
	}

	public function setData($data){
		$this->data = $data;
	}

	public function data(){
		return $this->data;
	}

	public function setPage($page){
		$this->page = $page;
	}

	public function page(){
		return $this->page;
	}

	private function transform($value,$func){
		if($func == "starrize"){
			$stars = "";
			for($i=0;$i<intval($value);$i++){
				$stars .= "*";
			}

			return $stars;
		}else if($func == "listToString"){
			return implode(",", $value);
		}
	}

	public function fetch(){
		$response = $this->identifySource?
		array_map(
			function($element){
				$element['provider'] = $this->source;
				return $element;
			},array_slice($this->data,$this->offset+$this->addationalOffset,$this->count)
		):array_slice($this->data,$this->offset+$this->addationalOffset,$this->count);

		if(count($this->selectParams) > 0){
			$items = [];
			foreach ($response as $element) {
				$item = array();
				array_walk($element,function($value,$key) use(&$item){
					if(in_array($key, $this->selectKeys)){
						$param = $this->selectParams[array_search($key,$this->selectKeys,true)];

						$newValue = $value;
						if(isset($param['transform'])){
							$newValue = $this->transform($value,$param['transform']);
						}

						if(isset($param['alias'])){
							$item[$param['alias']] = $newValue;
						}else{
							$item[$param['key']] = $newValue;
						}
					}
				});
				array_push($items, $item);
			}

			return $items;
		}else{
			return $response;
		}
	}

	public function setAddationalOffset($addationalOffset){
		$this->addationalOffset = $addationalOffset;
	}

	public function addationalOffset(){
		return $this->addationalOffset;
	}

	public function identifySource(){
		$this->identifySource = true;
	}
}