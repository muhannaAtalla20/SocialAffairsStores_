<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AidDistributionResource\Pages;
use App\Filament\Resources\AidDistributionResource\RelationManagers;
use App\Models\AidDistribution;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AidDistributionResource extends Resource
{
    protected static ?string $model = AidDistribution::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'إدارة النظام';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('beneficiary_id')
                    ->label('المستفيد')
                    ->relationship('beneficiary', 'name')
                    ->searchable()
                    ->required(),

                Select::make('warehouse_id')
                    ->label('المخزن')
                    ->relationship('warehouse', 'name')
                    ->searchable()
                    ->required(),

                Select::make('aid_type')
                    ->label('نوع المساعدة')
                    ->required()
                    ->options([
                        'food' => 'غذائية',
                        'clothing' => 'ملابس',
                        'medical' => 'طبية',
                        'cash' => 'نقدية',
                    ]),

                DatePicker::make('received_at')
                    ->label('تاريخ الاستلام')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('beneficiary.name')->label('المستفيد'),
                TextColumn::make('warehouse.name')->label('المخزن'),
                TextColumn::make('aid_type')->label('نوع المساعدة'),
                TextColumn::make('received_at')->label('تاريخ الاستلام')->date(),
                TextColumn::make('created_at')->label('أُضيف في')->since(),
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
            'index' => Pages\ListAidDistributions::route('/'),
            'create' => Pages\CreateAidDistribution::route('/create'),
            'edit' => Pages\EditAidDistribution::route('/{record}/edit'),
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
    // public static function canAccess(): bool
    // {
    //     return auth()->user()->role === 'admin';
    // }

}
