<?php
namespace App\Test\Unit\Src\MovementControl;

use App\Movement\MovementControl;
use App\Test\Unit\TestCase;
use App\Vehicle\Rover;

class MovementControlTest extends TestCase
{
    public function testInstantiation()
    {
        $movementControl = new MovementControl();

        $this->assertInstanceOf(MovementControl::class, $movementControl);
    }

    public function testRunInstructionsOnRover()
    {
        $instructions = 'MMMLLRMMRM';
        $roverMock = $this->getRoverMock();
        $roverMock->shouldReceive('moveForward')->times(6);
        $roverMock->shouldReceive('turnLeft')->times(2);
        $roverMock->shouldReceive('turnRight')->times(2);

        $movementControl = new MovementControl();
        $movementControl->runInstructions($roverMock, $instructions);
    }

    /**
     * @return \Mockery\MockInterface|Rover
     */
    private function getRoverMock()
    {
        return \Mockery::mock(Rover::class);
    }
}
