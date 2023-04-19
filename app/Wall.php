<?php

declare(strict_types = 1);

namespace App;

class Wall
{
	public function __construct(public int $lenght)
    {
    }

    public function maxNumberPieceOnWall(int $piece): int
    {
        return (int) ($this->lenght / $piece);
    }

	private function calculateMaxNumberPieceOnWall($piece, $lenght)
    {
        return [
            $piece => $this->maxNumberPieceOnWall($piece),
            'wall lenght rest' => $lenght - ($this->maxNumberPieceOnWall($piece) * $piece),
        ];
    }

    public function getListOfMaxNumberPieceOnWall(array $pieces): array
    {
        $result = [];

        $result = array_map(function ($piece) {
            return $this->calculateMaxNumberPieceOnWall($piece, $this->lenght);
        }, $pieces);

        return $result;
    }

    // public function getListOfMaxNumberAndCombinationPieceOnWall(array $pieces): array
    // {
    //     $result = [];

    //     return $result;
    // }

	public function getListCombinationPieceOnWall(array $pieces): array
    {
        $result = [];

		foreach($pieces as $piece){
			
		}

        return $result;
    }
}
