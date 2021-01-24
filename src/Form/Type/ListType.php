<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Dto\Request\ListRequestDto;

class ListType extends AbstractType
{
    /**
     * Makes form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title', TextType::class, [
			'required' => true,
            'constraints' => [
				new NotBlank()
            ]
        ]);

        $builder->add('color', TextType::class, [
            'constraints' => [
				new NotBlank()
            ]
        ]);

		$builder->add('items', CollectionType::class, [
			'entry_type' => ListItemType::class,
			'allow_add' => true
		]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListRequestDto::class
        ]);
    }

}