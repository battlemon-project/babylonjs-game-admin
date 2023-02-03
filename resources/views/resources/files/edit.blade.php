<x-app-layout>
    <x-title title="Edit file"/>

    <div class="uk-width-1-3">
        <form action="{{ route('files.update', $file) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('resources.files.form')

            {!! formButton('update')->render() !!}
        </form>
    </div>

</x-app-layout>
