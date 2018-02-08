<?php
namespace App\Vehicle;

use App\Vehicle\Exception\RoverException;

/**
 * Class Rover
 * @package App\Vehicle
 */
class Rover {
    const ERROR_POSITION = 'Incorrect position for rover: %s';
    const ERROR_ORIENTATION = 'Incorrect orientation for rover: %s';

    const ORIENTATION_N = 'n';
    const ORIENTATION_W = 'w';
    const ORIENTATION_S = 's';
    const ORIENTATION_E = 'e';

    private $x;
    private $y;
    private $orientation;


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

        if(!in_array($orientation, $validOrientations))
        {
            throw new RoverException(sprintf(self::ERROR_ORIENTATION, $orientation));
        }

        return true;
    }

    public function __construct($x, $y, $orientation)
    {
        $this->validatePosition($x);
        $this->validatePosition($y);
        $this->validateOrientation($orientation);

        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
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
     * Rover, GO FORWARD!
     * @todo Validate where is rover going
     */
    public function moveForward()
    {
        switch($this->orientation)
        {
            case self::ORIENTATION_N:
                $this->y++;
                break;
            case self::ORIENTATION_W:
                $this->x--;
                break;
            case self::ORIENTATION_S:
                $this->y--;
                break;
            case self::ORIENTATION_E:
                $this->x++;
                break;
        }

        return true;
    }

    /**
     * Rover, TURN LEFT!
     *
     * @todo If Rover has reached limits of Plateau or touched Rover 1 (when applicable), do nothing
     */
    public function turnLeft()
    {
        switch($this->orientation)
        {
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
        switch($this->orientation)
        {
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
