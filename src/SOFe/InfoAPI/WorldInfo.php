<?php

/*
 * InfoAPI
 *
 * Copyright (C) 2019-2021 SOFe
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace SOFe\InfoAPI;

use pocketmine\world\World;

final class WorldInfo extends Info {
	private World $value;

	public function __construct(World $value) {
		$this->value = $value;
	}

	public function getValue() : World {
		return $this->value;
	}

	public function toString() : string {
		return $this->value->getFolderName();
	}

	public function getInfoType() : string {
		return "position";
	}

	static public function init(?InfoAPI $api) : void {
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.world.name",
			fn($info) => $info->getValue()->getFolderName(),
			$api);
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.world.folderName",
			fn($info) => $info->getValue()->getFolderName(),
			$api);
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.world.customName",
			fn($info) => $info->getValue()->getDisplayName(),
			$api);
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.world.displayName",
			fn($info) => $info->getValue()->getDisplayName(),
			$api);
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.world.time",
			fn($info) => $info->getValue()->getTime(),
			$api);
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.world.seed",
			fn($info) => $info->getValue()->getSeed(),
			$api);
	}
}