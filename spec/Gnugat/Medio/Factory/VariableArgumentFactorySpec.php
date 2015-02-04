<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Factory;

use Gnugat\Medio\Factory\VariableTypeFactory;
use PhpSpec\ObjectBehavior;

class VariableArgumentFactorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new VariableTypeFactory());
    }

    function it_makes_object_from_variable()
    {
        $variable = new \ArrayObject();

        $argument = $this->make($variable);
        $argument->getName()->shouldBe('arrayObject');
        $argument->isObject()->shouldBe(true);
        $argument->getType()->shouldBe('\\ArrayObject');
    }

    function it_makes_callable_from_variable()
    {
        $variable = function () {};

        $argument = $this->make($variable);
        $argument->getName()->shouldBe('argument');
        $argument->isObject()->shouldBe(false);
        $argument->getType()->shouldBe('callable');
    }

    function it_makes_non_object_from_variable_using_gettype()
    {
        $variable = 'Nobody expects the Spanish Inquisition!';

        $argument = $this->make($variable);
        $argument->getName()->shouldBe('argument');
        $argument->isObject()->shouldBe(false);
        $argument->getType()->shouldBe('string');
    }
}