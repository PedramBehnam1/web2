<?php

namespace App\Command\Hotel;

use App\Entity\Hotel;
use Doctrine\DBAL\Schema\Table;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table as HelperTable;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:hotelOwner:filter',
    description: 'filter hotels by hotel owner',
)]
class HotelOwnerFilterCommand extends Command
{

     /** @var EntityManagerInterface */
     private EntityManagerInterface $entityManager;

     /**
      * @param EntityManagerInterface $entityManager
      * @param string|null $name
      */
     public function __construct(
         EntityManagerInterface $entityManager,
         string $name = null
     ){
        parent::__construct($name);
        $this->entityManager = $entityManager; 
    }
    protected function configure(): void
    {
      
       $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
      /** @var Hotel hotel[] */
      $hotels = $this->entityManager->getRepository(Hotel::class)
       ->findAll(); 


      $hotelName = array();
      $hotelOwner = array();
      /** @var Hotel hotel */
        foreach ($hotels as $hotel) {
            
            if ($hotel->getHotelOwner() != null) {  
             array_push($hotelName, $hotel->getName());
            
            array_push($hotelOwner, $hotel->getHotelOwner());
            
            
            }
        }
       
        $io->table(["Hotel name", "Hotel owner"],[[
        implode("\n",$hotelName),
        implode("\n",$hotelOwner),
         ]]);
    

        return Command::SUCCESS;
    }
}
