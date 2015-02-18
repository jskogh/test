<?php 

class Bank {
	private $name = "min bank jao";
	private $userList = array();
	
	public function createUser() {
		
		$user = new Customer();
		$user->setFirstName("Johanna");
		$user->setLastName("Skog");
		$user->setPnr(910805);
		
		$this->userList[]
	}
	
	
	
	public function getBankName() {
		return $this->name;
	}
	
}