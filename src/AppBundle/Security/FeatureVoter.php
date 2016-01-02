<?php
namespace AppBundle\Security;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\HttpKernel\Config\FileLocator;

class FeatureVoter extends Voter
{
    // ...

    private $decisionManager;
    private $featureaccess;

    public function __construct(FileLocator $fileLocator, AccessDecisionManagerInterface $decisionManager)
    {
        // den decisionManager brauchen wir um dem Admin vollzugriff zu geben
        $this->decisionManager = $decisionManager;

        // in diesem configfile steht welche Usergruppe zugriff auf welche features hat.
        $configfile = $fileLocator->locate('@AppBundle/Resources/featureaccess.yml');
        $yaml = new Parser();
        $this->featureaccess = $yaml->parse(file_get_contents($configfile) );
        // welche Features existieren in dem configfile?
        $this->supported_features = array();
        foreach ($this->featureaccess as $role => $features) {
            $this->supported_features = array_merge($this->supported_features,$features);
        }
        $this->supported_features = array_unique($this->supported_features);
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, $this->supported_features);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // User muss eingeloggt sein
        // wenn nicht -> deny access
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        // ROLE_ADMIN darf alles!
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }


        dump($attribute);
        dump($this->featureaccess);

        // ist für eine der Rollen des Users ein feature konfiguriert?
        foreach ($token->getRoles() as $role) {
            $rolename = $role->getRole();
            if( isset($this->featureaccess[$rolename])) {
                if( in_array($attribute, $this->featureaccess[$rolename]) ) {
                    return true;
                }
            }
        }

        return false;

    }
}
