<?php

namespace App\View\Components;

use App\Models\File;
use App\Services\FileService;
use App\Services\Impl\FileServiceImpl;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MemoryMonitor extends Component
{
    protected $fileService;
    /**
     * Create a new component instance.
     */
    public function __construct(FileService $fileService = new FileServiceImpl())
    {
        //
        $this->fileService = $fileService;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $usedMemoryInBytes = File::sum('file_size') ?? 0;

        $availableMemoryInBytes = config('app.storage_size', 2147483648) - $usedMemoryInBytes;
        $availableMemoryInBytes = $availableMemoryInBytes >= 0 ? $availableMemoryInBytes : 0;

        $usedMemoryPercent = round($usedMemoryInBytes / config('app.storage_size', 2147483648) * 100, 1);

        $usedMemory = $this->fileService->getFromattedFileSize($usedMemoryInBytes, 2);
        $availableMemory = $this->fileService->getFromattedFileSize($availableMemoryInBytes, 2);

        return view('components.memory-monitor', compact('usedMemoryPercent', 'usedMemory', 'availableMemory'));
    }
}
