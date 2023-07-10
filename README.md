# WallaceMaxters/Dailyverses
A PHP package to retrieve bible verses from [dailyverses.net](https://dailyverses.net/).

## Instalation

```bash
composer require wallacemaxters/dailyverses
```

## Usage
```php
use WallaceMaxters\DailyVerses\Verse;
use WallaceMaxters\DailyVerses\Version;

$result = Verse::ofTheDay(Version::NIV);

echo $result['text;
echo $result['verse'];
echo $result['href'];
```

The output is:

```
Come to me, all you who are weary and burdened, and I will give you rest.
Matthew 11:28
https://dailyverses.net/matthew/11/28
```
