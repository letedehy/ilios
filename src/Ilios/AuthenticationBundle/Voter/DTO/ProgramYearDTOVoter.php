<?php

namespace Ilios\AuthenticationBundle\Voter\DTO;

use Ilios\CoreBundle\Entity\DTO\ProgramYearDTO;
use Ilios\AuthenticationBundle\Voter\AbstractVoter;
use Ilios\CoreBundle\Entity\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class ProgramYearDTOVoter
 * @package Ilios\AuthenticationBundle\Voter\DTO
 */
class ProgramYearDTOVoter extends AbstractVoter
{
    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        return $subject instanceof ProgramYearDTO && in_array($attribute, array(self::VIEW));
    }

    /**
     * @param string $attribute
     * @param ProgramYearDTO $programYear
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $programYear, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return true;
                break;
        }
        return false;
    }
}
