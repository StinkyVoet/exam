<textarea id="editor" name="{{ $name }}" {{ $required ?? null }} style="display: none" placeholder="{{ $placeholder ?? null }}">
    {{ $slot }}
</textarea>
