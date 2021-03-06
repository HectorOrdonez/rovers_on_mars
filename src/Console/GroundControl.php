<?php
namespace App\Console;

use App\Console\Exception\InputException;
use App\Land\Plateau;
use App\Movement\MovementControl;
use App\Vehicle\Rover;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GroundControl extends Command
{
    const ARG_DIMENSIONS = 'dimensions';
    const ARG_SPIRIT_SP = 'spirit starting point';
    const ARG_SPIRIT_INS = 'spirit instructions';
    const ARG_OPPORTUNITY_SP = 'opportunity starting point';
    const ARG_OPPORTUNITY_INST = 'opportunity instructions';

    const ERROR_ARG_DIMENSIONS = 'Dimensions [%s] are not valid';
    const ERROR_ARG_ROVER = 'Rover starting point [%s] are not valid';

    /**
     * Configure this command
     */
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Give instructions to the rovers')
            ->setHelp('This command gives instructions to Spirit and Opportunity')
            ->addArgument(self::ARG_DIMENSIONS, InputArgument::REQUIRED,
                'The X Y coordinates of the end of this rectangular plateau')
            ->addArgument(self::ARG_SPIRIT_SP, InputArgument::REQUIRED,
                'The X Y coordinates and orientation of Spirit, the rover 1')
            ->addArgument(self::ARG_SPIRIT_INS, InputArgument::REQUIRED,
                'The instructions to give to Spirit, the rover 1')
            ->addArgument(self::ARG_OPPORTUNITY_SP, InputArgument::REQUIRED,
                'The X Y coordinates and orientation of Opportunity, the rover 2')
            ->addArgument(self::ARG_OPPORTUNITY_INST, InputArgument::REQUIRED,
                'The instructions to give to Opportunity, the rover 2');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return bool
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dimensions = $input->getArgument(self::ARG_DIMENSIONS);
        $spiritSp = $input->getArgument(self::ARG_SPIRIT_SP);
        $spiritInstructions = $input->getArgument(self::ARG_SPIRIT_INS);
        $opportunitySp = $input->getArgument(self::ARG_OPPORTUNITY_SP);
        $opportunityInstructions = $input->getArgument(self::ARG_OPPORTUNITY_INST);

        try {
            $plateauDimensions = $this->parseDimensions($dimensions);
            $spiritSp = $this->parseRoverSp($spiritSp);
            $spiritInstructions = $this->validateInstructions($spiritInstructions);
            $opportunitySp = $this->parseRoverSp($opportunitySp);
            $opportunityInstructions = $this->validateInstructions($opportunityInstructions);
        } catch (InputException $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");

            return true;
        }

        $plateau = new Plateau($dimensions[0], $dimensions[1]);
        $movementControl = new MovementControl();
        $spirit = new Rover($spiritSp[0], $spiritSp[1], $spiritSp[2], $plateau);
        $opportunity = new Rover($opportunitySp[0], $opportunitySp[1], $opportunitySp[2], $plateau);

        $movementControl->runInstructions($spirit, $spiritInstructions);
        $movementControl->runInstructions($opportunity, $opportunityInstructions);

        $output->writeln(implode(' ', $spirit->getPosition()));
        $output->writeln(implode(' ', $opportunity->getPosition()));

        return true;
    }

    /**
     * Throws exception if this are not valid dimensions
     * @param $dimensions
     * @return bool
     * @throws InputException
     */
    private function parseDimensions($dimensions)
    {
        $dimensions = explode(' ', $dimensions);
        $x = (int) $dimensions[0];
        $y = (int) $dimensions[1];

        if (
            $x < 0 ||
            $y < 0
        ) {
            throw new InputException(sprintf(self::ERROR_ARG_DIMENSIONS, implode(' ', $dimensions)));
        }

        return [$x, $y];
    }

    /**
     * @todo
     */
    private function parseRoverSp($roverSp)
    {
        $startingPos = explode(' ', $roverSp);
        $x = (int) $startingPos[0];
        $y = (int) $startingPos[1];
        $orientation = strtolower($startingPos[2]);

        if (
            $x < 0 ||
            $y < 0
        ) {
            throw new InputException(sprintf(self::ERROR_ARG_ROVER, $roverSp));
        }

        return [$x, $y, $orientation];
    }

    /**
     * @todo
     */
    private function validateInstructions($instructions)
    {
        return $instructions;
    }
}
