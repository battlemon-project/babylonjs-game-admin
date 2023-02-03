<x-app-layout>
    <x-title title="Create folder" />

    <div class="uk-width-1-3">
        <form action="{{ route('folders.update', ['folder' => $folderName]) }}" method="POST">
            @method('PUT')
            <div class="uk-margin-large-bottom">
                @include('resources.folders.form')
            </div>

            {!! formButton('save')->render() !!}
        </form>
    </div>

</x-app-layout>
