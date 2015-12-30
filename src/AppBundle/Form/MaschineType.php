<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MaschineType extends AbstractType
{
    private $zeige_abteilung = true;

    public function __construct( $options = array() ) {
        if( array_key_exists('zeige_abteilung', $options) ) {
            $this->zeige_abteilung = $options[ 'zeige_abteilung' ];
        }
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($this->zeige_abteilung) {
            $builder->add('abteilung');
        }
        $builder
            ->add('name')
            ->add('seriennummer')
            ->add('bild', 'vich_image', array(
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Maschine'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_maschine';
    }
}
