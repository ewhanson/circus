<?php

namespace AppBundle\Command;

use AppBundle\Entity\Clipping;
use AppBundle\Services\Thumbnailer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateThumbnailsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:generate-thumbnails')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $thumbnailer = $this->getContainer()->get(Thumbnailer::class);
        $em = $this->getContainer()->get('doctrine')->getManager();
        $repo = $em->getRepository(Clipping::class);
        foreach($repo->findAll() as $clipping) {
            $output->writeln($clipping->getOriginalName());
            $clipping->setThumbnailPath($thumbnailer->thumbnail($clipping));
            $em->flush();
        }
    }

}
