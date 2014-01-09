<?php
// TODO: validate example
// Include FML
require_once __DIR__ . '/../FML/autoload.php';

// Create manialink
$manialink = new \FML\ManiaLink();

// Create entry element to allow input
$entry = new \FML\Controls\Entry();
$manialink->add($entry);
$entry->setName('input');
$entry->setDefault('This is fun!');

// Add submit button
$submitButton = new \FML\Controls\Quads\Quad_Icons64x64_1();
$manialink->add($submitButton);
$submitButton->setSize(10, 10);
$submitButton->setX(40);
$submitButton->setSubStyle($submitButton::SUBSTYLE_Outbox);
$submitButton->setUrl('http://fml.steeffeen.com/examples/entry.php');

// Display input if any is given
if (!empty($_GET['input'])) {
	$outputLabel = new \FML\Controls\Label();
	$manialink->add($outputLabel);
	$outputLabel->setY(-30);
	$outputLabel->setText("Your Input: '{$_GET['input']}'");
}

// Print xml
$manialink->render(true);