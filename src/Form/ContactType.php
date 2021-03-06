<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'label.contact-name',
            ])
            ->add('phone', null, [
                'label' => 'label.contact-phone',
            ])
            ->add('person', null, [
                'label' => 'label.contact-person',
            ])
            ->add('adress', null, [
                'label' => 'label.contact-adress',
            ])
            ->add('contactInfo', null, [
                'attr' => ['rows' => 10],
                'help' => 'help.post_content',
                'label' => 'label.contact-contactInfo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
