<div class="gjs-editor">
    <div id="gjs" wire:ignore></div>

    <div wire:loading class="p-4">
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">

            <div class="fixed inset-0 bg-gray-900 bg-opacity-50"></div>

            <div class="relative z-50 px-8 py-6 mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col items-center px-6">
                    <!-- Spinner Animation -->
                    <div class="w-12 h-12 mb-4">
                        <svg class="w-12 h-12 animate-spin text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>

                    <p class="text-lg font-semibold text-gray-700">Loading...</p>
                    <p class="mt-2 text-sm text-gray-500">Please wait while we process your request</p>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{asset('assets/filament-page-builder.css')}}"/>
    @endpush

    <script src="{{asset('assets/filament-page-builder.min.js')}}"></script>
    <script>
        localStorage.setItem('isOpen', false)

        document.addEventListener('livewire:init', () => {
            Livewire.on("load-initial-data", ([page, blocks, settings]) => {
                initPageBuilder({
                    container: "#gjs",
                    page,
                    blocks,
                    settings,
                    getData: (model, filter) => @this?.getData(model, filter),
                    onSave: (data) => @this.handleSave(data),
                })
            })
        })
    </script>
</div>
