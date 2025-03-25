<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

/**
 * Class HelpCommand.
 */
final class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected string $name = 'start';

    /**
     * @var array Command Aliases
     */
    protected array $aliases = ['startbot'];

    /**
     * @var string Command Description
     */
    protected string $description = 'Старт бота';

    /**
     * {@inheritdoc}
     */
    public function handle(): void
    {
        $text = 'Сап, если есть идея что посмотреть, кидай сюда ссылочку';

        $this->replyWithMessage(['text' => $text]);
    }
}
