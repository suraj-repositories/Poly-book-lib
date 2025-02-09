<div class="p-3">
    <h5 class="card-title">Memory Monitor</h5>
    <div id="memory-tracker" class="apex-charts mb-2 mt-n2" data-memory-used="{{ $usedMemoryPercent }}"></div>
    <div class="row text-center">
         <div class="col-6">
              <p class="text-muted mb-2">Total Used</p>
              <h3 class="text-dark mb-3">{{ $usedMemory }}</h3>
         </div> <!-- end col -->
         <div class="col-6">
              <p class="text-muted mb-2">Total Available</p>
              <h3 class="text-dark mb-3">{{ $availableMemory }}</h3>
         </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="text-center">
         <a href="{{ route('admin.files') }}" class="btn btn-light shadow-none w-100">View Details</a>
    </div> <!-- end row -->
</div>
