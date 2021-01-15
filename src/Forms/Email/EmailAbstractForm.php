<?php

namespace Akkurate\LaravelContact\Forms\Email;

use Akkurate\LaravelAdmin\Models\Account;
use App\Models\User;
use Kris\LaravelFormBuilder\Form;

class EmailAbstractForm extends Form
{
    public function buildForm()
    {
        $accounts = Account::all();
        $accountsSelect = $accounts->pluck('name', 'id')->toArray();

        $users = User::all();
        $usersSelect = $users->pluck('lastname', 'id')->toArray();

        $this
            ->add('model', 'choice', [
                'selected' => [
                    'account'
                ],
                'label' => __('Modèle concerné'),
                'choices' => [
                    'account' => 'account',
                    'user' => 'user'
                ],
                'expanded' => true,
                'multiple' => false,
                'choice_options' => [
                    'wrapper' => [
                        'class' => 'custom-control custom-radio'
                    ],
                    'attr' => [
                        'class' => 'custom-control-input'
                    ],
                    'label_attr' => [
                        'class' => 'custom-control-label'
                    ]
                ],
            ])
            ->add('type', 'choice', [
                'label' => __('Type'),
                'choices' => ['HOME' => __('Personnel'), 'WORK' => __('Professionel')],
                'expanded' => true,
                'multiple' => false,
                'choice_options' => [
                    'wrapper' => ['class' => 'custom-control custom-radio'],
                    'attr' => ['class' => 'custom-control-input'],
                    'label_attr' => ['class' => 'custom-control-label']
                ],
            ])
            ->add('account', 'select', ['label' => __('Compte'), 'choices' => $accountsSelect])
            ->add('user', 'select', ['wrapper' => ['class' => 'form-group d-none'], 'label' => __('Utilisateur'), 'choices' => $usersSelect])
            ->add('name', 'text', ['label' => __('Nom')])
            ->add('email', 'text', ['label' => __('Email').' *', 'rules' => 'required'])
            ->add('is_active', 'choice', ['selected' => [true], 'label' => __('Est-elle active ?'), 'choices' => [true => __('Oui'), false => __('Non')], 'expanded' => true, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
            ->add('is_default', 'choice', ['selected' => [true], 'label' => __('Est-elle active ?'), 'choices' => [true => __('Oui'), false => __('Non')], 'expanded' => true, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
        ;
    }
}
