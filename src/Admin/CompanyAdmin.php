<?php

namespace App\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use function Doctrine\ORM\QueryBuilder;

class CompanyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $isEditAction = $this->isCurrentRoute('edit');

        $form->add('name')
            ->add('url')
            ->add('phone');

            $form->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'disabled' => $isEditAction,
                'query_builder' => function(EntityRepository $entityRepository) use ($isEditAction) {
                    $qb = $entityRepository->createQueryBuilder('u');
                    if ($isEditAction) {
                        return $qb->where($qb->expr()->eq('u.id', $this->getSubject()->getUser()->getId()));
                    } else {
                        return $qb->where($qb->expr()->isNull('u.company'));
                    }
                }
            ]);


            $form->add('isActive');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add('id')
            ->add('name')
            ->add('url')
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
        $show->add('name')
            ->add('url')
            ->add('address')
            ->add('phone')
            ->add('createdAt');
    }


}