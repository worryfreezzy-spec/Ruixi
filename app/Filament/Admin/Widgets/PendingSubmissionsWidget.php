<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Models\ContactSubmission;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PendingSubmissionsWidget extends TableWidget
{
    protected static ?int $sort = 10;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('待处理用户信息')
            ->description('状态为“新提交”的最新用户咨询和预约信息')
            ->query(fn (): Builder => ContactSubmission::query()
                ->where('status', 'new')
                ->latest('created_at'))
            ->columns([
                TextColumn::make('name')
                    ->label('姓名')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('电话')
                    ->searchable(),
                TextColumn::make('treatment')
                    ->label('感兴趣的治疗项目')
                    ->limit(24),
                TextColumn::make('branch')
                    ->label('属意分行')
                    ->limit(20),
                TextColumn::make('created_at')
                    ->label('提交时间')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make()
                    ->label('查看')
                    ->url(fn (ContactSubmission $record): string => ContactSubmissionResource::getUrl('view', ['record' => $record])),
            ]);
    }
}
