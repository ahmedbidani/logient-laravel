<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('links.create') }}"
                        class="text-white bg-gray-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('Create Link') }}</a>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Url
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Short Url
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Creation Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edit ?
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delete ?
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($links as $link)
                                    <tr>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$link->user->name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $link->url }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ url($link->url) }}" target="_blank"> {{ $link->url }}{{$link->short_url}}</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $link->created_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('links.edit',$link->id) }}"
                                                class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Edit</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('links.destroy', $link->id) }}" method="Post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link btn-sm btn-rounded px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>