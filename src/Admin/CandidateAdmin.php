<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CandidateAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('email')
            ->add('phone')
            ->add('isActive');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add('id')
            ->add('email')
            ->add('phone')
            ->add('_action', 'actions', [
                'actions' => [
                    'edit' => [],
                    'show' => []
                ]
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')
            ->add('email')
            ->add('phone')
            ->add('isActive');
    }
}
