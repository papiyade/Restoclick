<!-- resources/views/partials/notifications.blade.php -->
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Notifications <span class="badge badge-light">{{ \App\Models\Notification::where('is_read', false)->count() }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
        @forelse ($notifications as $notification)
            <a class="dropdown-item" href="{{ route('notifications.read', $notification->id) }}">
                <strong>{{ $notification->message }}</strong>
            </a>
        @empty
            <span class="dropdown-item">Aucune nouvelle notification</span>
        @endforelse
    </div>
</div>
