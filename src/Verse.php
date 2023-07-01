<?php

namespace WallaceMaxters\DailyVerses;

use DOMDocument;

/**
 * A small wrapper for dailyverses.net 
 * 
 * @author Wallace Vizerra<wallacemaxters@gmail.com>
 */
class Verse 
{   
   const BASE_URL = 'https://dailyverses.net/get';

   public static function ofTheDay(Version $version)
   {
      return static::fetch(static::getUrl('verse', ['language' => $version->name]));
   }

   public static function random(Version $version, ?int $random = null)
   {
      return static::fetch(
         static::getUrl('random', [
            'language' => $version->name, 
            'ramdom'   => $random
         ])
      );
   }

   protected static function fetch(string $url): array
   {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $url);
      $html = curl_exec($ch);
      curl_close($ch);

      $dom = new DOMDocument('1.0', 'utf-8');

      @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

      $verse = $dom->getElementsByTagName('a')[0];

      return [
         'href'  => $verse->getAttribute('href'),
         'verse' => $verse->textContent,
         'text'  => $dom->getElementsByTagName('div')[0]->textContent
      ];
   }

   protected static function getUrl(string $path, array $query = []): string
   {
      return static::BASE_URL . '/' . $path . '?' . http_build_query($query);
   }
}
