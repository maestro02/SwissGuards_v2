<?php namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\EquipmentModel;
use App\Models\MaterialModel;
use App\Models\SkillModel;
use App\Models\ToonModel;
use ReflectionException;

class SwgohGgCollector extends BaseController
{
	private string $ggUrl = 'https://swgoh.gg';
	private string $apiCharacters = 'https://swgoh.gg/api/characters/';
	private string $apiShips = 'https://swgoh.gg/api/ships/';

	private string $material = 'https://swgoh.gg/game-asset/m/';
	private string $skill = 'https://swgoh.gg/game-asset/a/';
	private string $equipment = 'https://swgoh.gg/game-asset/g/';
	private string $img = '.png';
	private string $assetsDirectory = __DIR__.'/../../../public/assets/';

	public function getImages()
	{
		$data[] = [];
		$this->getUnitGgData($this->apiCharacters);
		$this->getUnitGgData($this->apiShips);
		$this->getUnitImages();
		$this->getOtherImages('materials/', new MaterialModel(), $this->material);
		$this->getOtherImages('skills/', new SkillModel(), $this->skill);
		$this->getOtherImages('equipment/', new EquipmentModel(), $this->equipment);
		$data['result_en'] = 'en';
		$data['result_de'] = 'de';
		return view('welcome_message', $data);
	}

	private function getUnitGgData(string $url):void
	{
		$toon = new ToonModel();
		foreach ($this->fetchData($url) as $c) {
			$t = $toon->asObject()->find($c->base_id);
			if (!$t->ggImg === $this->ggUrl.$c->image) {
				try {
					$toon->update($t->baseId, ['ggImg' => $this->ggUrl.$c->image]);
				} catch (ReflectionException $e) {
					echo $e->getMessage();
				}
			}
		}
	}

	private function fetchData(string $url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	private function getUnitImages():void
	{
		$unitFilePath = 'units/';
		$toon = new ToonModel();
		$units = $toon->asObject()->findAll();

		foreach ($units as $u) {
			if ($u->ggImg) {
				$imagePath = $this->assetsDirectory.$unitFilePath.$u->baseId.$this->img;
				if (!file_exists($imagePath)) {
					file_put_contents($imagePath, file_get_contents($u->ggImg));
					try {
						$toon->update($u->baseId, ['image' => $imagePath]);
					} catch (ReflectionException $e) {
						echo $e->getMessage();
					}
				}
			}
		}
	}

	private function getOtherImages($localFilePath, $model, $type):void
	{
		foreach ($model->asObject()->findAll() as $ele) {
			$imagePath = $this->assetsDirectory.$localFilePath.$ele->id.$this->img;
			$url = $type.$ele->id;
			if (!file_exists($imagePath) && file_exists($url)) {
				$file = file_get_contents($url);
				if ($file) {
					file_put_contents($imagePath, $file);
					try {
						$model->update($ele->id, ['image' => $imagePath]);
					} catch (ReflectionException $e) {
						echo $e->getMessage();
					}
				}
			}
		}
	}
}