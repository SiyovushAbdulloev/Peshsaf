<div class="col-span-12">
    <div class="intro-y box col-span-12 lg:col-span-6">
        @if(!$return->exists)
            <div class="flex justify-start border-b border-slate-200/60 py-2 px-5 dark:border-darkmode-400">
                <h2 class="text-base my-auto font-medium col-span-2">
                    Клиент
                </h2>
                <div x-data="{isTyped: false}" x-on:click.outside="isTyped = false"
                     class="relative w-full 2xl:w-1/2 my-auto ml-10">
                    <div class="relative">
                        <x-base.form-input
                            type="text"
                            placeholder="Введите для поиска"
                            autocomplete="off"
                            autofocus="true"
                            id="query"
                            x-on:input.debounce.400ms="isTyped = ($event.target.value != '')"
                            wire:model="query"
                            wire:keyup="search"
                        />
                    </div>

                    <div x-show="isTyped"
                         class="max-h-[200px] overflow-y-auto border border-gray-200 mt-2 p-2 absolute bg-white w-full 2xl:w-1/2 z-50">
                        @forelse($clients ?? [] as $client)
                            <div wire:click="selectClient({{ $client }})" x-on:click="isTyped = false" class="p-2
                        hover:bg-gray-100
        hover:cursor-pointer" :key="$client->id">{{ $client->name }}</div>
                        @empty
                            <div x-on:click="isTyped = false" class="p-2 hover:bg-gray-100
            text-center italic text-gray-500
            ">Ничего не найдено
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
        @if($currentClient)
            <div class="intro-y box mt-5 px-5 pt-5">
                <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                    <div class="image-fit ml-3 h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                        <img class="rounded-lg" src="https://picsum.photos/300/400">
                    </div>
                    <div
                        class="mt-6 flex-1 border-l border-r border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                        <input type="hidden" name="client_id" value="{{ $currentClient->id }}"/>
                        <div class="text-center text-lg font-medium lg:mt-3 lg:text-left">
                            {{ $currentClient->name }}
                        </div>
                        <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                            <div class="flex items-center truncate sm:whitespace-normal">
                                <x-base.icon icon="fa-location-dot"/>
                                {{ $currentClient->address }}
                            </div>
                            <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                                <x-base.icon icon="fa-phone"/>
                                {{ $currentClient->phone }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
