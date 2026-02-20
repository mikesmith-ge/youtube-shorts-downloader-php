<?php

namespace Instaboost\Tools;

/**
 * YouTube Shorts Downloader
 * 
 * Extract YouTube Shorts videos and metadata
 * 
 * @author Instaboost Team
 * @license MIT
 * @version 1.0.0
 */
class YouTubeDownloader
{
    private const USER_AGENT = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36';
    private const TIMEOUT = 15;
    
    /**
     * Download YouTube Short
     * 
     * @param string $url YouTube URL
     * @return array Extracted data
     * @throws \Exception on errors
     */
    public function download(string $url): array
    {
        if (!$this->isValidUrl($url)) {
            throw new \Exception('Invalid YouTube URL');
        }
        
        $html = $this->fetchHtml($url);
        $data = $this->parseData($html);
        
        if (empty($data)) {
            throw new \Exception('Could not extract data. Content may be private or deleted.');
        }
        
        return $data;
    }
    
    private function isValidUrl(string $url): bool
    {
        $pattern = '/^https?:\/\/(www\.|m\.)?youtube\.com/i';
        return preg_match($pattern, $url) === 1;
    }
    
    private function fetchHtml(string $url): string
    {
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => self::TIMEOUT,
            CURLOPT_USERAGENT => self::USER_AGENT,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        
        $html = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($html === false) {
            throw new \Exception("Network error: {$error}");
        }
        
        if ($httpCode === 404) {
            throw new \Exception('Content not found');
        }
        
        if ($httpCode === 403 || $httpCode === 429) {
            throw new \Exception('Access denied or rate limited');
        }
        
        if ($httpCode !== 200) {
            throw new \Exception("HTTP error: {$httpCode}");
        }
        
        return $html;
    }
    
    private function parseData(string $html): array
    {
        $data = [];
        
        // Extract og:title
        if (preg_match('/<meta\s+property=["']og:title["\']\s+content=["\'](.client?)["\']/, $html, $titleMatch)) {
            $data['title'] = html_entity_decode($titleMatch[1]);
        }
        
        // Extract og:description
        if (preg_match('/<meta\s+property=["']og:description["\']\s+content=["\'](.client?)["\']/, $html, $descMatch)) {
            $data['description'] = html_entity_decode($descMatch[1]);
        }
        
        return $data;
    }
}
