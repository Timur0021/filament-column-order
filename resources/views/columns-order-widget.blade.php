<div>
    <h3 class="font-bold mb-2">Порядок колонок</h3>

    <ul x-data x-init="Sortable.create($refs.list, {
            animation: 150,
            handle: '.cursor-move',
            onEnd: function () {
                let order = Array.from($refs.list.children).map(el => el.dataset.key);
                @this.call('updatedColumnsOrder', order);
            }
        })"
        x-ref="list"
        class="space-y-2 border p-3 rounded bg-gray-50">

        @foreach($order as $item)
            <li data-key="{{ $item }}"
                class="p-2 bg-white border rounded shadow cursor-move flex justify-between items-center">
                <span style="color: #0a0a0a">{{ $labels[$item] ?? $item }}</span>
                <span class="text-gray-400 text-xs">⇅</span>
            </li>
        @endforeach
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
