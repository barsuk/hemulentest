<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-center">Ваши реестры</h2>
                    @if ($message = Session::get('fail'))
                        <div class="alert alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <ol type="A">
                        @foreach($lists as $list)
                            {{--                        {{$list->fio}}--}}
                            <li style="margin-bottom: 5px">
                                Файл {{$list->name}}
                                <ul>
                                    @forelse($list->entries as $entry)
                                        {{$entry->lastname}} {{$entry->firstname}} {{$entry->middlename}}
                                    @empty
                                        <p>Пустой файл</p>
                                    @endforelse
                                </ul>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
