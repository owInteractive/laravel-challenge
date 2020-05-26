<div class="list-group">
    <a href="{{ url('events') }}" class="list-group-item sidebar-item bg-transparent ">
        <i class="fas fa-calendar-alt mr-1"></i>List Events
    </a>
    <a href="{{ url('events/create') }}" class="list-group-item sidebar-item bg-transparent">
        <i class="fas fa-calendar-plus mr-1"></i>Create Events
    </a>
    <a href="{{ url('exporter') }}" class="list-group-item sidebar-item bg-transparent position-static">
        <i class="fas fa-cloud-upload-alt mr-1"></i>Import/Export Events
    </a>
    <a href="{{ url('/invites') }}" class="list-group-item sidebar-item bg-transparent position-static">
        <i class="fas fa-list mr-1"></i>Invites
    </a>
</div>