<?php

declare(strict_types = 1);

namespace App;

class Wall
{
	public function __construct(public int $lenght)
    {
    }

	public array $listOfPieces;

    public function getListOfMaxNumberPieceOnWall(array $pieces): void
    {
        $this->listOfPieces = array_map(function ($piece) {
            return $this->getListMaxNumberPieceOnWall($piece, $this->lenght);
        }, $pieces);
    }

	private function getListMaxNumberPieceOnWall($piece, $lenght)
    {
        return [
			'wall lenght free' => $lenght - ($this->maxNumberPieceOnWall($piece) * $piece),
            $piece => $this->maxNumberPieceOnWall($piece),
        ];
    }

	public function maxNumberPieceOnWall(int $piece): int
    {
        return (int) ($this->lenght / $piece);
    }


    public function getListOfMaxNumberAndCombinationPieceOnWall(array $pieces): void
    {
        foreach($pieces as $piece){
			$this->makeCombination($pieces, $piece);
        }
    }

	private function makeCombination(array $pieces, int $piece): void
	{
		$parameters['maxNumberPiece'] = $this->maxNumberPieceOnWall($piece);
		$parameters['numberPiece'] = 1;
		$parameters['wallLenghtFree'] = $this->lenght - $piece;

		while($parameters['numberPiece'] <= $parameters['maxNumberPiece']) {
			$this->searchCombination($pieces, $piece, $parameters);

			$parameters['numberPiece'] ++;
		}
	}

	private function searchCombination(array $pieces, int $piece, array $parameters): void
	{
		foreach($pieces as $pieceCombinaison) {
			$parameters['wallLenghtFree'] = $this->lenght - ($piece * $parameters['numberPiece']);
			$parameters['maxNumberPieceCombinaison'] = $this->maxNumberPieceOnWall($pieceCombinaison);
			$parameters['numberPieceCombinaison'] = 1;

			if($piece !== $pieceCombinaison) {
				$this->addCombination($piece, $pieceCombinaison, $parameters);
			}
		}
	}

	private function addCombination(int $piece,int $pieceCombinaison, array $parameters): void
	{
		while($parameters['numberPieceCombinaison'] <= $parameters['maxNumberPieceCombinaison']) {
			$parameters['wallLenghtFree'] -= $pieceCombinaison;

			if($this->canAddCombinationAtResult($piece, $pieceCombinaison, $parameters['wallLenghtFree'])) {
				$parameters['resultCombinaison'] = [
					$piece => $parameters['numberPiece'],
					$pieceCombinaison => $parameters['numberPieceCombinaison'],
					'wall lenght free' => $parameters['wallLenghtFree'],
				];

				$this->verifyCombination($parameters);
			}

			$parameters['numberPieceCombinaison'] ++;
		}
	}

	private function canAddCombinationAtResult(int $piece, int $pieceCombinaison, int $wallLenghtFree): bool
	{
		if($wallLenghtFree === 0) {
			return true;
		} elseif($wallLenghtFree < $piece && $wallLenghtFree < $pieceCombinaison && $wallLenghtFree > 0) {
			return true;
		}
		return false;
	}

	private function verifyCombination(array $parameters): void
	{
		ksort($parameters['resultCombinaison']);

		if(!array_search($parameters['resultCombinaison'], $this->listOfPieces)){
			$this->listOfPieces[] = $parameters['resultCombinaison'];
		}
	}

	public array $listOfPiecesWhoFillExactlyTheWall;

	public function getListOfCombinationPieceWhoFillExactlyTheWall(): void
	{
		foreach($this->listOfPieces as $pieceCombinaison){
			if($pieceCombinaison['wall lenght free'] === 0){
				$this->listOfPiecesWhoFillExactlyTheWall[] = $pieceCombinaison;
			}
		}
	}

	public function getListOfPriceCombinationPieceOnWall(array $listOfPrice): void
	{
		foreach($this->listOfPiecesWhoFillExactlyTheWall as $key => $pieceCombinaison){
			$totalPrice = $this->sumOfPiecePrice($pieceCombinaison, $listOfPrice);

			$this->listOfPiecesWhoFillExactlyTheWall[$key]['price'] = $totalPrice;
		}
	}

	private function sumOfPiecePrice(array $pieceCombinaison, array $listOfPrice): int
	{
		$totalPrice = 0;

		foreach($pieceCombinaison as $piece => $numberOfPiece){
			if(is_string($piece)){
				continue;
			}
			$totalPrice += $numberOfPiece * $listOfPrice[$piece];
		}

		return $totalPrice;
	}

	public function getTheCheapestPrice(): array
	{
		$comparator = 9999;
		$cheapest = [];

		foreach($this->listOfPiecesWhoFillExactlyTheWall as $listOfPieces){
			if($listOfPieces['price'] < $comparator){
				$cheapest = $listOfPieces;
			}
		}


		return $cheapest;
	}
}
