<?php

namespace App\Jobs;

use App\Imports\StudentsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

class ImportStudentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct(UploadedFile $file)
    {
        // Store the file in a temporary location
        $this->filePath = $file->store('imports', 'local');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Import the Excel file
            Excel::import(new StudentsImport, storage_path('app/' . $this->filePath));
            
            // Clean up the temporary file
            \Storage::disk('local')->delete($this->filePath);
            
            \Log::info('Students import completed successfully');
        } catch (\Exception $e) {
            \Log::error('Students import failed: ' . $e->getMessage());
            
            // Clean up the temporary file even on failure
            \Storage::disk('local')->delete($this->filePath);
            
            throw $e;
        }
    }
}