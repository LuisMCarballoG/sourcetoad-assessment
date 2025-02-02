<?php

namespace App\Services;

class JsonFileLoaderService
{
    /**
     * @var string[]
     */
    private array $data;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->data = [];
        $this->loadJson($filePath);
    }

    /**
     * @param string $filePath
     * @return void
     */
    private function loadJson(string $filePath): void
    {
        $jsonContent = file_get_contents($filePath);

        if ($jsonContent === false) {
            echo "Failed to read file: $filePath";
            return;
        }

        // @phpstan-ignore-next-line
        $this->data = json_decode($jsonContent, true) ?? [];
        $this->validateJson();
    }

    /**
     * @return void
     */
    private function validateJson(): void
    {
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'JSON Error: ' . json_last_error_msg();
        }
    }

    /**
     * @return string[]
     */
    public function getData(): array
    {
        return $this->data;
    }
}
