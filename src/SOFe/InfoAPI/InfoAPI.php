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

use Closure;

final class InfoAPI {
	private Graph $graph;

	private function __construct() {
		$this->graph = new Graph;
	}

	/**
	 * Register a child info for infos of type `$class`.
	 *
	 * The name should be a unique dot-delimited string with increasing specificness.
	 * It is recommended to use the format `plugin.info`
	 * (or `plugin.module.info` if the plugin has multiple modules),
	 * e.g. the money of a player from the `MultiEconomy` plugin
	 * can be written as `multieconomy.money`.
	 *
	 * It is advised that info names be as simple as possible and not to contain more than one word
	 * (except the plugin name part, which should just be the lowercase of their exact name).
	 * In the case that it is inevitable (plugin names),
	 * names should be registered in the `camelCase` format.
	 * However, infos are matched case-insensitively,
	 * so `fooBar` and `foobar` are still the same name.
	 *
	 * @template P of Info
	 * @template C of Info
	 * @phpstan-param class-string<P>    $parent  The parent info class that this child can be resolved from.
	 * @phpstan-param class-string<C>    $child   The child info class resolved into.
	 * @phpstan-param string             $fqn     The fully-qualified, dot-separated name of this child info.
	 * @phpstan-param Closure(P): C|null $resolve A closure to resolve the parent info into a child info,
	 *                                            or `null` if not available for that instance.
	 */
	static public function provideInfo(string $parent, string $fqn, Closure $resolve) : void {
		// TODO implement
	}

	/**
	 * Registers a fallback info for infos of type `$class`.
	 *
	 * If a template writes `{foo bar}`, but `bar` is not found in `foo` (`FooInfo`),
	 * InfoAPI will resort to searching `bar` in each fallback info of `FooInfo`.
	 * Furthermore, if a fallback info has its own fallback info,
	 * the fallback-fallback info will be transitively searched on.
	 * The search follows a depth-first order,
	 * and fallbacks of the same type are resolved in the order they are registered.
	 *
	 * `ChildInfo` should only be the fallback of `ParentInfo` if this is intended by
	 * the plugin that declares `ParentInfo`
	 * (or the plugin that declares `ChildInfo`, although this is discouraged).
	 * Plugins adding fallback info should be aware of possible infinite recursion
	 * if a loop in fallbacks is detected.
	 *
	 * @template P of Info
	 * @template C of Info
	 * @phpstan-param class-string<P>    $parent  The parent info class that this child can be resolved from.
	 * @phpstan-param class-string<C>    $child   The child info class resolved into.
	 * @phpstan-param Closure(P): C|null $resolve A closure to resolve the parent info into a child info,
	 *                                            or `null` if not available for that instance.
	 */
	static public function provideFallback(string $class, Closure $resolve) : void {
		// TODO implement
	}

	// SINGLETON BOILERPLATE //
	/* {{{ */
	private static ?InfoAPI $instance = null;

	static private function getInstance() : InfoAPI {
		return self::$instance = self::$instance ?? new self;
	}
	/* }}} */
}
