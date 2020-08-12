<?php
namespace App\Http\Providers;

class OurHotelsProvider{
	private $bestHotelsProvider;
	private $topHotelsProvider;
	private $bestHotelsProviderLimit;
	private $topHotelsProviderLimit;
	private $limit;
	private $canProvide;
	private $page;

	function __construct($page){
		$this->page = $page;
		$this->limit = 10;
		$this->canProvide = false;

		$this->bestHotelsProviderLimit = $this->limit/2;
		$this->topHotelsProviderLimit = $this->limit%2==0?$this->limit/2:($this->limit/2)+1;

		$this->bestHotelsProvider = new BestHotelsProvider($page,$this->bestHotelsProviderLimit);
		$this->topHotelsProvider = new TopHotelsProvider($page,$this->topHotelsProviderLimit);
	}

	function init(){
		$bestHotelsPages = ceil($this->bestHotelsProvider->size() / $this->bestHotelsProviderLimit);
		$topHotelsPages = ceil($this->topHotelsProvider->size() / $this->topHotelsProviderLimit);

		if($topHotelsPages > $bestHotelsPages && $this->page > $bestHotelsPages){
			$borrowedItems = $this->bestHotelsProviderLimit - ($this->bestHotelsProvider->size() % $this->bestHotelsProviderLimit);
			$this->topHotelsProvider->setAddationalOffset($borrowedItems + (($this->page - $bestHotelsPages - 1) * $this->bestHotelsProviderLimit));
		}else if($topHotelsPages < $bestHotelsPages && $this->page > $topHotelsPages){
			$borrowedItems = $this->topHotelsProviderLimit - ($this->topHotelsProvider->size() % $this->topHotelsProviderLimit);
			$this->bestHotelsProvider->setAddationalOffset($borrowedItems + (($this->page - $topHotelsPages - 1) * $this->topHotelsProviderLimit));
		}

		if($this->bestHotelsProvider->count() + $this->topHotelsProvider->count() < $this->limit){
			if($this->bestHotelsProvider->count() < $this->bestHotelsProviderLimit){
				$this->topHotelsProvider->take($this->bestHotelsProviderLimit - $this->bestHotelsProvider->count() + $this->topHotelsProviderLimit);

			}

			else if($this->topHotelsProvider->count() < $this->topHotelsProviderLimit){
				$this->bestHotelsProvider->take($this->topHotelsProviderLimit - $this->topHotelsProvider->count() + $this->bestHotelsProviderLimit);
			}
		}

		if($this->bestHotelsProvider->canProvide() || $this->topHotelsProvider->canProvide()){
			$this->canProvide = true;
		}
	}

	function fetch(){
		$this->init();
		$this->bestHotelsProvider->identifySource();
		$this->topHotelsProvider->identifySource();
		return array_merge($this->bestHotelsProvider->fetch(),$this->topHotelsProvider->fetch());
	}

	function select($params){
		$this->bestHotelsProvider->select($params);
		$this->topHotelsProvider->select($params);
	}

	function where($query){
		$this->bestHotelsProvider->where($query);
		$this->topHotelsProvider->where($query);
	}

	function whereDateBetween($query){
		$this->bestHotelsProvider->whereDateBetween($query);
		$this->topHotelsProvider->whereDateBetween($query);
	}

	function canProvide(){
		return $this->canProvide;
	}

	function count(){
		$this->bestHotelsProvider->count() + $this->topHotelsProvider->count();
	}
}