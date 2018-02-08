<?php
namespace App\Test\Unit\Src\Land;

use App\Land\Plateau;
use App\Test\Unit\TestCase;
use Nature\Plant;

class PlateauTest extends TestCase
{
    public function testPlateauInstantiation()
    {
        $x = 124;
        $y = 512;

        $plateau = new Plateau($x, $y);

        $this->assertEquals($x, $plateau->getX());
        $this->assertEquals($y, $plateau->getY());
    }
}
