<x-app-layout>
    <x-title title="Create folder" />

    <div class="uk-width-1-3">
        <form action="{{ route('folders.store') }}" method="POST">
            <div class="uk-margin-large-bottom">
                @include('resources.folders.form')
            </div>

            {!! formButton('create')->render() !!}
        </form>
    </div>

</x-app-layout>
