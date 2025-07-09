<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class ContentSecurityPolicy extends BaseConfig
{
    public bool $reportOnly = false;
    public ?string $reportURIs = null;
    public bool $upgradeInsecureRequests = false;

    public array $defaultSrc = [
        'self',
        'https://fonts.gstatic.com',
        'https://cdn.jsdelivr.net',
    ];

    public array $scriptSrc = [
        'self',
        'https://app.sandbox.midtrans.com',
        'https://cdn.jsdelivr.net',
        'unsafe-inline',
        'unsafe-eval',
    ];

    public array $styleSrc = [
        'self',
        'https://fonts.googleapis.com',
        'https://cdn.jsdelivr.net',
        'unsafe-inline',
    ];
    
    public array $imageSrc = [
        'self',
        'data:',
    ];

    public array $frameSrc = [
        'self',
        'https://app.sandbox.midtrans.com',
    ];

    public array $fontSrc = [
        'self',
        'https://fonts.gstatic.com',
        'https://cdn.jsdelivr.net',
    ];

    /**
     * TAMBAHKAN BAGIAN INI
     * Memberi izin ke JavaScript untuk membuat koneksi API ke Midtrans.
     */
    public array $connectSrc = [
        'self',
        'https://api.sandbox.midtrans.com',
    ];
}