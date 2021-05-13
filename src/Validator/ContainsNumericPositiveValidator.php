<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @Annotation
 */
class ContainsNumericPositiveValidator extends ConstraintValidator
{
    public $message = 'The value "{{ value }}" is not a positive number.';

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ContainsNumericPositive) {
            throw new UnexpectedTypeException($constraint, ContainsNumericPositive::class);
        }

        // ignore null and empty values
        if (null === $value || '' === $value) {
            return;
        }

        if (!preg_match('/^[1-9]*\d(\.\d+)?$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
