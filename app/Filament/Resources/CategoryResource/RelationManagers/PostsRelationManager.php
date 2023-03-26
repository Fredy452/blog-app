<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// Para armar formulario
use Closure;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;

// Select
use Filament\Forms\Components\Select;
// text
use Filament\Forms\Components\RichEditor;
// togle
use Filament\Forms\Components\Toggle;
// Spatye
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
// TagResource
use Filament\Forms\Components\TagsInput;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                  //Forms\Components\TextInput::make('title'),
                    Card::make()->schema([
                        // Creamos el select
                        Select::make('category_id')->required()
                        ->relationship('category', 'name'),
                        TextInput::make('title')->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) {
                            $set('slug', Str::slug($state));
                        })->required(),
                        TextInput::make('slug')->required(),
                        SpatieMediaLibraryFileUpload::make('thumbnail')->collection('posts'),
                        RichEditor::make('content'),
                        Toggle::make('is_published')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    //Mostramos los datos de la tabla
                    TextColumn::make('id')->sortable(),
                    TextColumn::make('title')->limit('50')->sortable(),
                    BooleanColumn::make('is_published'),
                ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }    
    
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
