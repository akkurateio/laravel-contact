<?php

namespace Akkurate\LaravelContact\Forms\Type;

use Kris\LaravelFormBuilder\Form;

class TypeAbstractForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('code', 'text', ['label' => __('Code') . ' *', 'attr' => ['required']])
            ->add('name', 'text', ['label' => __('Nom') . ' *', 'attr' => ['required']])
            ->add('description', 'textarea', ['label' => __('Description') . ' *', 'attr' => ['required']])
            ->add('priority', 'number', ['label' => __('Priorité') . ' *', 'attr' => ['required', 'min' => 0]])
            ->add('is_active', 'checkbox', ['label' => __('Actif'), 'wrapper' => ['class' => 'form-group custom-control custom-checkbox'], 'attr' => ['class' => 'custom-control-input'], 'label_attr' => ['class' => 'custom-control-label']]);
    }
}
