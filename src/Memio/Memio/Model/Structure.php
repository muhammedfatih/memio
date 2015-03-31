<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Model;

use Memio\Memio\Model\Phpdoc\StructurePhpdoc;

/**
 * An abstract type which defines behavior using methods.
 *
 * @api
 */
interface Structure
{
    /**
     * @return string
     */
    public function getFullyQualifiedName();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getNamespace();

    /**
     * @return StructurePhpdoc
     */
    public function getPhpdoc();

    /**
     * @param StructurePhpdoc $structurePhpdoc
     *
     * @return Structure
     *
     * @api
     */
    public function setPhpdoc(StructurePhpdoc $structurePhpdoc);
}