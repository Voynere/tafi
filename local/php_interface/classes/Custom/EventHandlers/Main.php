<?

namespace Custom\EventHandlers;

use Bitrix\Main\EventManager,
	Dompdf\Dompdf,
	Dompdf\Options;

class Main
{
	public static function init(): void
	{
		$eventManager = EventManager::getInstance();

		$eventManager->addEventHandler("main", "OnBeforeEventSend", [static::class, 'emailOfThePlacedOrder']);
	}

	public static function emailOfThePlacedOrder(&$arFields, &$arTemplate)
	{
		if ($arTemplate['EVENT_NAME'] == "SALE_NEW_ORDER") {


			$directory = '/upload/tmp/';
			$fileName = 'order_' . $arFields['ORDER_ID'] . '.pdf';
			$pathToFile = $directory . $fileName;

			$entityDirectory = new \Bitrix\Main\IO\Directory(\Bitrix\Main\Application::getDocumentRoot() . $directory);

			$options = new Options();
			$options->set('tempDir', $directory);
			$options->set('chroot', \Bitrix\Main\Application::getDocumentRoot());
			$dompdf = new Dompdf($options);

			$html = '';
			
			ob_start(); ?>

			<html lang="ru">

			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<style>
					body {
						font-family: "DejaVu Sans", sans-serif;
						font-size: 14px;
						color: #000;
					}
				</style>
			</head>

			<body>
				<table cellpadding="0" cellspacing="0" style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;" border="1" bordercolor="#d1d1d1">
					<tbody>
						<tr>
							<td height="83" bgcolor="#eaf3f5" style="border: none; padding-top: 23px; padding-right: 17px; padding-bottom: 24px; padding-left: 17px;">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td bgcolor="#ffffff" height="75" style="font-weight: bold; text-align: center; font-size: 26px; color: #0b3961;">
												Сеть медицинских лабораторий «ТАФИ – Диагностика»
											</td>
										</tr>
										<tr>
											<td bgcolor="#bad3df" height="11">
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;">
								<p style="margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;">
									Уважаемый(ая) <?= $arFields["ORDER_USER"] ?>
								</p>
								<p style="margin-top: 0; margin-bottom: 20px; line-height: 20px;">
									<br>
									Для Вас сформирован предварительный расчет стоимости исследований номер <?= $arFields["ORDER_ID"] ?>. Окончательное оформление производится при посещении сети медицинских лабораторий «ТАФИ-Диагностика».<br>

								<?= $arFields["OL_BASKET_TABLE"] ?>
								<?= $arFields["OL_USER_DESCRIPTION"] ?>
								</p>
								<br>
								<b>Стоимость заказа:</b> <?= $arFields["PRICE"] ?>.<br>
								</p>
								<h5>Ждем Вас в наших филиалах по адресам: </h5>
								<ul>
									• Владивосток, ул. Садовая, 25б,<br>
									• Владивосток, ул. Трамвайная, 14а,<br>
									• Владивосток, Океанский пр-т, 48а,<br>
									• Владивосток, ул. Новоивановская, 2б,<br>
									• Владивосток, пр. 100 лет Владивостоку, 60,<br>
									• Владивосток, ул. Сахалинская, 40а,<br>
									• Владивосток, ул. Казанская, 7,<br>
									• Владивосток, ул. Русская, 55а,<br>
									• Владивосток, ул. Нейбута, 8 г,<br>
									• Владивосток, ул. Калинина, 45,<br>
									• Владивосток, ул. Сочинская, 9 ,<br>
									• Владивосток, ул. Калинина, 283а,<br>
									• Трудовое, ул. Лермонтова, 68,<br>
									• Артём, ул. Кооперативная, 4,<br>
									• Уссурийск, ул. Пионерская,19,<br>
									• Находка, ул. Школьная, 2,<br>
									• Арсеньев, пр. Горького, 28,<br>
									• Славянка, ул. Героев Хасана, 9а,<br>
									• Большой Камень, ул. Маслакова, 10.<br>
								</ul>
								<p>
									Оплата производится наличными деньгами или банковской картой на месте. Не забудьте ознакомиться с <a href="http://tafimed.ru/help/">правилами подготовки</a> к сдаче анализов на нашем сайте.
								</p>
								<p>
									Если у Вас есть вопросы, мы с радостью на них ответим по номеру справочной службы: <br>
								</p>
								<h3><b><a href="tel:+74232425660">+7 (423) 242-56-60</a></b></h3>
								<p>
								</p>
								<p>
									С уважением,<br>
									Сеть медицинских лабораторий «ТАФИ-Диагностика»<br>
									E-mail: <a href="mailto:order@tafimed.ru"> order@tafimed.ru </a>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</body>

			</html>

<? $html = ob_get_clean();

			$dompdf->loadHtml($html);
			$dompdf->setPaper('A3', 'portrait');
			$dompdf->render();
			$output = $dompdf->output();

			if (!$entityDirectory->isExists()) $entityDirectory->createDirectory(\Bitrix\Main\Application::getDocumentRoot() . $directory);

			file_put_contents(\Bitrix\Main\Application::getDocumentRoot() . $pathToFile, $output);
			$fileArray = [
				'name' => $fileName,
				'size' => filesize(\Bitrix\Main\Application::getDocumentRoot() . $pathToFile),
				'tmp_name' => \Bitrix\Main\Application::getDocumentRoot() . $pathToFile,
				'type' => \CFile::GetContentType(\Bitrix\Main\Application::getDocumentRoot() . $pathToFile),
				'MODULE_ID' => 'main',
			];

			$fileId = \CFile::SaveFile($fileArray, 'pdf');

			unlink(\Bitrix\Main\Application::getDocumentRoot() . $pathToFile);

			$arTemplate['FILE'] = [$fileId];
		}
	}
}
