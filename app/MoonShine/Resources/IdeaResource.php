<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\IdeaStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Idea;

use Illuminate\Support\Facades\Lang;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Url;

/**
 * @extends ModelResource<Idea>
 */
class IdeaResource extends ModelResource
{
    protected string $model = Idea::class;

    protected string $title = 'Ideas';
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Сообщение','message'),
            Url::make('Tg', 'sender_tg', fn($item) => "https://t.me/" . $item->sender_tg)
                ->title(fn(string $url, Url $ctx) => "@" . substr($url, 13))
                ->blank(),
            Enum::make('Статус','status')
                ->attach(IdeaStatusEnum::class)
                ->badge(),
            Date::make('Дата','created_at', fn($item) => Carbon::createFromTimestamp($item->created_at, 'Europe/Moscow'))->format('d.m.Y H:i'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Enum::make('Статус','status')->attach(IdeaStatusEnum::class)
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Сообщение','message'),
            Url::make('Tg', 'sender_tg', fn($item) => "https://t.me/" . $item->sender_tg)
                ->title(fn(string $url, Url $ctx) => "@" . substr($url, 13))
                ->blank(),
            Enum::make('Статус','status')
                ->attach(IdeaStatusEnum::class)
                ->badge(),
            Date::make('Дата','created_at', fn($item) => Carbon::createFromTimestamp($item->created_at, 'Europe/Moscow'))->format('d.m.Y H:i'),
        ];
    }

    /**
     * @param Idea $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
