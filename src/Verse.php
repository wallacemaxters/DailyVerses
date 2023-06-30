<?php

namespace WallaceMaxters\DailyVerses;

use DOMDocument;

/**
 * @version 
 * 	$url = 'http://dailyverses.net/get/verse?language=' . $language . '&date=' . $bibleVerseOfTheDay_currentDate . '&url=' . $_SERVER['HTTP_HOST'] . '&type=daily2_7_4';
 */
class Verse 
{   
   const BASE_URL = 'https://dailyverses.net/get';

   /**
    * @param string $language
    * @return array
    */
   public static function ofTheDay(Version $language)
   {

      return static::fetch(static::getUrl('verse', ['language' => $language->name]));
   }

   /**
    * @param string $language
    * @return array
    */
   public static function random($language)
   {
      return static::fetch(
         static::getUrl('random', compact('language'))
      );
   }


   /**
    * @param string $url
    * @return array
    */
   protected static function fetch(string $url): array
   {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $url);
      $result = curl_exec($ch);
      curl_close($ch);

      $dom = new DOMDocument('1.0', 'utf-8');
      @$dom->loadHTML($result);

      return [
         'verse' => $dom->getElementsByTagName('a')[0]->textContent,
         'text'  => $dom->getElementsByTagName('div')[0]->textContent
      ];
   }

   /**
    * @param string $language
    * @return string
    */
   protected static function getUrl(string $path, array $query = []): string
   {
      return static::BASE_URL . '/' . $path . '?' . http_build_query($query);
   }
}
