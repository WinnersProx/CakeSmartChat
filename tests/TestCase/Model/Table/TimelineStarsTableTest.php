<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimelineStarsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimelineStarsTable Test Case
 */
class TimelineStarsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimelineStarsTable
     */
    public $TimelineStars;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.timeline_stars',
        'app.s',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TimelineStars') ? [] : ['className' => TimelineStarsTable::class];
        $this->TimelineStars = TableRegistry::get('TimelineStars', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TimelineStars);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
