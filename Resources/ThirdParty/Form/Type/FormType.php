<?php
namespace {{ bundle_namespace }}\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class {{ entity }}FormType extends AbstractType
{ 
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
{% for field in fields %}
{% if field.type == 'string' %}
            ->add('{{ field.fieldName }}', 'text', array(
                'attr' => array(
                    'title' => 'Enter the {{ field.fieldName }} for the {{ entity_cc }}'  
                )
            ))          
{% elseif field.type == 'text' %}
            ->add('{{ field.fieldName }}', 'textarea', array(
                'attr' => array(
                    'title' => 'Enter the {{ field.fieldName }} for the {{ entity_cc }}'  
                )
            ))          
{% elseif field.type == 'datetime' %}
            ->add('{{ field.fieldName }}', 'date', array(
                'attr' => array(
                    'class' => 'date',
                    'title' => 'Select a date for the {{ entity_cc }}'
                ),
                'widget' => 'single_text',
                'input' => 'string',
                'format' => 'dd/MM/yy', //\IntlDateFormatter::FULL
            ))
{% elseif field.type == 'manyToOne' %}
            ->add('{{ field.fieldName }}', 'entity', array(
                'class' =>'{{ field.targetEntity }}',
                'attr' => array(
                    'title' => 'Choose a {{ field.fieldName }} for the {{ entity_cc }}'  
                )
            ))  
{% elseif field.type == 'oneToMany' %}
            ->add('{{ field.fieldName }}s', 'collection', array(
                'type' => new \{{ bundle_namespace }}\Form\Type\{{ field.fieldName|ucFirst }}FormType(),
                'allow_add' => true,
                'allow_delete' => true,
            ))
{% elseif field.type == 'manyToMany' %}
            ->add('{{ field.fieldName }}s', 'collection', array(
                'type' => new \{{ bundle_namespace }}\Form\Type\{{ field.fieldName|ucFirst }}FormType(),
                'allow_add' => true,
                'allow_delete' => true,
            ))
{% elseif field.type == 'boolean' %}  
            ->add('{{ field.fieldName }}', 'checkbox', array(
            ))   
{% else %}
            ->add('{{ field.fieldName }}', '{{ field.type }}', array(
            ))            
{% endif %}
{% endfor %}

        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => '{{ bundle_vendor }}\{{ bundle_basename }}\Entity\{{ entity }}');
    }    
    
    public function getName()
    {
        return '{{ bundle_alias }}_{{ entity_us }}';
    }
}