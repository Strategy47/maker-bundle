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

use Mamizo\Bundle\GeneratorBundle\Str;

/**
 * @internal
 */
final class RelationManyToMany extends BaseCollectionRelation
{
    private $isOwning;

    public function isOwning(): bool
    {
        return $this->isOwning;
    }

    public function setIsOwning($isOwning)
    {
        $this->isOwning = $isOwning;

        return $this;
    }

    public function getOrphanRemoval(): bool
    {
        return false;
    }

    public function getTargetSetterMethodName(): string
    {
        return 'add'.Str::asCamelCase(Str::pluralCamelCaseToSingular($this->getTargetPropertyName()));
    }

    public function getTargetRemoverMethodName(): string
    {
        return 'remove'.Str::asCamelCase(Str::pluralCamelCaseToSingular($this->getTargetPropertyName()));
    }
}
