<?php

/**
 Config for message to validation errors.
 Инпуты подставляются сами
 */

return [

	/*
	  Messsage for required
	 */
	'required' => 'не может быть пустым',

	/**
	 Message for min
	 */
	'min' => 'не может содержать символов меньше, чем ',

	/**
	 Message for max
	 */
	 'max' => 'не может содержать символов больше, чем ',

	 /**
	  Error message for Auth::attempt if have no user
	  */
	  'no_user_attempt' => 'Такого пользователя нету в базе данных',

	  /**
	   Error message for Auth::Attempt if not correct
	   */
	   'no_correct' => 'Неверно введены данные'
];