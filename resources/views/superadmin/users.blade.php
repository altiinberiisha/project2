<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <input type="text" id="search" name="search" placeholder="Search users" class="px-4 py-2 border-gray-300 rounded-lg text-black">
                        <button id="search-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                    </div>
                    <div id="user-list" class="mt-4">
                        <ul class="border border-gray-300 rounded-lg">
                            <li class="p-4 border-b border-gray-300 flex justify-between items-center font-bold">
                                <span class="flex-1">Name</span>
                                <span class="flex-1">Email</span>
                                <span class="flex-1">Created At</span>
                                <span class="flex-1"></span>
                            </li>
                            @forelse($users as $user)
                            <li class="p-4 border-b border-gray-300 flex justify-between items-center">
                                <span class="flex-1 {{ $user->name == request()->input('search') ? 'font-bold text-black' : '' }}">{{ $user->name }}</span>
                                <span class="flex-1">{{ $user->email }}</span>
                                <span class="flex-1">{{ $user->created_at }}</span>
                                <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            </li>
                            @empty
                            <li class="p-4">No users found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    input[type="text"],
    input[type="search"],
    input[type="email"],
    input[type="password"],
    textarea {
        color: black;
    }

    #user-list li:not(:first-child) > span {
        margin-right: 10px;
    }

    #user-list li:not(:first-child) > a {
        margin-left: 10px;
    }

    #user-list li:not(:first-child) {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #user-list li:not(:first-child) > span.flex-1 {
        display: flex;
        align-items: center;
    }
</style>

<script>
    $(document).ready(function() {
        $('#search-btn').click(function() {
            searchUsers();
        });

        $('#search').on('input', function() {
            searchUsers();
        });


        function searchUsers() {
            var search = $('#search').val();

            $.ajax({
                url: '{{ route('superadmin.dashboard.search') }}',
                type: 'GET',
                data: {
                    search: search
                },
                success: function(response) {
                    var userListHtml = '';

                    response.forEach(function(user) {
                        userListHtml += '<li class="p-4 border-b border-gray-300 flex justify-between items-center"><span class="font-bold text-black">' + user.name + '</span><span class="text-gray-500">' + user.email + '</span><span class="text-gray-500">' + user.created_at + '</span><a href="' + '{{ route('users.edit', $user) }}' + '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a></li>';
                    });

                    if (response.length == 0) {
                        userListHtml = '<li class="p-4">No users found.</li>';
                    }

                    $('#user-list ul').html(userListHtml);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>