<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';



    /*
    
         'name',
        'post',
        'start_date',
        'end_date',
        'news_date',
        'is_visible',
        'category_id',
    
    */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    TextInput::make('name')->label('Title')->unique(ignoreRecord: true)->required(),
                    RichEditor::make('post')->rule('min:120')->label('Title'),
 FileUpload::make('image')->disk('public')->directory('post')->imageEditor(),
                ]),
                
                Group::make()->schema([
                   
                Section::make('Event Duration')->schema([
                    DateTimePicker::make('start_date')->label('Event Start Date')->helperText('Provide start date if you are posting event'),
                DateTimePicker::make('end_date')->label('Event End Date')->helperText('Provide end date if you are posting event'),
                ]),
                DatePicker::make('new_date')->label('News Day')->helperText('Provide news date if you are posting news'),
                Toggle::make('is_visble')->default(true)->label('Make Post visible')->helperText('Turining this off will make the post not visible.'),
                Select::make('category_id')->relationship('category','name')->required()
                ]),
                

               
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name'),
                ImageColumn::make('image'),
                ToggleColumn::make('is_visible')->label('visibility')
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }    
}
