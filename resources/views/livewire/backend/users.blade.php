<div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KULLANICI
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KAYIT
                            </th>
                            <th scope="col" class="text-right relative px-6 py-3">
                                <x-jet-action-message class="mr-3" on="saved">
                                    {{ __('Yetkilendirme başarılı.') }}
                                </x-jet-action-message>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if($users->count())
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">

                                            @if($user->status)
                                                Yönetici
                                            @else
                                                Kullanıcı
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-900">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if(!$user->status)
                                            <x-jet-secondary-button wire:click="admin({{ $user->id }})">
                                                {{ __('YÖNETİCİ YAP') }}
                                            </x-jet-secondary-button>
                                        @else

                                            <x-jet-button wire:click="user({{ $user->id }})">
                                                {{ __('KULLANICI YAP') }}
                                            </x-jet-button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @endif



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
