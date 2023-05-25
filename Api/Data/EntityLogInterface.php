<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Api\Data;

interface EntityLogInterface
{
    /**
     * String constants for property names
     */
    public const LOG_ENTITY_TYPE = "log_entity_type";
    public const LOG_ENTITY_ID = "log_entity_id";
    public const LOG_TYPE = "log_type";
    public const LOG_TEXT = "log_text";

    /**
     * Getter for EntityType.
     *
     * @return string|null
     */
    public function getLogEntityType(): ?string;

    /**
     * Setter for EntityType.
     *
     * @param string|null $logEntityType
     *
     * @return void
     */
    public function setLogEntityType(?string $logEntityType): void;

    /**
     * Getter for LogType.
     *
     * @return string
     */
    public function getLogType(): string;

    /**
     * Setter for LogType.
     *
     * @param string $logType
     *
     * @return void
     */
    public function setLogType(string $logType): void;

    /**
     * Getter for LogEntityId.
     *
     * @return string
     */
    public function getLogEntityId(): ?string;

    /**
     * Setter for LogEntityId.
     *
     * @param string|null $logEntityId
     *
     * @return void
     */
    public function setLogEntityId(?string $logEntityId): void;

    /**
     * Getter for LogText.
     *
     * @return string
     */
    public function getLogText(): string;

    /**
     * Setter for LogText.
     *
     * @param string $logText
     *
     * @return void
     */
    public function setLogText(string $logText): void;
}
