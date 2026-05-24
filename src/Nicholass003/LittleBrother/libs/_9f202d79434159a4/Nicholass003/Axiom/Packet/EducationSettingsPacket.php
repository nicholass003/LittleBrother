<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Education\EducationSettingsAgentCapabilities;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Education\EducationSettingsExternalLinkSettings;

final class EducationSettingsPacket implements Packet{

    public const ID = PacketIds::EDUCATION_SETTINGS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $codeBuilderDefaultUri;
    public string $codeBuilderTitle;
    public bool $canResizeCodeBuilder;
    public bool $disableLegacyTitleBar;
    public string $postProcessFilter;
    public string $screenshotBorderResourcePath;
    public ?EducationSettingsAgentCapabilities $agentCapabilities;
    public ?string $codeBuilderOverrideUri;
    public bool $hasQuiz;
    public ?EducationSettingsExternalLinkSettings $linkSettings;
}