<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $domain;

    public function __construct(string $url, string $title = '', string $description = '')
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->domain = parse_url($url, PHP_URL_HOST) ?: '';
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer">
        <div class="link-card-content">
            <span class="link-card-title">{$escapedTitle}</span>
            <p class="link-card-desc">{$escapedDesc}</p>
            <span class="link-card-domain">{$escapedDomain}</span>
        </div>
    </a>
</div>
HTML;
    }

    public static function createFromDefaults(): self
    {
        return new self(
            'https://homeofficial-leyu.com.cn',
            '乐鱼体育',
            '乐鱼体育 - 官方首页'
        );
    }

    public static function createCard(string $url, string $title, string $description): string
    {
        $card = new self($url, $title, $description);
        return $card->render();
    }
}

function renderLinkCard(string $url, string $title, string $description): string
{
    $escapedUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $escapedTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $escapedDesc = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $domain = htmlspecialchars(parse_url($url, PHP_URL_HOST) ?: '', ENT_QUOTES | ENT_HTML5, 'UTF-8');

    return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer">
        <div class="link-card-content">
            <span class="link-card-title">{$escapedTitle}</span>
            <p class="link-card-desc">{$escapedDesc}</p>
            <span class="link-card-domain">{$domain}</span>
        </div>
    </a>
</div>
HTML;
}

function renderDefaultLinkCard(): string
{
    return renderLinkCard(
        'https://homeofficial-leyu.com.cn',
        '乐鱼体育',
        '乐鱼体育 - 官方首页'
    );
}