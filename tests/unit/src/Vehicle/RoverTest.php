<?php
namespace App\Test\Unit\Vehicle;

use App\Test\Unit\TestCase;
use App\Vehicle\Rover;

class RoverTest extends TestCase
{
    public function testRoverInstantiation()
    {
        $x = rand(0, 100);
        $y = rand(0, 100);
        $orientation = Rover::ORIENTATION_N;

        $rover = new Rover($x, $y, $orientation);

        $this->assertInstanceOf(Rover::class, $rover);
        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals($orientation, $rover->getPosition()[2]);
    }

    public function testRoverMoveForward()
    {
        $x = 1;
        $y = 1;
        $orientation = Rover::ORIENTATION_N;

        $rover = new Rover($x, $y, $orientation);
        $rover->moveForward();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals(2, $rover->getPosition()[1]);
        $this->assertEquals($orientation, $rover->getPosition()[2]);
    }

    public function testRoverTurnLeftWhenNorth()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_N;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnLeft();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_W, $rover->getPosition()[2]);
    }

    public function testRoverTurnLeftWhenEast()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_E;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnLeft();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_N, $rover->getPosition()[2]);
    }

    public function testRoverTurnLeftWhenWest()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_W;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnLeft();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_S, $rover->getPosition()[2]);
    }

    public function testRoverTurnLeftWhenSouth()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_S;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnLeft();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_E, $rover->getPosition()[2]);
    }

    public function testRoverTurnRightWhenNorth()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_N;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnRight();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_E, $rover->getPosition()[2]);
    }

    public function testRoverTurnRightWhenEast()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_E;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnRight();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_S, $rover->getPosition()[2]);
    }

    public function testRoverTurnRightWhenWest()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_W;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnRight();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_N, $rover->getPosition()[2]);
    }

    public function testRoverTurnRightWhenSouth()
    {
        $x = 62;
        $y = 11512;
        $orientation = Rover::ORIENTATION_S;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnRight();

        $this->assertEquals($x, $rover->getPosition()[0]);
        $this->assertEquals($y, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_W, $rover->getPosition()[2]);
    }

    public function testRoverAdvancedMovementTest1()
    {
        $x = 10;
        $y = 10;
        $orientation = Rover::ORIENTATION_N;

        $rover = new Rover($x, $y, $orientation);
        $rover->turnLeft();
        $rover->moveForward(); // West, X - (9)
        $rover->turnLeft(); // South
        $rover->moveForward(); // South, Y - (9)
        $rover->turnLeft();  // East
        $rover->moveForward(); // East, X + (10)
        $rover->moveForward(); // East, X + (11)
        $rover->moveForward(); // East, X + (12)
        $rover->turnRight(); // North
        $rover->turnRight(); // West

        $this->assertEquals(12, $rover->getPosition()[0]);
        $this->assertEquals(9, $rover->getPosition()[1]);
        $this->assertEquals(Rover::ORIENTATION_W, $rover->getPosition()[2]);
    }
}
