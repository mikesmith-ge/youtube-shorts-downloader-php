# YouTube Shorts Downloader (PHP)

![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-blue)
![License](https://img.shields.io/badge/license-MIT-green)
![Maintenance](https://img.shields.io/badge/Maintained-Yes-brightgreen)

> Download YouTube Shorts videos with PHP. Get direct video links, thumbnails, and metadata. Zero external dependencies required.

## 📋 Overview

**YouTube Shorts Downloader** is a lightweight PHP class that extracts direct video URLs and metadata from YouTube Shorts. No Google API key, no quota limits, no Composer dependencies.

**Also available in:**
- **[YouTube Shorts Downloader (Python)](https://github.com/mikesmith-ge/youtube-shorts-downloader-python)** – Python version
- **[YouTube Shorts Downloader (Node.js)](https://github.com/mikesmith-ge/youtube-shorts-downloader-nodejs)** – JavaScript version

## ✨ Features

- ✅ **Zero dependencies** – Pure PHP, no Composer required
- 🎬 **Direct video URLs** – Extract downloadable links
- 🖼️ **Thumbnail extraction** – Get video preview images
- 📝 **Metadata support** – Title, view count, channel info
- 🚀 **No API quota** – Unlimited without Google API restrictions
- 🔒 **Error handling** – Validates URLs and handles network errors
- 📦 **PSR-4 compatible** – Namespace: `Instaboost\Tools`

## 📦 Installation

### Option 1: Direct Download
```php
require_once 'YouTubeDownloader.php';
use Instaboost\Tools\YouTubeDownloader;
```

### Option 2: Clone Repository
```bash
git clone https://github.com/mikesmith-ge/youtube-shorts-downloader-php.git
cd youtube-shorts-downloader-php
```

## 🚀 Usage

### Basic Example

```php
<?php

require_once 'YouTubeDownloader.php';

use Instaboost\Tools\YouTubeDownloader;

$downloader = new YouTubeDownloader();

try {
    $video = $downloader->download('https://youtube.com/shorts/ABC123');
    
    echo "Title: " . $video['title'] . "\n";
    echo "Video URL: " . $video['url'] . "\n";
    echo "Thumbnail: " . $video['thumbnail'] . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
```

### Batch Processing

```php
<?php

require_once 'YouTubeDownloader.php';

use Instaboost\Tools\YouTubeDownloader;

$urls = [
    'https://youtube.com/shorts/ABC123',
    'https://youtube.com/shorts/XYZ789',
];

$downloader = new YouTubeDownloader();

foreach ($urls as $url) {
    try {
        $video = $downloader->download($url);
        echo "✓ Downloaded: " . $video['title'] . "\n";
    } catch (Exception $e) {
        echo "✗ Error for {$url}: " . $e->getMessage() . "\n";
    }
    
    sleep(1); // Be respectful to YouTube
}
```

### Download Video to File

```php
<?php

require_once 'YouTubeDownloader.php';

use Instaboost\Tools\YouTubeDownloader;

$downloader = new YouTubeDownloader();

try {
    $video = $downloader->download('https://youtube.com/shorts/ABC123');
    
    // Download the actual video file
    $videoContent = file_get_contents($video['url']);
    file_put_contents('youtube_short.mp4', $videoContent);
    
    echo "Video saved as youtube_short.mp4\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
```

## ⚙️ Requirements

- PHP 7.4 or higher
- cURL extension enabled
- No Composer dependencies

## ⚠️ Limitations

This is a **basic scraper** with limitations:

- ❌ **Public videos only** – Cannot access private or unlisted Shorts
- ⏱️ **Rate limits** – YouTube may throttle frequent requests
- 🚫 **No authentication** – Cannot access age-restricted content
- 📉 **Fragile** – YouTube updates may break functionality
- 📊 **Limited metadata** – Cannot extract full analytics
- 💬 **No comments** – Does not extract comment data

### 🚀 Need More?

**For production use, unlimited downloads, full analytics, or commercial applications:**

👉 **[Instaboost YouTube Tools](https://instaboost.ge/en/youtube)** – Enterprise API with:
- ✅ Unlimited downloads without rate limits
- ✅ Full video analytics (views, likes, comments)
- ✅ Comment extraction and analysis
- ✅ Trending Shorts tracking
- ✅ Bulk download capabilities
- ✅ 99.9% uptime SLA
- ✅ Dedicated support

[**Learn more →**](https://instaboost.ge)

## 🔄 Related Projects

**YouTube tools:**
- **[YouTube Shorts Downloader (Python)](https://github.com/mikesmith-ge/youtube-shorts-downloader-python)** – Python version
- **[YouTube Shorts Downloader (Node.js)](https://github.com/mikesmith-ge/youtube-shorts-downloader-nodejs)** – JavaScript version

**Other platforms:**
- **[TikTok Downloader (PHP)](https://github.com/mikesmith-ge/tiktok-video-downloader-php)** – Extract TikTok videos
- **[TikTok Downloader (Node.js)](https://github.com/mikesmith-ge/tiktok-video-downloader-nodejs)** – TikTok in JavaScript
- **[Instagram Downloader (PHP)](https://github.com/mikesmith-ge/instagram-media-downloader-php)** – Instagram media
- **[Instagram Downloader (Python)](https://github.com/mikesmith-ge/instagram-media-downloader-python)** – Instagram in Python

[**See all tools →**](https://github.com/mikesmith-ge?tab=repositories)

## 📄 License

MIT License - see [LICENSE](LICENSE) file for details.

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Check the [issues page](../../issues).

## ⚡ Disclaimer

**Educational purposes only.** Scraping YouTube may violate their Terms of Service. Use responsibly and respect content creators' rights. For commercial use, always use official APIs or authorized services.

## 📧 Support

- 🐛 **Bug reports:** [Open an issue](../../issues)
- 💡 **Suggestions:** [Start a discussion](../../discussions)
- 🚀 **Enterprise needs:** [Visit Instaboost](https://instaboost.ge/en)

---

**Made with ❤️ by the Instaboost Team**
