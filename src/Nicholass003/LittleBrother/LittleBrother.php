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

use Nicholass003\LittleBrother\libs\_d717aa2a05f5ccd4\CortexPE\Commando\PacketHooker;
use Nicholass003\LittleBrother\Cache\OutboundPacketCache;
use Nicholass003\LittleBrother\Command\ProtocolCommand;
use Nicholass003\LittleBrother\Convert\BedrockDataManager;
use Nicholass003\LittleBrother\Convert\Block\BlockRuntimeIdMapper;
use Nicholass003\LittleBrother\Convert\Block\ChunkTranslator;
use Nicholass003\LittleBrother\Convert\Item\ItemRuntimeIdMapper;
use Nicholass003\LittleBrother\Protocol\ProtocolStorage;
use Nicholass003\LittleBrother\Protocol\Translator\ManualPacketRegistry;
use Nicholass003\LittleBrother\Protocol\Translator\PacketTranslator;
use Nicholass003\LittleBrother\Protocol\Translator\RuntimePacketRegistry;
use Nicholass003\LittleBrother\Schema\SchemaCompiler;
use Nicholass003\LittleBrother\Schema\SchemaRegistry;
use Nicholass003\LittleBrother\Schema\SchemaTranslator;
use Nicholass003\LittleBrother\Types\CommonTypesAdapter;
use Nicholass003\LittleBrother\Types\PrimitiveTypes;
use Nicholass003\LittleBrother\Types\TypeRegistry;
use Nicholass003\LittleBrother\Types\TypeRegistryFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\SingletonTrait;
use Shared\Nicholass003\LittleBrother\Schemas;
use function dirname;

class LittleBrother extends PluginBase{
	use SingletonTrait;

	private ProtocolStorage $protocolStorage;
	private PacketTranslator $translator;
	private OutboundPacketCache $cache;
	private TypeRegistryFactory $typeRegistryFactory;
	private SchemaRegistry $schemaRegistry;
	private ChunkTranslator $chunkTranslator;
	private BedrockDataManager $bedrockDataManager;
	private BlockRuntimeIdMapper $blockRuntimeIdMapper;
	private ItemRuntimeIdMapper $itemRuntimeIdMapper;

	protected function onEnable() : void{
		self::setInstance($this);
		$this->registerCommands();

		$this->bedrockDataManager = new BedrockDataManager(
			dirname(__DIR__, 3) . '/resources/data/'
		);

		$this->blockRuntimeIdMapper = new BlockRuntimeIdMapper(
			$this->bedrockDataManager
		);

		$this->itemRuntimeIdMapper = new ItemRuntimeIdMapper(
			$this->bedrockDataManager
		);

		$baseRegistry = new TypeRegistry();
		PrimitiveTypes::register($baseRegistry);
		CommonTypesAdapter::register($baseRegistry);

		$this->typeRegistryFactory = new TypeRegistryFactory(
			$baseRegistry,
			$this->blockRuntimeIdMapper,
			$this->itemRuntimeIdMapper
		);

		$this->schemaRegistry = new SchemaRegistry(new SchemaCompiler());
		$this->schemaRegistry->loadSchemas(Schemas::getSchemas());

		$this->chunkTranslator = new ChunkTranslator(
			$this->blockRuntimeIdMapper
		);

		$this->translator = new PacketTranslator(
			new SchemaTranslator($this->typeRegistryFactory, $this->schemaRegistry),
			new ManualPacketRegistry(),
			new RuntimePacketRegistry(),
			$this
		);

		$this->protocolStorage = new ProtocolStorage();
		$this->cache = new OutboundPacketCache();

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getScheduler()->scheduleRepeatingTask(
			new ClosureTask(fn() => $this->cache->clear()), 20
		);
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
	public function getCache() : OutboundPacketCache{ return $this->cache; }
	public function getTypeRegistryFactory() : TypeRegistryFactory{ return $this->typeRegistryFactory; }
	public function getSchemaRegistry() : SchemaRegistry{ return $this->schemaRegistry; }
	public function getChunkTranslator() : ChunkTranslator{ return $this->chunkTranslator; }
	public function getBedrockDataManager() : BedrockDataManager{ return $this->bedrockDataManager; }
	public function getBlockRuntimeIdMapper() : BlockRuntimeIdMapper{ return $this->blockRuntimeIdMapper; }
	public function getItemRuntimeIdMapper() : ItemRuntimeIdMapper{ return $this->itemRuntimeIdMapper; }
}