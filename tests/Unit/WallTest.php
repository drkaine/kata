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
				0 => 'wall lenght free',
				50 => 5,
			],
			[
				25 => 'wall lenght free',
				75 => 3,
			],
		];

		$this->assertSame($expectedListOfMaxNumberPiece, $this->wall->listOfPieces);
	}

	public function testListOfMaxNumberPieceAndCombinationPieceOnWall(): void
	{
		$expectedListOfMaxNumberAndCombinationPiece = [
			[
				0 => 'wall lenght free',
				50 => 5,
			],
			[
				25 => 'wall lenght free',
				75 => 3,
			],
			[
				0 => 'wall lenght free',
				50 => 2,
				75 => 2,
			],
			[
				25 => 'wall lenght free',
				50 => 3,
				75 => 1,
			],
		];

		$this->wall->getListOfMaxNumberAndCombinationPieceOnWall([50, 75]);
		$this->assertSame($expectedListOfMaxNumberAndCombinationPiece, $this->wall->listOfPieces);
	}
}
