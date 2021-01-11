<?php

namespace Akkurate\LaravelContact\Forms\Phone;

use App\Models\User;
use Akkurate\LaravelAdmin\Models\Account;
use Kris\LaravelFormBuilder\Form;

class PhoneAbstractForm extends Form
{
    public function buildForm()
    {

		$accounts = Account::all();
		$accountsSelect = $accounts->pluck('name', 'id')->toArray();

		$users = User::all();
		$usersSelect = $users->pluck('lastname', 'id')->toArray();

        $this
			->add('model', 'choice', ['selected' => ['account'], 'label' => 'Select model', 'choices' => ['account' => 'account', 'user' => 'user'], 'expanded' => true, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
			->add('account', 'select', ['label' => __('Compte'), 'choices' => $accountsSelect])
			->add('user', 'select', ['wrapper' => ['class' => 'form-group d-none'], 'label' => __('Utilisateur'), 'choices' => $usersSelect])
			->add('type', 'choice', [
			    'label' => __('Type'),
                'choices' => ['HOME' => __('Personnel'), 'WORK' => __('Professionel'), 'MOBILE' => __('Portable')],
                'expanded' => true,
                'multiple' => false,
                'choice_options' => [
                    'wrapper' => ['class' => 'custom-control custom-radio'],
                    'attr' => ['class' => 'custom-control-input'],
                    'label_attr' => ['class' => 'custom-control-label']
                ],
            ])
            ->add('number', 'text', ['label' => __('Number').' *', 'rules' => 'required'])
            ->add('is_active', 'choice', ['selected' => [true], 'label' => __('Est-elle active ?'), 'choices' => [true => __('Oui'), false => __('Non')], 'expanded' => true, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
            ->add('is_default', 'choice', ['selected' => [true], 'label' => __('Est-elle active ?'), 'choices' => [true => __('Oui'), false => __('Non')], 'expanded' => true, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
        ;
    }
}
