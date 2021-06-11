<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mamizo\Bundle\GeneratorBundle;

use Mamizo\Bundle\GeneratorBundle\DependencyInjection\CompilerPass\MakeCommandRegistrationPass;
use Mamizo\Bundle\GeneratorBundle\DependencyInjection\CompilerPass\RemoveMissingParametersPass;
use Mamizo\Bundle\GeneratorBundle\DependencyInjection\CompilerPass\SetDoctrineAnnotatedPrefixesPass;
use Mamizo\Bundle\GeneratorBundle\DependencyInjection\CompilerPass\SetDoctrineManagerRegistryClassPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Ryan Weaver <weaverryan@gmail.com>
 */
class GeneratorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        // add a priority so we run before the core command pass
        $container->addCompilerPass(new MakeCommandRegistrationPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 10);
        $container->addCompilerPass(new RemoveMissingParametersPass());
        $container->addCompilerPass(new SetDoctrineManagerRegistryClassPass());
        $container->addCompilerPass(new SetDoctrineAnnotatedPrefixesPass());
    }
}
