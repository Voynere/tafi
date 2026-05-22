<?
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;
use \Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;
use \Bitrix\Main\Web\Uri;

Loader::registerAutoLoadClasses('shestpa.lastmodified', array(
	'Shestpa\Lastmodified\PagesTimestampTable' => 'lib/PagesTimestampTable.php',
	'Shestpa\Lastmodified\PagesBufferPurifier' => 'lib/PagesBufferPurifier.php'
));

EventManager::getInstance()->addEventHandler('main', 'OnEndBufferContent', function ($content) {
	$request = Application::getInstance()->getContext()->getRequest();
	$uri = new Uri($request->getRequestUri());
	$url = $uri->getPath();
	if (!isCli() && !$request->isAdminSection() && !defined('ERROR_404') && !$request->isPost() && !$request->isAjaxRequest()) {

		global $USER, $APPLICATION;
		$page = $APPLICATION->GetCurPage();
		$arGroups = $USER->GetUserGroupArray();

		Shestpa\Lastmodified\PagesBufferPurifier::deleteKernelJs($content);
		Shestpa\Lastmodified\PagesBufferPurifier::deleteKernelCss($content);

		// Доработать этот метод, задумка в том, что на некоторых проектах есть динамический контент, который постоянно будет обновлять Last-Modified.
		// Необходимо в админке создать страницу, куда можно будет вписывать регулярные выражения, классы элементов или просто строки, которые необходимо вырезать из страницы и тольк потом формировать хеш.

		//Shestpa\Lastmodified\PagesBufferPurifier::regularExpressionsCustomExpressions($content);

		if ($url == "/catalog/") {
			// Получал всю страницу в виде строки и потом сравнивал, например через WinMerge
			//Debug::dumpToFile($content);
			//Debug::dumpToFile('=======================');
		}

		$hash = md5($content);

		$pageHash = md5($page . implode('', $arGroups));

		$lastModified = time();
		$date = gmdate('D, d M Y H:i:s T', $lastModified);

		try {
			$res = Shestpa\Lastmodified\PagesTimestampTable::getList(
				array(
					'filter' => array('URL' => $pageHash)
				)
			)->fetch();

			if (!$res): // No hash in DB
				Shestpa\Lastmodified\PagesTimestampTable::add(
					array(
						"URL" => $pageHash,
						"LAST_MODIFIED" => $date,
						"HASH" => $hash
					)
				);

				$status = 'added';

			else:
				if ($res['HASH'] == $hash): // Not modified
					$date = $res['LAST_MODIFIED'];
					$lastModified = strtotime($res['LAST_MODIFIED']);
					$status = 'notmod';
				else: // Modified
					Shestpa\Lastmodified\PagesTimestampTable::update(
						$res['ID'],
						array(
							"LAST_MODIFIED" => $date,
							"HASH" => $hash
						)
					);
					$status = 'mod';
				endif;
			endif;

			// Старый заголовок для кеширования в http /1.0 - https://developer.mozilla.org/ru/docs/Web/HTTP/Reference/Headers/Pragma
			//header_remove('Pragma');

			// Современный заголовок для управления кешированием  - https://developer.mozilla.org/ru/docs/Web/HTTP/Reference/Headers/Cache-Control
			//header('Cache-Control: private, max-age=0, must-revalidate');
			//header('Cache-Control: public, max-age=0, must-revalidate');

			header('Last-Modified: ' . $date);
			if ($lastModified) {
				$arr = apache_request_headers();

				if ($url == "/catalog/") {
					// Искал заголовок 'If-Modified-Since'
					//Debug::dumpToFile($arr);
					//Debug::dumpToFile('=======================');
				}

				foreach ($arr as $header => $value) {
					if ($header == 'If-Modified-Since' || $header == 'if-modified-since') {
						$ifModifiedSince = strtotime($value);
						if ($ifModifiedSince >= $lastModified) {
							$GLOBALS['APPLICATION']->RestartBuffer();
							CHTTP::SetStatus('304 Not Modified');
						}
					}
				}
			}

			header('Hash-Modified: ' . $status . $hash);
		} catch (Exception $e) {
		}
	}
});
