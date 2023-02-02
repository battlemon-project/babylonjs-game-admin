<x-app-layout>
    <x-title title="Files" />

    <div class="uk-flex uk-flex-right">
        <div>
            <a class="uk-button uk-button-primary" href="{{ route('files.create') }}">
                + create
            </a>
        </div>
    </div>

    <table class="uk-table">
        <thead>
            <tr>
                <th>name</th>
                <th>folder</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file['name'] }}</td>
                    <td>{{ $file['folder'] }}</td>
                    <td>
                        <div class="uk-grid uk-grid-small">
                            <div>
                                <a uk-icon="icon: download" href="{{ route('files.download', ['file' => $file['name'], 'folder' => $file['folder']]) }}">
                                    download
                                </a>
                            </div>

                            <div>
                                <a uk-icon="icon: pencil" href="{{ route('files.edit', ['file' => $file['name'], 'folder' => $file['folder']]) }}">
                                    edit
                                </a>
                            </div>

                            <div>
                                <a uk-icon="icon: trash" href="{{ route('files.delete', ['file' => $file['name'], 'folder' => $file['folder']]) }}">
                                    delete
                                </a>
                            </div>
                        </div>




                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
