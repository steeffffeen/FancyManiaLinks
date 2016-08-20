<?php

use FML\Elements\Dico;
use FML\Elements\Including;
use FML\ManiaLink;
use FML\Script\Script;
use FML\Stylesheet\Stylesheet;

class ManiaLinkTest extends \PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        $child     = new Including();
        $maniaLink = ManiaLink::create("test-id", "test-name", array($child));

        $this->assertTrue($maniaLink instanceof ManiaLink);
        $this->assertEquals("test-id", $maniaLink->getId());
        $this->assertEquals("test-name", $maniaLink->getName());
        $this->assertEquals(array($child), $maniaLink->getChildren());
    }

    public function testConstruct()
    {
        $child     = new Including();
        $maniaLink = new ManiaLink("some-id", "some-name", array($child));

        $this->assertEquals("some-id", $maniaLink->getId());
        $this->assertEquals("some-name", $maniaLink->getName());
        $this->assertEquals(array($child), $maniaLink->getChildren());
    }

    public function testId()
    {
        $maniaLink = new ManiaLink();

        $this->assertNull($maniaLink->getId());
        $this->assertNull($maniaLink->getName());

        $this->assertSame($maniaLink, $maniaLink->setId("test-id"));

        $this->assertEquals("test-id", $maniaLink->getId());
        $this->assertEquals("test-id", $maniaLink->getName());

        $this->assertSame($maniaLink, $maniaLink->setId("new-id"));

        $this->assertEquals("new-id", $maniaLink->getId());
        $this->assertEquals("test-id", $maniaLink->getName());
    }

    public function testName()
    {
        $maniaLink = new ManiaLink();

        $this->assertNull($maniaLink->getName());

        $this->assertSame($maniaLink, $maniaLink->setName("test-name"));

        $this->assertEquals("test-name", $maniaLink->getName());
    }

    public function testBackground()
    {
        $maniaLink = new ManiaLink();

        $this->assertNull($maniaLink->getBackground());

        $this->assertSame($maniaLink, $maniaLink->setBackground("test-background"));

        $this->assertEquals("test-background", $maniaLink->getBackground());
    }

    public function testNavigable3d()
    {
        $maniaLink = new ManiaLink();

        $this->assertTrue($maniaLink->getNavigable3d());

        $this->assertSame($maniaLink, $maniaLink->setNavigable3d(false));

        $this->assertFalse($maniaLink->getNavigable3d());
    }

    public function testTimeout()
    {
        $maniaLink = new ManiaLink();

        $this->assertNull($maniaLink->getTimeout());

        $this->assertSame($maniaLink, $maniaLink->setTimeout(13));

        $this->assertEquals(13, $maniaLink->getTimeout());
    }

    public function testChildren()
    {
        $maniaLink   = new ManiaLink();
        $firstChild  = new Including();
        $secondChild = new Including();

        $this->assertEmpty($maniaLink->getChildren());

        $this->assertSame($maniaLink, $maniaLink->addChild($firstChild));

        $this->assertEquals(array($firstChild), $maniaLink->getChildren());

        $this->assertSame($maniaLink, $maniaLink->addChild($secondChild));
        $this->assertSame($maniaLink, $maniaLink->addChild($firstChild));

        $this->assertEquals(array($firstChild, $secondChild), $maniaLink->getChildren());

        $this->assertSame($maniaLink, $maniaLink->removeAllChildren());

        $this->assertEmpty($maniaLink->getChildren());
    }

    public function testDico()
    {
        $maniaLink = new ManiaLink();
        $dico      = new Dico();

        $this->assertNull($maniaLink->getDico());

        $this->assertSame($maniaLink, $maniaLink->setDico($dico));

        $this->assertSame($dico, $maniaLink->getDico());

        $this->assertSame($maniaLink, $maniaLink->setDico(null));

        $this->assertNull($maniaLink->getDico());
    }

    public function testStylesheet()
    {
        $maniaLink  = new ManiaLink();
        $stylesheet = new Stylesheet();

        $this->assertNull($maniaLink->getStylesheet());

        $this->assertSame($maniaLink, $maniaLink->setStylesheet($stylesheet));

        $this->assertSame($stylesheet, $maniaLink->getStylesheet());

        $this->assertSame($maniaLink, $maniaLink->setStylesheet(null));

        $this->assertNull($maniaLink->getStylesheet());
    }

    public function testScript()
    {
        $maniaLink = new ManiaLink();
        $script    = new Script();

        $this->assertNull($maniaLink->getScript());

        $this->assertSame($maniaLink, $maniaLink->setScript($script));

        $this->assertSame($script, $maniaLink->getScript());
        $this->assertSame($script, $maniaLink->createScript());
        $this->assertSame($script, $maniaLink->getScript());

        $this->assertSame($maniaLink, $maniaLink->setScript(null));

        $this->assertNull($maniaLink->getScript());

        $createdScript = $maniaLink->createScript();

        $this->assertTrue($createdScript instanceof Script);
        $this->assertSame($createdScript, $maniaLink->getScript());
        $this->assertSame($createdScript, $maniaLink->createScript());
        $this->assertSame($createdScript, $maniaLink->getScript());
    }

    public function testRender()
    {
        $maniaLink = new ManiaLink();
        $maniaLink->setId("some-id")
                  ->setName("some-name")
                  ->setBackground("some-background")
                  ->setNavigable3d(false)
                  ->setTimeout(42)
                  ->addChild(new Including())
                  ->setDico(new Dico())
                  ->setStylesheet(new Stylesheet())
                  ->setScript(new Script());

        $domDocument = $maniaLink->render();

        $this->assertEquals("<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?>
<manialink version=\"1\" id=\"some-id\" name=\"some-name\" background=\"some-background\" navigable3d=\"0\"><timeout>42</timeout><dico/><include/><stylesheet/></manialink>
", $domDocument->saveXML());
    }

    public function testRenderWithScript()
    {
        $maniaLink = new ManiaLink();
        $script    = new Script();
        $script->addCustomScriptLabel("some-label", "some-code");
        $maniaLink->setScript($script);

        $domDocument = $maniaLink->render();

        $this->assertNotEquals("<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?>
<manialink version=\"1\"/>
", $domDocument->saveXML());
    }

    public function testToString()
    {
        $maniaLink = new ManiaLink();

        $this->assertEquals("<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?>
<manialink version=\"1\"/>
", (string)$maniaLink);
    }

}