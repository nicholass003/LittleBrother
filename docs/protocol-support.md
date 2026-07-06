# Protocol Support

This document describes the Minecraft Bedrock protocol versions currently supported by **LittleBrother**.

LittleBrother provides a runtime-based protocol translation layer that allows clients using different Bedrock protocol versions to connect to servers running the native PocketMine-MP protocol.

> [!WARNING]
> Protocol translation support is **experimental**. The runtime translation system is still under active development and compatibility may vary between releases.

---

## Current Server Protocol

| Protocol | Minecraft Version | Notes                         |
| -------- | ----------------- | ----------------------------- |
| 1001      | 1.26.30          | Native PocketMine-MP protocol |

The native protocol corresponds to the version used by the running PocketMine-MP server.

---

## Experimental Translation Support

| Protocol | Minecraft Version | Status                   |
| -------- | ----------------- | ------------------------ |
| 975      | 1.26.20           | Supported                |
| 944      | 1.26.10           | Supported                |
| 924      | 1.26.0            | Supported                |
| 898      | 1.21.130          | Supported                |
| 860      | 1.21.120          | Supported                |
| 844      | 1.21.110          | Supported                |

Experimental protocols may not support all packets, gameplay systems, or runtime mappings. Issues such as desync, visual glitches, missing interactions, or packet incompatibilities may still occur.

---

## Notes

* Translation is now implemented using the **Axiom runtime codec architecture**.
* The previous schema-driven translation pipeline has been deprecated and removed.
* Packet translation is handled dynamically at runtime using protocol-aware codecs and translators.
* Some packets still require **manual translation handlers** where automatic runtime translation is insufficient.
* Runtime block and item mappings may vary between protocol versions.
* Compatibility depends heavily on gameplay features, packet structure differences, and runtime ID changes between versions.

---

## Architecture Overview

LittleBrother is currently transitioning toward a long-term multi-version infrastructure powered by the internal **Axiom** runtime system.

The new runtime architecture focuses on:

* reducing protocol-specific duplication
* improving maintainability of translators
* simplifying protocol upgrades
* supporting scalable multi-version compatibility

This architecture is still evolving and may change significantly between alpha releases.

---

## Future Support

Additional protocol versions will continue to be supported as the runtime translation system matures.

Long-term goals include:

* broader Bedrock protocol coverage
* improved runtime mapping stability
* better gameplay synchronization across versions
* reduced manual packet translation requirements

---

## Related Documentation

* Changelog:
  [`changelogs/index.md`](../changelogs/index.md)

* Project Repository:
  https://github.com/nicholass003/LittleBrother
