<?php

namespace App\Form;

use App\Entity\Quote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('text', TextareaType::class, [
                'required' => true
            ])
            ->add('attribution')
            ->add('subAttribution')
            ->add('dateRecorded', DateType::class)
            ->add('publicDocumentLink')
            ->add('sourceDocumentLink')
            ->add('tags')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        /**
         * @todo Decide: data bind directly to Entity or create new class structure
         * for validation?
         *
         * #1 Data bind directly to Entity
         *  - Allows invalid entities within our domain model
         *  - Forces our Entities to hold validation logic
         *  - Allows us to maintain data integrity & validation in same spot
         *
         * #2 Data bind to alternative structure
         *  - Enforces validity of entities within domain model
         *  - Provides mechanism to hold validation logic for forms not inherently
         *    bound to domain object (e.g., search form)
         *  - Forces us to duplicate data integrity constraints onto alternative
         *    structure in the form of validation constraint
         *
         * #2 may be best bet. Alternative structure could cleanly map to domain
         * objects in appropriate circumstances and be abstracted through a Facade
         *
         * Read here: https://blog.martinhujer.cz/symfony-forms-with-request-objects/
         */

        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }
}
