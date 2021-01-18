<div>
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Görev oluşturuldu.') }}
        </x-jet-action-message>
        <x-jet-action-message class="mr-3" on="updated">
            {{ __('Görev düzenlendi.') }}
        </x-jet-action-message>
        <x-jet-action-message class="mr-3" on="deleted">
            {{ __('Görev silindi.') }}
        </x-jet-action-message>
        <x-jet-secondary-button wire:click="showModalForm">
            {{ __('YENİ GÖREV') }}
        </x-jet-secondary-button>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                GÖREV
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                OLUŞTURULMA
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                DURUM
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">İŞLEM</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if($todos->count())
                            @foreach($todos as $todo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $todo->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $todo->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($todo->status)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                TAMAMLANDI
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-600 text-white">
                                                BEKLİYOR
                                            </span>
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if(!$todo->status)
                                            <x-jet-secondary-button wire:click="justDoIt({{ $todo->id }})">
                                                {{ __('YAPILDI') }}
                                            </x-jet-secondary-button>

                                            <x-jet-button wire:click="showUpdateModalForm({{ $todo->id }})" class="ml-2">
                                                {{ __('DÜZENLE') }}
                                            </x-jet-button>
                                            @endif


                                        <x-jet-danger-button class="ml-2" wire:click="showModalDeleteConfirm({{ $todo->id }})">
                                            {{ __('SİL') }}
                                        </x-jet-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-nowrap" colspan="4">
                                    {{__('Henüz görev oluşturulmadı.')}}

                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <x-jet-dialog-modal wire:model="modalFormVisible">
                        <x-slot name="title">
                            @if($todoId)
                                {{ __('Görev Düzenle') }}
                            @else
                                {{ __('Yeni Görev') }}
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="mt-4">
                                <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="title"  />
                                <x-jet-input-error for="title" class="mt-2" />
                            </div>

                        </x-slot>

                        <x-slot name="footer">
                            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                                {{ __('VAZGEÇ') }}
                            </x-jet-secondary-button>

                            @if($todoId)
                                <x-jet-button class="ml-2" wire:click="update()">
                                    {{ __('KAYDET') }}
                                </x-jet-button>

                            @else
                                <x-jet-button class="ml-2" wire:click="save()">
                                    {{ __('OLUŞTUR') }}
                                </x-jet-button>
                            @endif
                        </x-slot>
                    </x-jet-dialog-modal>
                    <x-jet-dialog-modal wire:model="modalDeleteConfirmVisible">
                        <x-slot name="title">
                            {{ __('Görevi Sil') }}
                        </x-slot>

                        <x-slot name="content">
                            {{ __('Görevi silmek istediğinize emin misiniz? Görev kalıcı olarak silinecektir.') }}

                        </x-slot>
                        <x-slot name="footer">
                            <x-jet-secondary-button wire:click="$toggle('modalDeleteConfirmVisible')" wire:loading.attr="disabled">
                                {{ __('VAZGEÇ') }}
                            </x-jet-secondary-button>

                            <x-jet-danger-button class="ml-2" wire:click="delete()">
                                {{ __('SİL') }}
                            </x-jet-danger-button>
                        </x-slot>
                    </x-jet-dialog-modal>
                </div>
            </div>
        </div>
    </div>

</div>
