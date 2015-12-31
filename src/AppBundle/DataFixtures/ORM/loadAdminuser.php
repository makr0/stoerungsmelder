<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
	/**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
		$userManager = $this->container->get('fos_user.user_manager');
		$user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->setEmail('admin@example.com');
        $user->setEnabled(true);
		$userManager->updateUser($user);
    }
}