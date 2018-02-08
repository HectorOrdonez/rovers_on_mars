<?php
namespace App\Vehicle;

use App\Land\Plateau;
use App\Vehicle\Exception\RoverException;

/**
 * Class Rover
 * @package App\Vehicle
 */
class Rover
{
    const STATE_ON = true;
    const STATE_OFF = false;

    const ERROR_POSITION = 'Incorrect position for rover: %s';
    const ERROR_ORIENTATION = 'Incorrect orientation for rover: %s';

    const ORIENTATION_N = 'n';
    const ORIENTATION_W = 'w';
    const ORIENTATION_S = 's';
    const ORIENTATION_E = 'e';

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var string
     */
    private $orientation;

    /**
     * Is it on or off?
     * @var bool
     */
    private $state;

    /**
     * @var Plateau
     */
    private $plateau;

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     * @return $this
     */
    public function setX($x)
    {
        $this->validatePosition($x);

        $this->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $pos
     * @return bool
     * @throws RoverException
     */
    private function validatePosition($pos)
    {
        if (!is_int($pos) || $pos < 0) {
            throw new RoverException(sprintf(self::ERROR_POSITION, $pos));
        }

        return true;
    }

    private function validateOrientation($orientation)
    {
        $validOrientations = [
            self::ORIENTATION_N,
            self::ORIENTATION_W,
            self::ORIENTATION_S,
            self::ORIENTATION_E,
        ];

        if (!in_array($orientation, $validOrientations)) {
            throw new RoverException(sprintf(self::ERROR_ORIENTATION, $orientation));
        }

        return true;
    }

    public function __construct($x, $y, $orientation, Plateau $plateau)
    {
        $this->validatePosition($x);
        $this->validatePosition($y);
        $this->validateOrientation($orientation);

        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
        $this->state = self::STATE_ON;
        $this->plateau = $plateau;
    }

    /**
     * @return array
     */
    public function getPosition()
    {
        return [
            $this->x,
            $this->y,
            $this->orientation,
        ];
    }

    /**
     * Returns whether the Rover is on or off
     *
     * @return bool
     */
    public function isOn()
    {
        return $this->state;
    }

    /**
     * Rover, GO FORWARD!
     * @todo Validate where is rover going
     */
    public function moveForward()
    {
        if (!$this->isOn()) {
            return false;
        }

        switch ($this->orientation) {
            case self::ORIENTATION_N:
                return $this->moveNorth();
                break;
            case self::ORIENTATION_W:
                return $this->moveWest();
                break;
            case self::ORIENTATION_S:
                return $this->moveSouth();
                break;
            case self::ORIENTATION_E:
                return $this->moveEast();
                break;
        }

        return true;
    }

    private function moveNorth()
    {
        if($this->plateau->getY() < $this->y + 1)
        {
            $this->state = self::STATE_OFF;
            return false;
        }

        $this->y++;
        return true;
    }

    private function moveSouth()
    {
        if($this->y - 1 < 0)
        {
            $this->state = self::STATE_OFF;
            return false;
        }

        $this->y--;
        return true;
    }

    private function moveWest()
    {
        if($this->x - 1 < 0)
        {
            $this->state = self::STATE_OFF;
            return false;
        }

        $this->x--;
        return true;
    }

    private function moveEast()
    {
        if($this->plateau->getX() < $this->x + 1)
        {
            $this->state = self::STATE_OFF;
            return false;
        }

        $this->x++;
        return true;
    }


    /**
     * Rover, TURN LEFT!
     *
     * @todo If Rover has reached limits of Plateau or touched Rover 1 (when applicable), do nothing
     */
    public function turnLeft()
    {
        if (!$this->isOn()) {
            return false;
        }
        switch ($this->orientation) {
            case self::ORIENTATION_N:
                $this->orientation = self::ORIENTATION_W;
                break;
            case self::ORIENTATION_W:
                $this->orientation = self::ORIENTATION_S;
                break;
            case self::ORIENTATION_S:
                $this->orientation = self::ORIENTATION_E;
                break;
            case self::ORIENTATION_E:
                $this->orientation = self::ORIENTATION_N;
                break;
        }

        return true;
    }

    /**
     * Rover, TURN RIGHT!
     *
     * @todo If Rover has reached limits of Plateau or touched Rover 1 (when applicable), do nothing
     */
    public function turnRight()
    {
        if (!$this->isOn()) {
            return false;
        }
        switch ($this->orientation) {
            case self::ORIENTATION_N:
                $this->orientation = self::ORIENTATION_E;
                break;
            case self::ORIENTATION_W:
                $this->orientation = self::ORIENTATION_N;
                break;
            case self::ORIENTATION_S:
                $this->orientation = self::ORIENTATION_W;
                break;
            case self::ORIENTATION_E:
                $this->orientation = self::ORIENTATION_S;
                break;
        }

        return true;
    }
}
