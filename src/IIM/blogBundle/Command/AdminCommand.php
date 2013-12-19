<?php
/**
 * Created by PhpStorm.
 * User: anouchka
 * Date: 18/12/13
 * Time: 12:15
 */

namespace IIM\blogBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AdminCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('user:grant_admin')
            ->setDescription('Give ROLE_ADMIN to an User')
            ->addArgument('id', InputArgument::REQUIRED, 'the id')
            ->addOption('role', null, InputOption::VALUE_OPTIONAL, 'Role', 'ROLE_ADMIN')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $role = $input->getOption('role');
        //TODO recuperer le user grace au manager puis ajouter un role au user ($role)

        $container = $this->getContainer();
        $user = $container->get('fos_user.user_manager')->findUserBy(['id'=>$id]);
        $user->addRole($role) ;
        $container->get('fos_user.user_manager')->updateUser($user);


        $output->writeln("User $id has been granted");
    }


} 