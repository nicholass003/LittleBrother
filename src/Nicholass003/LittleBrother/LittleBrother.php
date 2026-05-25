<?php

/*
 * Copyright (c) 2024 - present nicholass003
 *        _      _           _                ___   ___ ____
 *       (_)    | |         | |              / _ \ / _ \___ \
 *  _ __  _  ___| |__   ___ | | __ _ ___ ___| | | | | | |__) |
 * | '_ \| |/ __| '_ \ / _ \| |/ _` / __/ __| | | | | | |__ <
 * | | | | | (__| | | | (_) | | (_| \__ \__ \ |_| | |_| |__) |
 * |_| |_|_|\___|_| |_|\___/|_|\__,_|___/___/\___/ \___/____/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  nicholass003
 * @link    https://github.com/nicholass003/
 *
 *
 */

declare(strict_types=1);

namespace Nicholass003\LittleBrother;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\bStats\PocketmineMp\Metrics;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\CortexPE\Commando\PacketHooker;
use Nicholass003\LittleBrother\Command\ProtocolCommand;
use Nicholass003\LittleBrother\Convert\BedrockDataManager;
use Nicholass003\LittleBrother\Convert\Block\ChunkTranslator;
use Nicholass003\LittleBrother\Convert\Block\RuntimeBlockMapper;
use Nicholass003\LittleBrother\Convert\Item\ItemRuntimeIdMapper;
use Nicholass003\LittleBrother\Protocol\ProtocolStorage;
use Nicholass003\LittleBrother\Protocol\Translator\PacketBatchTranslator;
use Nicholass003\LittleBrother\Protocol\Translator\PacketTranslator;
use Nicholass003\LittleBrother\Utils\Debugger;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use function dirname;

class LittleBrother extends PluginBase{
	use SingletonTrait;

	public const IS_DEVELOPMENT = true;

	private ProtocolStorage $protocolStorage;
	private PacketTranslator $translator;
	private ChunkTranslator $chunkTranslator;
	private BedrockDataManager $bedrockDataManager;
	private ItemRuntimeIdMapper $itemRuntimeIdMapper;
	private PacketBatchTranslator $packetBatchTranslator;
	private RuntimeBlockMapper $runtimeBlockMapper;

	public bool $isDebugEnabled = false;
	public bool $isLogEnabled = false;

	protected function onLoad() : void{
		Debugger::clear();
		$this->saveDefaultConfig();
	}

	protected function onEnable() : void{
		self::setInstance($this);
		$this->registerCommands();

		$this->isDebugEnabled = $this->getConfig()->get('enable-debug', false);
		$this->isLogEnabled = $this->getConfig()->get('enable-log', false);

		$this->bedrockDataManager = new BedrockDataManager(
			dirname(__DIR__, 3) . '/resources/data/'
		);

		$this->runtimeBlockMapper = new RuntimeBlockMapper(
			$this->bedrockDataManager
		);

		$this->itemRuntimeIdMapper = new ItemRuntimeIdMapper(
			$this->bedrockDataManager
		);

		$this->chunkTranslator = new ChunkTranslator(
			$this->runtimeBlockMapper
		);

		$this->translator = new PacketTranslator($this);

		$this->protocolStorage = new ProtocolStorage();
		$this->packetBatchTranslator = new PacketBatchTranslator($this->translator);

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

		(new Metrics($this, 30103));
	}

	private function registerCommands() : void{
		if(!PacketHooker::isRegistered()){
			PacketHooker::register($this);
		}

		$commandMap = $this->getServer()->getCommandMap();
		$commandMap->register(
			'little_brother',
			new ProtocolCommand($this, 'protocol', 'Protocol Description')
		);
	}

	public function getProtocolStorage() : ProtocolStorage{ return $this->protocolStorage; }
	public function getTranslator() : PacketTranslator{ return $this->translator; }
	public function getChunkTranslator() : ChunkTranslator{ return $this->chunkTranslator; }
	public function getBedrockDataManager() : BedrockDataManager{ return $this->bedrockDataManager; }
	public function getItemRuntimeIdMapper() : ItemRuntimeIdMapper{ return $this->itemRuntimeIdMapper; }
	public function getPacketBatchTranslator() : PacketBatchTranslator{ return $this->packetBatchTranslator; }
	public function getRuntimeBlockMapper() : RuntimeBlockMapper{ return $this->runtimeBlockMapper; }
}