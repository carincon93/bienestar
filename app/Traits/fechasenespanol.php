<?php 
namespace App\Traits;

use Jenssengers\Date\Date;

trait DateTranslator
{
	public function getCreatedAtrribute($created_at)
	{
		return new Date($created_at);
	}
	public function getUpdatedAtrribute($updated_at)
	{
		return new Date($updated_at);
	}
	public function getDeletedAtrribute($deleted_at)
	{
		return new Date($deleted_at);
	}
	public function getDateAtrribute($fecha)
	{
		return new Date($fecha);
	}
}