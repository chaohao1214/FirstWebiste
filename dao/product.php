<?php
	class Product{		

		private $id;
		private $name;
		private $desc;
		private $price;
		//private quantity;
		//private category;
		private $img;
		//private review;
				
		function __construct($id, $name, $desc, $price,$img){
			$this->setId($id);
			$this->setName($name);
			$this->setDesc($desc);
			$this->setPrice($price);
			//$this->setQuantity($quantity);
			//$this->setCategory($category);
			$this->setImg($img);
			//$this->setReview($review);
			}		
		
		public function getName(){
			return $this->name;
		}
		
		public function setName($name){
			$this->name = $name;
		}
		
		public function getDesc(){
			return $this->desc;
		}
		
		public function setDesc($desc){
			$this->desc = $desc;
		}

		public function getPrice(){
			return $this->price;
		}

		public function setPrice($price){
			$this->price = $price;
		}
		
		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}
		public function getImg(){
			return $this->img;
		}

		public function setImg($img){
			$this->img = $img;
		}
		
		/*
		public function getQuantity(){
			return $this->quantity;
		}

		public function setQuantity($quantity){
			$this->quantity = $quantity;
		}
		
		public function getCategory(){
			return $this->category;
		}

		public function setCategory($category){
			$this->category = $category;
		}
		
		public function getImg(){
			return $this->img;
		}

		public function setImg($img){
			$this->img = $img;
		}
		
		public function getReview(){
			return $this->review;
		}

		public function setReview($review){
			$this->review = $review;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}
		*/

	}
?>