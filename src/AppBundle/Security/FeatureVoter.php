<?php
namespace AppBundle\Security;

use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class FeatureVoter extends Voter
{
    private $decisionManager;
    private $featuresACL;

    public function __construct(FeatureAccess $featureAccess, AccessDecisionManagerInterface $decisionManager)
    {
        // den decisionManager brauchen wir um dem Admin vollzugriff zu geben
        $this->decisionManager   = $decisionManager;
        $this->featuresACL       = $featureAccess->getACL();
        $this->supported_features= $featureAccess->getFeatures();
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

        // ist für eine der Rollen des Users ein feature konfiguriert?
        foreach ($token->getRoles() as $role) {
            $rolename = $role->getRole();
            if( isset($this->featuresACL[$rolename])) {
                if( in_array($attribute, $this->featuresACL[$rolename]) ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function features_for_user($user) {
        $token = new UsernamePasswordToken($user->getUsername(), null, 'main', $user->getRoles());
        $token->setUser($user);

        $ret=array();
        foreach ($this->supported_features as $attribute) {
            $ret[$attribute] = $this->voteOnAttribute($attribute,null,$token);
        }
        return $ret;
    }

}
