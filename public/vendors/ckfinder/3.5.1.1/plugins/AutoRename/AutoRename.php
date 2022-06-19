<?php

namespace CKSource\CKFinder\Plugin\AutoRename;

use CKSource\CKFinder\CKFinder;
use CKSource\CKFinder\Event\BeforeCommandEvent;
use CKSource\CKFinder\Event\CKFinderEvent;
use CKSource\CKFinder\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use voku\helper\ASCII;

class AutoRename implements PluginInterface, EventSubscriberInterface
{
	protected $app;
	
	public function setContainer(CKFinder $app)
	{
		$this->app = $app;
	}
	
	public function getDefaultConfig()
	{
		return [];
	}
	
	public function onBeforeUpload(BeforeCommandEvent $event)
	{
		$request = $event->getRequest();
		$uploadedFile = $request->files->get('upload');
		$workingFolder = $this->app['working_folder'];
		if($uploadedFile)
		{
			$uploadedFileName = $uploadedFile->getClientOriginalName();
			$basename = pathinfo($uploadedFileName, PATHINFO_FILENAME);
			$extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
			while(true)
			{
				$uploadedFileName = static::slugFileName($basename) . '.' . strtolower($extension);
				if(!$workingFolder->containsFile($uploadedFileName))
				{
					break;
				}
			}
			$setOriginalName = function(UploadedFile $file, $newFileName)
			{
				$file->originalName = $newFileName;
			};
			$setOriginalName = \Closure::bind($setOriginalName, null, $uploadedFile);
			$setOriginalName($uploadedFile, $uploadedFileName);
		}
	}
	
	public static function getSubscribedEvents()
	{
		return [CKFinderEvent::BEFORE_COMMAND_FILE_UPLOAD => 'onBeforeUpload'];
	}
	
	public static function slugFileName($title, $separator = '-', $language = 'en')
	{
		$title = $language ? static::ascii($title, $language) : $title;
		
		// Convert all dashes/underscores into separator
		$flip = $separator === '-' ? '_' : '-';
		
		$title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);
		
		// Replace @ with the word 'at'
		$title = str_replace('@', $separator.'at'.$separator, $title);
		
		// Remove all characters that are not the separator, letters, numbers, or whitespace.
		$title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', static::lower($title));
		
		// Replace all separator characters and whitespace by a single separator
		$title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);
		
		return trim($title, $separator);
	}
	
	public static function ascii($value, $language = 'en')
    {
		require_once __DIR__ . "/ASCII/ASCII.php";
        return ASCII::to_ascii((string) $value, $language);
    }
	
	public static function lower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }
}