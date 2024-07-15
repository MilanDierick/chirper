<div class="space-y-6" id="children-list">
    @foreach ($children as $child)
        @include('children.partials.single', ['child' => $child])
    @endforeach
</div>
