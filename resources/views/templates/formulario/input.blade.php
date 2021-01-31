<label class="{{ $class ?? null }}">
    <span>{{ $label ?? $input ?? 'error' }}</span>
    {!! Form::text($input, $value ?? null, $attributes) !!}
</label>