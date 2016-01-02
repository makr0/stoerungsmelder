<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;


/**
* @Route("/admin")
*/
class AdminController extends Controller
{
    /**
     * Startseite der Nuterverwaltung
     *  - liste der Nutzer
     *  - Buttons für bearbeiten/neu
     * @Route("/index", name="admin_index")
     * @Template()
     */
    public function indexAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return array(
            'users' => $users
        );
    }

    /**
     * Edit-Form für Benutzer
     *  - Rolle ändern
     *  - passwort ändern
     *  - Nutzer löschen
     * @Route("/editUser/{id}", name="admin_user_edit")
     * @Template()
     */
    public function editUserAction(Request $request, $id)
    {
        $roles=$this->container->get('app.feature_access')->getRoles();
        $userManager = $this->container->get('fos_user.user_manager');

        $user =  $userManager->findUserBy(array('id'=>$id));

        $form = $this->createForm(new UserType(array('roles'=>$roles)), $user);
        $form->add('enabled',null,array('label'=>'aktiv'));
        $form->add('submit', 'submit', array('label' => 'Speichern'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $userManager->updateUser($user);
        }

        return array(
                'form' => $form->createView(),
                'user' => $user,
                'resultingfeatures' => $this->container->get('app.feature_voter')
                                       ->features_for_user($user)
            );
    }

    /**
     * Nutzer hinzufügen
     *  - Felder wie bei edit
     *
     * @Route("/addUser", name="admin_user_add")
     * @Template()
     */
    public function addUserAction(Request $request)
    {
        $roles=$this->container->get('app.feature_access')->getRoles();
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();

        $form = $this->createForm(new UserType(array('roles'=>$roles)), $user);
        $form->add('submit', 'submit', array('label' => 'Anlegen'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user);
            return $this->redirect('admin_user_edit',array('id'=>$user->getId()));
        }

        return array(
                'form' => $form->createView(),
            );
    }

}
