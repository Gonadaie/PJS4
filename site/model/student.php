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
	private $id_student;


	public function __construct($surname, $description=NULL, $adj1=NULL, $adj2=NULL, $adj3=NULL, $year=NULL, $email=NULL, $pic=NULL) {
		$this->surname = $surname;
		if(!$description == NULL) $this->description = $description;
		if(!$adj1 == NULL)	$this->adj1 = $adj1;
		if(!$adj2 == NULL)	$this->adj2 = $adj2;
		if(!$adj3 == NULL)	$this->adj3 = $adj3;
		if(!$year == NULL) 	$this->year = $year;
		if(!$email == NULL) $this->email = $email;
		if(!$pic == NULL) 	$this->pic = $pic;
	}

	public function setScore($score) {
		$this->score = $score;
	}

	public function setId($id){
		$this->$id_student = $id;
	}

	public function getSurname() {
		return $this->surname;
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
