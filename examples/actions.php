<?php

// Include FML
require_once __DIR__ . '/../autoload.php';

// Create ManiaLink
$maniaLink = new \FML\ManiaLink();

// Static action via xml
$homeLabel = new \FML\Controls\Label();
$maniaLink->add($homeLabel);
$homeLabel->setX(-10);
$homeLabel->setText('Home');
$homeLabel->setAction(\FML\Types\Actionable::ACTION_HOME);

// Dynamic action via script
$enterLabel = new \FML\Controls\Label();
$maniaLink->add($enterLabel);
$enterLabel->setX(10);
$enterLabel->setText('Quit');
$enterLabel->addActionTriggerFeature(\FML\Types\Actionable::ACTION_QUIT);

// Print xml
$maniaLink->render(true);
