<?php

namespace Livespec\Livespec\Config;

use Symfony\Component\Yaml\Yaml;

class ConfigLoader
{
    private array $config;

    public function __construct(string $configPath = 'livespec.yml')
    {
        if (!file_exists($configPath)) {
            throw new \RuntimeException("Config file not found: {$configPath}");
        }

        $this->config = Yaml::parseFile($configPath);
    }

    public function getApiSource(): string
    {
        return $this->config['api']['source'] ?? throw new \RuntimeException('api.source not configured');
    }

    public function getAgentModel(): string
    {
        return $this->config['agent']['model'] ?? 'gpt-4o-mini';
    }

    public function isStrictValidation(): bool
    {
        return $this->config['validation']['strict'] ?? true;
    }

    public function getApiKey(): ?string
    {
        return $this->config['agent']['api_key'] ?? getenv('OPENAI_API_KEY') ?: null;
    }

    public function getOutputDir(): string
    {
        return $this->config['output']['dir'] ?? './livespec-output';
    }

    public function all(): array
    {
        return $this->config;
    }
}