<?php
namespace App\Movement;

use App\Vehicle\Rover;

class MovementControl {
    /**
     * @param Rover $rover
     * @param string $instructions
     * @return bool
     */
    public function runInstructions(Rover $rover, $instructions)
    {
        foreach(str_split($instructions) as $instruction)
        {
            $this->applyInstruction($rover, $instruction);
        }

        return true;
    }

    private function applyInstruction(Rover $rover, $instruction)
    {
        switch($instruction)
        {
            case 'M':
                $rover->moveForward();
                break;
            case 'L':
                $rover->turnLeft();
                break;
            case 'R':
                $rover->turnRight();
                break;
        }
    }
}
