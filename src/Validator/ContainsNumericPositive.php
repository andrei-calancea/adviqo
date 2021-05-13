<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsNumericPositive extends Constraint
{
    public $message = 'The value "{{ value }}" is not a positive number.';
}
