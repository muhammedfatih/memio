<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Validator\Constraint;

use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodCannotBeBothAbstractAndStaticSpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Gnugat\Medio\Validator\Constraint');
    }

    function it_is_fine_with_non_static_abstract_methods(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->isStatic()->willReturn(false);

        $this->validate($method)->shouldHaveType('Gnugat\Medio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_abstract_and_static_methods(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->isStatic()->willReturn(true);
        $method->getName()->willReturn('__construct');

        $this->validate($method)->shouldHaveType('Gnugat\Medio\Validator\Violation\SomeViolation');
    }
}
