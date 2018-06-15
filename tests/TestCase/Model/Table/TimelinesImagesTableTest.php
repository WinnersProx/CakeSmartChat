<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimelinesImagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimelinesImagesTable Test Case
 */
class TimelinesImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimelinesImagesTable
     */
    public $TimelinesImages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.timelines_images'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TimelinesImages') ? [] : ['className' => TimelinesImagesTable::class];
        $this->TimelinesImages = TableRegistry::get('TimelinesImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TimelinesImages);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
