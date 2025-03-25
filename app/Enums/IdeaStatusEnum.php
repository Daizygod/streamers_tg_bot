<?php

namespace App\Enums;

use MoonShine\Support\Enums\Color;

enum IdeaStatusEnum: string
{
    case Waiting = 'waiting';//в ожидании
    case InWork = 'in_work';//на рассмотрении
    case Canceled = 'canceled';//отклонено
    case InQueue = 'in_queue';//в очереди
    case Done = 'done';//сделано

    public function toString(): ?string
    {
        return match ($this) {
            self::Waiting => 'в ожидании',
            self::InWork => 'на рассмотрении',
            self::Canceled => 'отклонено',
            self::InQueue => 'в очереди',
            self::Done => 'готово',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Waiting => Color::INFO->value,
            self::InWork => Color::SECONDARY->value,
            self::Canceled => Color::ERROR->value,
            self::InQueue => Color::WARNING->value,
            self::Done => Color::SUCCESS->value,
        };
    }
}
