<?php

namespace Akkurate\LaravelContact\Forms\Address;

use Akkurate\LaravelAdmin\Models\Account;
use App\Models\User;
use Kris\LaravelFormBuilder\Form;

class AddressAbstractForm extends Form
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
            ->add('user', 'select', ['wrapper' => ['class' => 'form-group d-none'], 'label' => __('User'), 'choices' => $usersSelect])
            ->add('type', 'select', ['label' => __('Type'), 'choices' => ['WORK' => __('Professionelle'), 'HOME' => __('Personnelle'), 'BILLING' => __('Facturation'), 'DELIVERY' => __('Livraison')], 'expanded' => false, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
            ->add('name', 'text', ['label' => __('Name')])
            ->add('street1', 'text', ['label' => __('Street1').' *', 'rules' => 'required'])
            ->add('street2', 'text', ['label' => __('Street2')])
            ->add('street3', 'text', ['label' => __('Street3')])
            ->add('postcode', 'text', ['label' => __('postcode').' *', 'rules' => 'required'])
            ->add('city', 'text', ['label' => __('City').' *', 'rules' => 'required'])
            ->add('is_active', 'choice', ['selected' => [true], 'label' => __('Est-elle active ?'), 'choices' => [true => __('Oui'), false => __('Non')], 'expanded' => true, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
            ->add('is_default', 'choice', ['selected' => [true], 'label' => __('Est-elle active ?'), 'choices' => [true => __('Oui'), false => __('Non')], 'expanded' => true, 'multiple' => false, 'choice_options' => ['wrapper' => ['class' => 'custom-control custom-radio'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]])
        ;
    }
}
