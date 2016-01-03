<?php
namespace AppBundle\Security;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\HttpKernel\Config\FileLocator;
use AppBundle\Entity\User;

class FeatureAccess
{
    private $supported_features;
    private $ACL;
    public function __construct(FileLocator $fileLocator)
    {
        // in diesem configfile steht welche Usergruppe zugriff auf welche features hat.
        $configfile = $fileLocator->locate('@AppBundle/Resources/featureaccess.yml');
        $yaml = new Parser();
        $this->ACL = $yaml->parse(file_get_contents($configfile) );
        // welche Features existieren in dem configfile?
        $this->supported_features = array();
        foreach ($this->ACL as $role => $features) {
            $this->supported_features = array_merge($this->supported_features,$features);
        }
        $this->supported_features = array_unique($this->supported_features);
    }

    public function getACL()
    {
        return $this->ACL;
    }

    public function getFeatures()
    {
        return $this->supported_features;
    }
    public function getRoles()
    {
        return array_keys($this->ACL);
    }
}
