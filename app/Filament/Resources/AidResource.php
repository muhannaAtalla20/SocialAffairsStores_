<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AidResource\Pages;
use App\Filament\Resources\AidResource\RelationManagers;
use App\Models\Aid;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AidResource extends Resource
{
    protected static ?string $model = Aid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'إدارة النظام';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->required()
                    ->label('اسم المساعدة'),

                Select::make('type')
                    ->required()
                    ->label('نوع المساعدة')
                    ->options([
                        'food' => 'غذائية',
                        'clothing' => 'ملابس',
                        'medical' => 'طبية',
                        'cash' => 'نقدية',
                    ]),

                TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->label('الكمية'),

                DatePicker::make('arrival_date')
                    ->required()
                    ->label('تاريخ الوصول'),

                Select::make('organization_id')
                    ->label('المنظمة المرسلة')
                    ->relationship('organization', 'name')
                    ->required(),

                Select::make('warehouse_id')
                    ->label('المخزن المستقبل')
                    ->relationship('warehouse', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->label('الاسم')->searchable(),
                TextColumn::make('type')->label('النوع'),
                TextColumn::make('quantity')->label('الكمية'),
                TextColumn::make('arrival_date')->label('تاريخ الوصول')->date(),
                TextColumn::make('organization.name')->label('المنظمة'),
                TextColumn::make('warehouse.name')->label('المخزن'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAids::route('/'),
            'create' => Pages\CreateAid::route('/create'),
            'edit' => Pages\EditAid::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        if ($user->role === 'representative') {
            return parent::getEloquentQuery()
                ->where('warehouse_id', optional($user->warehouse)->id);
        }

        return parent::getEloquentQuery();
    }
}
