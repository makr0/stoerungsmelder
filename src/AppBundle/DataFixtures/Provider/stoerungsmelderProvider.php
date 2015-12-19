<?php
namespace AppBundle\DataFixtures\Provider;
use Faker\Provider\Base as BaseProvider;

class stoerungsmelderProvider extends BaseProvider
{
    private $abteilungen = [
        'Schleiferei',
        'Ausbildung',
        'Dreherei',
        'Fräserei',
        'Materiallager',
        'Entgraterei'
    ];
    public function abteilungsname()
    {
        return self::randomElement($this->abteilungen);
    }
}