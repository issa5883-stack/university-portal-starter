@props(['action'])

<form action="{{ $action }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete?')">
        <i class="bi bi-trash-fill me-1"></i> Delete
    </button>
</form>
