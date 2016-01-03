<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadTestUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    private $createusers = array(
        array('login'=>'worker',            'password'=>'worker',            'role'=>'ROLE_WORKER'),
        array('login'=>'reparatur',         'password'=>'reparatur',         'role'=>'ROLE_REPARATUR'),
        array('login'=>'teamleiter',        'password'=>'teamleiter',        'role'=>'ROLE_TEAMLEITER'),
        array('login'=>'produktionsleiter', 'password'=>'produktionsleiter', 'role'=>'ROLE_PRODUKTIONSLEITER')
    );

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        foreach ($this->createusers as $userdata) {
            $user = $userManager->createUser();
            $user->setUsername($userdata['login']);
            $user->setPlainPassword($userdata['password']);
            $user->setEmail($userdata['login'].'@example.com');
            $user->setRoles(array($userdata['role']));
            $user->setEnabled(true);
            $userManager->updateUser($user);
        }
    }
}