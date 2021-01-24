<?php
namespace App\Form\Type;

use App\Dto\ListItemDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class ListItemType extends AbstractType
{
    /**
     * Makes form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
		$builder->add('id', IntegerType::class, [
			'constraints' => [
				new PositiveOrZero()
			]
		]);

		$builder->add('parent_id', IntegerType::class, [
			'constraints' => [
				new NotBlank(),
				new PositiveOrZero()
			]
		]);

        $builder->add('text', TextType::class, [
            'constraints' => [
                new NotBlank()
            ]
        ]);

		$builder->add('checked', CheckboxType::class, [
			'constraints' => [
				new NotNull()
			]
		]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListItemDto::class
        ]);
    }

}