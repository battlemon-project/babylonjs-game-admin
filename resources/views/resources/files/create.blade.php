<x-app-layout>
    <x-title title="Create file"/>

    <div class="uk-width-1-3">
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
            @include('resources.files.form')

            {!! formButton('create')->render() !!}
        </form>
    </div>

</x-app-layout>
