<label class="{{ $class ?? null }}">
    <span>{{ $label ?? $select ?? 'error' }}</span>
    {!! Form::select($select, $data ?? []) !!}
</label>