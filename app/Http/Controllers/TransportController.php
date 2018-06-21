<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transport;
use Response;

class TransportController extends Controller
{

	//Names
	protected $names = array(
		'автобус',
		'тролейбус',
		'маршрутка',
		'легковой автомобиль',
		'грузовик',
		'фура',
		'такси',
		'аэропоезд',
		'гравиплатформа',
		'флайер',
		'1000 летний сокол',
		'ракета',
		'танк'
	);

	//Directions
	protected $directions = array(
		'ул. Чайковскокго',
		'ул. Ленина',
		'созвездие орион',
		'планета уран',
		'Москва',
		'Санкт-Петербург',
		'переулок Тарковского',
		'Татуин',
		'ул. Хошимина',
		'Берлин',
		'Нью Йорк',
		'пр. Хана Соло',
		'Академия джедаев'
	);

	/**
	 * Get transports list.
	 *
	 * @return Response
	 */
	public function getTransports()
	{
		$transports = Transport::orderBy('created_at', 'asc')->get();

		return Response::json($transports);
	}


	/**
	 * Save transport in db.
	 *
	 * @param  Request $request
	 *
	 * @return Response
	 */
	public function saveTransport(Request $request)
	{
		$transport            = new Transport;
		$transport->name      = $request->input('name');
		$transport->direction = $request->input('direction');
		$transport->number    = $request->input('number');
		$transport->manual    = 1;
		$saved                = $transport->save();

		return $saved ? Response::json(array('status' => 'success', 'title' => 'Успешно', 'msg' => 'Транспорт успешно сохранен!'))
			: Response::json(array('status' => 'error', 'title' => 'Ошибка', 'msg' => 'Ошибка при сохранении транспорта!'));
	}


	/**
	 * Generate random transport.
	 *
	 * @return void
	 */
	public function generateTransport()
	{
		$transport            = new Transport;
		$transport->name      = $this->names[array_rand($this->names)];
		$transport->direction = $this->directions[array_rand($this->directions)];
		$transport->number    = rand(0, 1000);
		$transport->manual    = 0;
		$transport->save();
	}

	/**
	 * Delete old autogenerated transports.
	 *
	 * @return void
	 */
	public function deleteOldTransports()
	{
		Transport::where('manual', 0)
			->whereRaw('TIMESTAMPDIFF(MINUTE,created_at ,"' . date('Y-m-d H:i:s') . '") > 2')
			->delete();
	}
}