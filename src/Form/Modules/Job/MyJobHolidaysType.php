<?php

namespace App\Form\Modules\Job;

use App\Controller\Utils\Application;
use App\Entity\Modules\Job\MyJobHolidays;
use App\Entity\Modules\Job\MyJobHolidaysPool;
use App\Services\Translator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyJobHolidaysType extends AbstractType
{
    
    /**
     * @var Application
     */
    private $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $this->app->translator = new Translator();

        $builder
            ->add('year', ChoiceType::class, [
                'choices'       => $options['choices'],
                'choice_label'  => function ($options) {
                    return $options;
                },
                'attr' => [
                    'required'      => 'required',
                ],
                'label' => $this->app->translator->translate('forms.MyJobHolidaysType.labels.year'),
            ])
            ->add('daysSpent',IntegerType::class , [
                'attr' => [
                    'min'           => 1,
                    'placeholder'   => $this->app->translator->translate('forms.MyJobHolidaysType.placeholders.daysSpent')
                ],
                'label' => $this->app->translator->translate('forms.MyJobHolidaysType.labels.daysSpent'),
            ])
            ->add('information', TextType::class, [
                'attr' => [
                    'placeholder' => $this->app->translator->translate('forms.MyJobHolidaysType.placeholders.information')
                ],
                'label' => $this->app->translator->translate('forms.MyJobHolidaysType.labels.information'),
            ])
            ->add('submit', SubmitType::class, [
                'label' => $this->app->translator->translate('forms.general.submit'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyJobHolidays::class,
        ]);

        $resolver->setRequired('choices');
    }
}
