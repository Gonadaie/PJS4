<?php

class Student {
	private $surname;
	private $description;
	private $adj1;
	private $adj2;
	private $adj3;
	private $year;
	private $email;
	private $pic;
	private $score;
	private $id;
	private $password;
	private $validate_account;

	public function __construct($surname, $description=NULL, $year=NULL, $email=NULL, $pic=NULL) {
		$this->surname = $surname;
		if(!$description == NULL) $this->description = $description;
		if(!$year == NULL) 	$this->year = $year;
		if(!$email == NULL) $this->email = $email;
		if(!$pic == NULL) 	$this->pic = $pic;
	}

	public function getAdj1() {
		return $this->adj1;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function getValidateAccount() {
		return $this->validate_account;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getAdjectives() {
		return array($this->adj1, $this->adj2, $this->adj3);
	}

	public function getStringAdjectives() {
		return $this->adj1." - ".$this->adj2." - ".$this->adj3;
	}

	public function getYear(){
		return $this->year;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPic(){
		return $this->pic;
	}

	public function getScore(){
		return $this->score;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}

	public function setScore($score){
		$this->score = $score;
	}

	public function setPassword($password){
		$this->password = $password;
	}
	public function setValidateAccount($validate_account){
		$this->validate_account = $validate_account;
	}

	public function setAdjectiveOne($adj1){
		$this->adj1 = $adj1;
	}

	public function setAdjectives($adj1, $adj2, $adj3){
		$this->adj1 = $adj1;
		$this->adj2 = $adj2;
		$this->adj3 = $adj3;
	}

	public function setDescription($description) {
		this->description = $description;
	}

	public function setPic($pic) {
		this->pic = $pic;
	}

	public function to_array(){
		$return = array(
			'surname' => $this->surname,
			'description' => $this->description,
			'adj1' => $this->adj1,
			'adj2' => $this->adj2,
			'adj3' => $this->adj3,
			'year' => $this->year,
			'email' => $this->email,
			'pic' => $this->pic
		);
		return $return;
	}


}
