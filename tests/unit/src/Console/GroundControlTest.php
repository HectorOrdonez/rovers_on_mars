<?php
namespace App\Test\Unit\Src\Console;

use App\Console\GroundControl;
use App\Test\Unit\TestCase;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Tester\CommandTester;

class GroundControlTest extends TestCase
{
    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Not enough arguments (missing: "dimensions, spirit starting point, spirit instructions, opportunity starting point, opportunity instructions")
     */
    public function testCommandRequiresInput()
    {
        $groundControl = new GroundControl();
        $commandTester = new CommandTester($groundControl);

        $response = $commandTester->execute([]);

        $this->assertEquals(0, $response);
    }

    public function testDimensionsHaveToBeAValidString()
    {
        $input = $this->getValidInput();
        $input['dimensions'] = 'some wrong dimensions';

        $groundControl = new GroundControl();
        $commandTester = new CommandTester($groundControl);

        $commandTester->execute($input);
        $response = $commandTester->getDisplay();

        $this->assertContains('Dimensions [some wrong dimensions] are not valid', $response);
    }

    /**
     * Valid instructions for testing
     * @return array
     */
    private function getValidInput()
    {
        return [
            'dimensions' => '',
            'spirit starting point' => '',
            'spirit instructions' => '',
            'opportunity starting point' => '',
            'opportunity instructions' => '',
        ];
    }
}
