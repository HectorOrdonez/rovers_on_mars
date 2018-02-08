<?php
namespace App\Console;

use App\Console\Exception\InputException;
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
            $this->validateDimensions($dimensions);
        } catch (InputException $e)
        {
            $output->writeln("<error>{$e->getMessage()}</error>");

            return true;
        }

        $output->writeln("Output here");


        return true;
    }

    /**
     * Throws exception if this are not valid dimensions
     * @param $dimensions
     * @throws InputException
     */
    private function validateDimensions($dimensions)
    {
        if (!is_array($dimensions)) {
            throw new InputException(sprintf(self::ERROR_ARG_DIMENSIONS, $dimensions));
        }
    }
}
