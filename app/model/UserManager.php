<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;


/**
 * Users management.
 */
final class UserManager implements Nette\Security\IAuthenticator
{
	use Nette\SmartObject;

	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'user_id',
		COLUMN_NAME = 'user_login',
		COLUMN_PASSWORD_HASH = 'user_key',
		// COLUMN_EMAIL = 'email',
		COLUMN_ROLE = 'user_role',
		COLUMN_DATEREGISTERED = 'user_dateregistered',
		COLUMN_DATELASTLOGIN = 'user_datelastlogin';


	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)
			->where(self::COLUMN_NAME, $username)
			->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update([
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			]);
		}

		$dateLastLogin = date('Y-m-d H:i:s');

		if ($row) {
			$this->database->table(self::TABLE_NAME)->where('user_login = ?', $username)->update([self::COLUMN_DATELASTLOGIN => $dateLastLogin]);
		} 

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		// return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);

		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return void
	 * @throws DuplicateNameException
	 */
	// public function add($username, $email, $password)
	public function add($username, $password)
	{
		// Nette\Utils\Validators::assert($email, 'email');

		$dateRegistered = date('Y-m-d H:i:s');

		try {
			$this->database->table(self::TABLE_NAME)->insert([
				self::COLUMN_NAME => $username,
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
				// self::COLUMN_EMAIL => $email,
				self::COLUMN_ROLE => '0',
				self::COLUMN_DATEREGISTERED => $dateRegistered,
				self::COLUMN_DATELASTLOGIN => $dateRegistered,
			]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}
}



class DuplicateNameException extends \Exception
{
}
