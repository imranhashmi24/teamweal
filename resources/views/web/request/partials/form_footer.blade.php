<div class="card mb-4">
    <div class="card-header">
        @lang('Additional Information')
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="notes" class="form-label">@lang('Special Requirements')</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>
    </div>
</div>

<div class="d-grid gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-send-fill me-2"></i> @lang('Submit Request')
    </button>
</div>