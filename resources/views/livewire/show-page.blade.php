@push('styles')
    <style>
        {!! $page->styles !!}
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endpush

<div>
    {!! $page->html !!}
</div>
