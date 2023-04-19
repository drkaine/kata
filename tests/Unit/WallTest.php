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
				50 => 5,
				'wall lenght rest' => 0,
			],
			[
				75 => 3,
				'wall lenght rest' => 25,
			],
		];

		$this->assertSame($expectedListOfMaxNumberPiece, $this->wall->getListOfMaxNumberPieceOnWall([50, 75]));
	}

	public function testListOfCombinationPieceOnWall(): void
	{
		$expectedListOfCombinationPiece = [
			[
				75 => 2,
				50 => 2,
				'wall lenght rest' => 0,
			],
			[
				75 => 1,
				50 => 3,
				'wall lenght rest' => 25,
			],
		];

		$this->assertSame($expectedListOfCombinationPiece, $this->wall->getListOfCombinationPieceOnWall([50, 75]));
	}

	// public function testListOfMaxNumberPieceAndCombinationPieceOnWall(): void
	// {
	// 	$expectedListOfMaxNumberAndCombinationPiece = [
	// 		[
	// 			50 => 5,
	// 			'wall lenght rest' => 0,
	// 		],
	// 		[
	// 			75 => 3,
	// 			'wall lenght rest' => 25,
	// 		],
	// 		[
	// 			75 => 2,
	// 			50 => 2,
	// 			'wall lenght rest' => 0,
	// 		],
	// 		[
	// 			75 => 1,
	// 			50 => 3,
	// 			'wall lenght rest' => 25,
	// 		],
	// 	];

	// 	$this->assertSame($expectedListOfMaxNumberAndCombinationPiece, $this->wall->getListOfMaxNumberAndCombinationPieceOnWall([50, 75]));
	// }
}
