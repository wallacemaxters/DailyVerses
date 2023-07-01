
<?php

use WallaceMaxters\DailyVerses\Verse;
use WallaceMaxters\DailyVerses\Version;

class VerseTest extends \PHPUnit\Framework\TestCase
{ 
    public function testOfTheDay()
    {
        $result = Verse::ofTheDay(Version::ARC);

        $this->assertArrayHasKey('text', $result);
        $this->assertArrayHasKey('verse', $result);
        $this->assertArrayHasKey('href', $result);
    }

    public function testRandom()
    {
        $result = Verse::random(Version::ARC);

        $this->assertArrayHasKey('text', $result);
        $this->assertArrayHasKey('verse', $result);
        $this->assertArrayHasKey('href', $result);
    }
}