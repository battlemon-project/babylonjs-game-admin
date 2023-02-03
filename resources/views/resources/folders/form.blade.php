@csrf

{!! formInput('name')->label('Name *')->value(old('name', $folderName ?? null))->placeholder('example_name_folder')->render() !!}
