<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mamizo\Bundle\GeneratorBundle\Doctrine;

/**
 * @internal
 */
abstract class BaseSingleRelation extends BaseRelation
{
    private $isNullable;

    public function isNullable(): bool
    {
        if ($this->isNullable) {
            return $this->isNullable;
        }

        return false;
    }

    public function setIsNullable($isNullable)
    {
        $this->isNullable = $isNullable;

        return $this;
    }
}
