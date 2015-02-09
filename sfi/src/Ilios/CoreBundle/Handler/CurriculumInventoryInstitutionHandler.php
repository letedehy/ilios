<?php

namespace Ilios\CoreBundle\Handler;

use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManager;

use Ilios\CoreBundle\Exception\InvalidFormException;
use Ilios\CoreBundle\Form\CurriculumInventoryInstitutionType;
use Ilios\CoreBundle\Entity\Manager\CurriculumInventoryInstitutionManager;
use Ilios\CoreBundle\Entity\CurriculumInventoryInstitutionInterface;

class CurriculumInventoryInstitutionHandler extends CurriculumInventoryInstitutionManager
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @param EntityManager $em
     * @param string $class
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManager $em, $class, FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
        parent::__construct($em, $class);
    }

    /**
     * @param array $parameters
     *
     * @return CurriculumInventoryInstitutionInterface
     */
    public function post(array $parameters)
    {
        $curriculumInventoryInstitution = $this->createCurriculumInventoryInstitution();

        return $this->processForm($curriculumInventoryInstitution, $parameters, 'POST');
    }

    /**
     * @param CurriculumInventoryInstitutionInterface $curriculumInventoryInstitution
     * @param array $parameters
     *
     * @return CurriculumInventoryInstitutionInterface
     */
    public function put(
        CurriculumInventoryInstitutionInterface $curriculumInventoryInstitution,
        array $parameters
    ) {
        return $this->processForm(
            $curriculumInventoryInstitution,
            $parameters,
            'PUT'
        );
    }
    /**
     * @param CurriculumInventoryInstitutionInterface $curriculumInventoryInstitution
     * @param array $parameters
     *
     * @return CurriculumInventoryInstitutionInterface
     */
    public function patch(
        CurriculumInventoryInstitutionInterface $curriculumInventoryInstitution,
        array $parameters
    ) {
        return $this->processForm(
            $curriculumInventoryInstitution,
            $parameters,
            'PATCH'
        );
    }

    /**
     * @param CurriculumInventoryInstitutionInterface $curriculumInventoryInstitution
     * @param array $parameters
     * @param string $method
     * @throws InvalidFormException when invalid form data is passed in.
     *
     * @return CurriculumInventoryInstitutionInterface
     */
    protected function processForm(
        CurriculumInventoryInstitutionInterface $curriculumInventoryInstitution,
        array $parameters,
        $method = "PUT"
    ) {
        $form = $this->formFactory->create(
            new CurriculumInventoryInstitutionType(),
            $curriculumInventoryInstitution,
            array('method' => $method)
        );
        $form->submit($parameters, 'PATCH' !== $method);

        if ($form->isValid()) {
            $curriculumInventoryInstitution = $form->getData();
            $this->updateCurriculumInventoryInstitution($curriculumInventoryInstitution, true);

            return $curriculumInventoryInstitution;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }
}
