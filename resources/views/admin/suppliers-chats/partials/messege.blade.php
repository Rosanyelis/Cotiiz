<li class="chat-message chat-message-right">
    <div class="d-flex overflow-hidden">
        <div class="chat-message-wrapper flex-grow-1">
            <div class="chat-message-text">
                <p class="mb-0">{{ $msj->message }}</p>
            </div>
            @if ($msj->file)
            <div class="chat-message-text mt-2">
                <a href="{{ asset($msj->file) }}" target="_blank" class="mb-0 text-white">{{ $msj->name_file }}</a>
            </div>
            @endif
            <div class="text-end text-muted mt-1">
                <i class="ri-check-double-line ri-14px text-success me-1"></i>
                <small>{{ $msj->created_at->diffForHumans() }}</small>
            </div>
        </div>
        <div class="user-avatar flex-shrink-0 ms-4">
            <div class="avatar avatar-sm">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
        </div>
    </div>
</li>

