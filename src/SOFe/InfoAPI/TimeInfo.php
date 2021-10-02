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

use function date;

final class TimeInfo extends Info {
	private float $value;

	public function __construct(float $value) {
		$this->value = $value;
	}

	static public function getInfoType() : string {
		return "time";
	}

	static public function init(?InfoAPI $api) : void {
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.year",
			fn($info) => new NumberInfo((float)date("Y", $info->getValue())),
			$api)
			->setMetadata("description", "The year part of a date")
			->setMetadata("example", "2006");
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.month",
			fn($info) => new NumberInfo((float)date("m", $info->getValue())),
			$api)
			->setMetadata("description", "The month part of a date")
			->setMetadata("example", "1");
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.date",
			fn($info) => new NumberInfo((float)date("d", $info->getValue())),
			$api)
			->setMetadata("description", "The date part of a date")
			->setMetadata("example", "2");
		InfoAPI::provideInfo(self::class, StringInfo::class, "infoapi.time.weekday",
			fn($info) => new StringInfo(date("D", $info->getValue())),
			$api)
			->setMetadata("description", "The weekday part of a date")
			->setMetadata("example", "Thu");
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.hour",
			fn($info) => new NumberInfo((float)date("H", $info->getValue())),
			$api)
			->setMetadata("description", "The hour part of a time")
			->setMetadata("example", "15");
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.minute",
			fn($info) => new NumberInfo((float)date("i", $info->getValue())),
			$api)
			->setMetadata("description", "The minute part of a time")
			->setMetadata("example", "4");
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.second",
			fn($info) => new NumberInfo((float)date("s", $info->getValue())),
			$api)
			->setMetadata("description", "The second part of a time")
			->setMetadata("example", "5");
/*		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.elapsed",
			fn($info) => new StringInfo(date("H", $info->getValue())),
			$api)
			->setMetadata("description", "The hour part of a time");
		InfoAPI::provideInfo(self::class, NumberInfo::class, "infoapi.time.remaining",
			fn($info) => new StringInfo(date("H", $info->getValue())),
			$api)
			->setMetadata("description", "The hour part of a time");*/
	}

	public function getValue() : float {
		return $this->value;
	}

	public function toString() : string {
		return date("Y-m-d H:i:s", $i = (int)$this->value) . "." . substr((string)($this->value - $i), 2);
	}
}