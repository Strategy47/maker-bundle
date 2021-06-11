<?php

/*
 * This file is part of the Symfony MakerBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mamizo\Bundle\GeneratorBundle\Maker;

use Mamizo\Bundle\GeneratorBundle\ConsoleStyle;
use Mamizo\Bundle\GeneratorBundle\DependencyBuilder;
use Mamizo\Bundle\GeneratorBundle\Generator;
use Mamizo\Bundle\GeneratorBundle\InputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @author Imad ZAIRIG <imadzairig@gmail.com>
 *
 * @internal
 */
final class MakeMessengerMiddleware extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:messenger-middleware';
    }

    public static function getCommandDescription(): string
    {
        return 'Creates a new messenger middleware';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of the middleware class (e.g. <fg=yellow>CustomMiddleware</>)')
            ->setHelp(file_get_contents(__DIR__.'/../Resources/help/MakeMessage.txt'));
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $middlewareClassNameDetails = $generator->createClassNameDetails(
            $input->getArgument('name'),
            'Middleware\\',
            'Middleware'
        );

        $generator->generateClass(
            $middlewareClassNameDetails->getFullName(),
            'middleware/Middleware.tpl.php'
        );

        $generator->writeChanges();

        $this->writeSuccessMessage($io);

        $io->text([
            'Next:',
            sprintf('- Open the <info>%s</info> class and add the code you need', $middlewareClassNameDetails->getFullName()),
            '- Add the middleware to your <info>config/packages/messenger.yaml</info> file',
            'Find the documentation at <fg=yellow>https://symfony.com/doc/current/messenger.html#middleware</>',
        ]);
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
        $dependencies->addClassDependency(
            MessageBusInterface::class,
            'messenger'
        );
    }
}
