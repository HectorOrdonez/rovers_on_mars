<?php
namespace App\Land;

use App\Console\Exception\PlateauException;

class Plateau
{
    const ERROR_POSITION = 'Incorrect position for plateau: %s';

    /**
     * Plateau constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct($x, $y)
    {
        $this->setX($x);
        $this->setY($y);
    }

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
     * @throws PlateauException
     */
    private function validatePosition($pos)
    {
        if (!is_int($pos) || $pos < 0) {
            throw new PlateauException(sprintf(self::ERROR_POSITION, $pos));
        }

        return true;
    }

    /**
     * @param int $y
     * @return $this
     */
    public function setY($y)
    {
        $this->validatePosition($y);

        $this->y = $y;

        return $this;
    }

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;


}
