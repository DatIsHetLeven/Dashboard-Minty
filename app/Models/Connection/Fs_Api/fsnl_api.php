<?php

namespace App\Models\Connection\Fs_API;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/*
 *   FactuurSturen.nl, FactuurSturen.be, DigiRechnung.de API connector
 *
 *   This class will help you connecting to our API. It's a little shell based around cURL.
 *
 *   API Version: v1
 *   Read our documentation for more help with this file:
 *   https://www.factuursturen.nl/docs/api_v1.pdf
 *
 *   There are several examples in the documentation to help you getting started.
 *
 *   Happy coding and if you experience strange behaviour or if you're
 *   stuck, drop us a line at support@factuursturen.nl
 *
 */

class fsnl_api
{
	protected $url;
	protected $verb;
	protected $requestBody;
	protected $requestLength;
	protected $username;
	protected $password;
	protected $acceptType;
	protected $responseBody;
	protected $responseInfo;

	public function __construct ($url = null, $verb = 'GET', $requestBody = null)
	{
		$this->url				= $url;
		$this->verb				= $verb;
		$this->requestBody		= $requestBody;
		$this->requestLength	= 0;
		$this->username			= null;
		$this->password			= null;
		$this->acceptType		= 'application/json';
		$this->responseBody		= null;
		$this->responseInfo		= null;

		if ($this->requestBody !== null)
		{
			$this->buildPostBody();
		}
	}

	public function flush ()
	{
		$this->requestBody		= null;
		$this->requestLength	= 0;
		$this->verb				= 'GET';
		$this->responseBody		= null;
		$this->responseInfo		= null;
	}

	public function execute ()
	{
		$ch = curl_init();
		$this->setAuth($ch);

		try
		{
			switch (strtoupper($this->verb))
			{
				case 'GET':
					$this->executeGet($ch);
					break;
				case 'POST':
					$this->executePost($ch);
					break;
				case 'PUT':
					$this->executePut($ch);
					break;
				case 'DELETE':
					$this->executeDelete($ch);
					break;
				default:
					throw new InvalidArgumentException('Current verb (' . $this->verb . ') is an invalid REST verb.');
			}
		}
		catch (InvalidArgumentException $e)
		{
			curl_close($ch);
			throw $e;
		}
		catch (Exception $e)
		{
			curl_close($ch);
			throw $e;
		}

	}

	public function buildPostBody ($data = null)
	{
		$data = ($data !== null) ? $data : $this->requestBody;

		if (!is_array($data))
		{
			throw new InvalidArgumentException('Invalid data input for postBody.  Array expected');
		}

		$data = http_build_query($data, '', '&');
		$this->requestBody = $data;
	}

	protected function executeGet ($ch)
	{
		$this->doExecute($ch);
	}

	protected function executePost ($ch)
	{
		if (!is_string($this->requestBody))
		{
			$this->buildPostBody();
		}

		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestBody);
		curl_setopt($ch, CURLOPT_POST, 1);

		$this->doExecute($ch);
	}

	protected function executePut ($ch)
	{
		if (!is_string($this->requestBody))
		{
			$this->buildPostBody();
		}

		$this->requestLength = strlen($this->requestBody);

		$fh = fopen('php://memory', 'rw');
		fwrite($fh, $this->requestBody);
		rewind($fh);

		curl_setopt($ch, CURLOPT_INFILE, $fh);
		curl_setopt($ch, CURLOPT_INFILESIZE, $this->requestLength);
		curl_setopt($ch, CURLOPT_PUT, true);

		$this->doExecute($ch);

		fclose($fh);
	}

	protected function executeDelete ($ch)
	{
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

		$this->doExecute($ch);
	}

	protected function doExecute (&$curlHandle)
	{
		$this->setCurlOpts($curlHandle);
		$this->responseBody = curl_exec($curlHandle);
		$this->responseInfo	= curl_getinfo($curlHandle);

		curl_close($curlHandle);
	}

	protected function setCurlOpts (&$curlHandle)
	{
		curl_setopt($curlHandle, CURLOPT_TIMEOUT, 10);
		curl_setopt($curlHandle, CURLOPT_URL, $this->url);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array ('Accept: ' . $this->acceptType));
	}

	protected function setAuth (&$curlHandle)
	{
		if ($this->username !== null && $this->password !== null)
		{
			curl_setopt($curlHandle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curlHandle, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		}
	}

	public function getAcceptType ()
	{
		return $this->acceptType;
	}

	public function setAcceptType ($acceptType)
	{
		$this->acceptType = $acceptType;
	}

	public function getPassword ()
	{
		return $this->password;
	}

	public function setPassword ($password)
	{
		$this->password = $password;
	}

	public function getResponseBody ()
	{
		return $this->responseBody;
	}

	public function getResponseInfo ()
	{
		return $this->responseInfo;
	}

	public function getUrl ()
	{
		return $this->url;
	}

	public function setUrl ($url)
	{
		$this->url = $url;
	}

	public function getUsername ()
	{
		return $this->username;
	}

	public function setUsername ($username)
	{
		$this->username = $username;
	}

	public function getVerb ()
	{
		return $this->verb;
	}

	public function setVerb ($verb)
	{
		$this->verb = $verb;
	}
}
