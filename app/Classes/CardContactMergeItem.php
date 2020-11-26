<?php
namespace App\Classes;

class CardContactMergeItem
{
	public function __construct(
		string $abbott_code = "",
		string $card_code = "", 
		string $first_name = "",
		string $last_name = "",
		string $phone_number = ""
	)
	{
		$this->abbott_code = $abbott_code;
		$this->card_code = $card_code;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->phone_number = $phone_number;
	}

	public ?string $abbott_code;
	public ?string $card_code;
	public ?string $first_name;
	public ?string $last_name;
	public ?string $phone_number;

	/* public function getAbbottCode(): string */
	/* { */
	/* 	return $this->abbott_code; */
	/* } */

	/* public function setAbbottCode(string $abbott_code): void */
	/* { */
	/* 	$this->abbott_code = $abbott_code; */
	/* } */

	/* public function getCardCode(): string */
	/* { */
	/* 	return $this->card_code; */
	/* } */

	/* public function setCardCode(string $card_code): void */
	/* { */
	/* 	$this->card_code = $card_code; */
	/* } */

	/* public function getFirstName(): string */ 
	/* { */
	/* 	return $this->first_name; */
	/* } */

	/* public function setFirstName(string $first_name): void */
	/* { */
	/* 	$this->first_name = $first_name; */
	/* } */

	/* public function getLastName(): string */ 
	/* { */
	/* 	return $this->last_name; */
	/* } */

	/* public function setLastName(string $last_name): void */ 
	/* { */
	/* 	$this->last_name = $last_name; */
	/* } */

	/* public function getPhoneNumber(): string */
	/* { */
	/* 	return $this->phone_number; */
	/* } */

	/* public function setPhoneNumber(string $phone_number): void */ 
	/* { */
	/* 	$this->phone_number = $phone_number; */
	/* } */
}
?>
