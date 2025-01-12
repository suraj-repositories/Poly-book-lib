<?php

namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    protected $settings;

    public function __construct()
    {
        $this->loadSettings();
    }

    /**
     * Load settings from the database.
     */
    protected function loadSettings(): void
    {
        $this->settings = Setting::all()->pluck('value', 'key')->toArray();
    }

    /**
     * Get a setting value by key.
     */
    public function get(string $key, $default = null)
    {
        return $this->settings[$key] ?? $default;
    }

    /**
     * Refresh the settings cache.
     */
    public function refresh(): void
    {
        $this->loadSettings();
    }
}
