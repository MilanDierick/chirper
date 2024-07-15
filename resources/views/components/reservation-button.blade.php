<div>
    <a href="#"
       class="w-full px-4 py-3 text-2xl rounded-md transition duration-300 text-center block {{ $buttonClass() }}"
       @if ($buttonDisabled()) onclick="return false;" @else onclick="document.getElementById('reservation-modal').classList.remove('hidden');" @endif>
        {{ $buttonText() }}
    </a>
</div>
