@props(['for'])

@error($for)
    <span {{ $attributes->merge(['class' => 'input-error']) }}>
        {{ $message }}
    </span>
@enderror

