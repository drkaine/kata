<?php

declare(strict_types = 1);

namespace tests;

use App\Wall;
use PHPUnit\Framework\TestCase;

class WallTest extends TestCase
{
	private $wall;

	protected function setUp(): void
	{
		$this->wall = new Wall(250);
		$this->wall->getListOfMaxNumberPieceOnWall([50, 75]);
	}

	public function testWallLenght(): void
	{
		$this->assertSame(250, $this->wall->lenght);
	}

	public function testMaxNumberOf50PieceOnTheWall(): void
	{
		$this->assertSame(5, $this->wall->maxNumberPieceOnWall(50));
	}

	public function testListOfMaxNumberPieceOnTheWall(): void
	{
		$expectedListOfMaxNumberPiece = [
			[
				'wall lenght free' => 0,
				50 => 5,
			],
			[
				'wall lenght free' => 25,
				75 => 3,
			],
		];

		$this->assertSame($expectedListOfMaxNumberPiece, $this->wall->listOfPieces);
	}

	public function testListOfMaxNumberPieceAndCombinationPieceOnWall(): void
	{
		$expectedListOfMaxNumberAndCombinationPiece = [
			[
				'wall lenght free' => 0,
				50 => 5,
			],
			[
				'wall lenght free' => 25,
				75 => 3,
			],
			[
				'wall lenght free' => 0,
				50 => 2,
				75 => 2,
			],
			[
				'wall lenght free' => 25,
				50 => 3,
				75 => 1,
			],
		];

		$this->wall->getListOfMaxNumberAndCombinationPieceOnWall([50, 75]);
		$this->assertSame($expectedListOfMaxNumberAndCombinationPiece, $this->wall->listOfPieces);
	}

	public function testListOfCombinationPieceWhoFillExactlyTheWall(): void
	{
		$expectedListOfPieceWhoFillExactlyTheWall = [
			[
				'wall lenght free' => 0,
				50 => 5,
			],
			[
				'wall lenght free' => 0,
				50 => 2,
				75 => 2,
			],
		];

		$this->wall->getListOfMaxNumberAndCombinationPieceOnWall([50, 75]);
		$this->wall->getListOfCombinationPieceWhoFillExactlyTheWall();
		$this->assertSame($expectedListOfPieceWhoFillExactlyTheWall, $this->wall->listOfPiecesWhoFillExactlyTheWall);
	}

	public function testListOfPriceCombinationPieceOnWall(): void
	{
		$expectedListOfPieceWhoFillExactlyTheWall = [
			[
				'wall lenght free' => 0,
				50 => 5,
				'price' => 295,
			],
			[
				'wall lenght free' => 0,
				50 => 2,
				75 => 2,
				'price' => 242,
			],
		];

		$this->wall->getListOfMaxNumberAndCombinationPieceOnWall([50, 75]);
		$this->wall->getListOfCombinationPieceWhoFillExactlyTheWall();
		$this->wall->getListOfPriceCombinationPieceOnWall([50 => 59, 75 => 62]);
		$this->assertSame($expectedListOfPieceWhoFillExactlyTheWall, $this->wall->listOfPiecesWhoFillExactlyTheWall);
	}

	public function testListOTheCheapestfPrice(): void
	{
		$expectedCheapestPrice = [
				'wall lenght free' => 0,
				50 => 2,
				75 => 2,
				'price' => 242,
		];

		$this->wall->getListOfMaxNumberAndCombinationPieceOnWall([50, 75]);
		$this->wall->getListOfCombinationPieceWhoFillExactlyTheWall();
		$this->wall->getListOfPriceCombinationPieceOnWall([50 => 59, 75 => 62]);
		$this->assertSame($expectedCheapestPrice, $this->wall->getTheCheapestPrice());
	}
}
