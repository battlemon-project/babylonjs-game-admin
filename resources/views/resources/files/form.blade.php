@csrf

<div class="uk-margin-large-bottom">
    {!! formSelect('folder')
            ->options($folders)
            ->label('Folder *')
            ->value($folder ?? null)
            ->render()
    !!}

    {!! formFile('file')->label('File *')->placeholder('select file')->render() !!}
    {!! formInput('file_name_in_game')
            ->label('Name in game')
            ->placeholder('file_name')
            ->value($file ?? null)
            ->render()
    !!}
</div>
