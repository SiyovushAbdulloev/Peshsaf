<div>
    @if(!$receipt->filepath)
        <x-base.button
            size="sm"
            type="button"
            variant="outline-warning"
            wire:click="generate"
            wire:loading.remove
        >
            <x-base.icon icon="fa-check"/>
        </x-base.button>
    @else
        <x-base.button
            as="a"
            target="_blank"
            :href="$receipt->url"
            size="sm"
            type="button"
            variant="outline-danger"
        >
            <x-base.icon icon="fa-file-pdf"/>
        </x-base.button>
    @endif

    <x-base.button
        type="button"
        variant="primary"
        class="flex ml-auto gap-3"
        wire:loading.flex
        disabled
    >
        <span class="h-4 w-4">
            <svg class="h-full w-full" width="20" viewBox="0 0 58 58" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" fill-rule="evenodd">
                    <g transform="translate(2 1)" stroke="#ffffff" stroke-width="1.5">
                        <circle cx="42.601" cy="11.462" r="5" fill-opacity="1" fill="#ffffff">
                            <animate values="1;0;0;0;0;0;0;0" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                        <circle cx="49.063" cy="27.063" r="5" fill-opacity="0" fill="#ffffff">
                            <animate values="0;1;0;0;0;0;0;0" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                        <circle cx="42.601" cy="42.663" r="5" fill-opacity="0" fill="#ffffff">
                            <animate values="0;0;1;0;0;0;0;0" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                        <circle cx="27" cy="49.125" r="5" fill-opacity="0" fill="#ffffff">
                            <animate values="0;0;0;1;0;0;0;0" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                        <circle cx="11.399" cy="42.663" r="5" fill-opacity="0" fill="#ffffff">
                            <animate values="0;0;0;0;1;0;0;0" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                        <circle cx="4.938" cy="27.063" r="5" fill-opacity="0" fill="#ffffff">
                            <animate values="0;0;0;0;0;1;0;0" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                        <circle cx="11.399" cy="11.462" r="5" fill-opacity="0" fill="#ffffff">
                            <animate values="0;0;0;0;0;0;1;0" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                        <circle cx="27" cy="5" r="5" fill-opacity="0" fill="#ffffff">
                            <animate values="0;0;0;0;0;0;0;1" attributeName="fill-opacity" begin="0s" dur="1.3s"
                                     calcMode="linear" repeatCount="indefinite"></animate>
                        </circle>
                    </g>
                </g>
            </svg>
        </span>
    </x-base.button>
</div>
