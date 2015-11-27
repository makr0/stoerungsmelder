<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoerungType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maschine')
            ->add('stStart')
            ->add('behoben')
            ->add('stEnd')
            //->add('bemerkungen')
            //->add('massnahmen')
            ->add('art','choice',array('choices'=>
                array('S'=>'Störung','A'=>'Ausfall')
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stoerung'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_stoerung';
    }
}
