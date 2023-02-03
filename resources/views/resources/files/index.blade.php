<x-app-layout>
    <x-title title="Files" />

    <div class="uk-grid uk-flex-between">
        <div>
            <form>
                <div class="uk-grid uk-grid-small">
                    <div>
                        <input type="text" class="uk-input" placeholder="name" name="name">
                    </div>

                    <div>
                        <select class="uk-select" name="folder">
                            <option value="">- folder -</option>
                            @foreach($folders as $folder)
                                <option value="{{ $folder }}" @if(request('folder') == $folder)selected @endif>
                                    {{ $folder }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="uk-button uk-button-primary">filter</button>
                    </div>

                    <div>
                        <a href="{{ route('files.index') }}" class="uk-button uk-button-default">reset</a>
                    </div>
                </div>
            </form>
        </div>
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
                <th>date</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file['name'] }}</td>
                    <td>{{ $file['folder'] }}</td>
                    <td>{{ $file['date_time'] }}</td>
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
                                <a class="confirm" uk-icon="icon: trash" href="{{ route('files.delete', ['file' => $file['name'], 'folder' => $file['folder']]) }}">
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
