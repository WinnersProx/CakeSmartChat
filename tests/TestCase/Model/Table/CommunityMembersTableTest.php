<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunityMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunityMembersTable Test Case
 */
class CommunityMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunityMembersTable
     */
    public $CommunityMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.community_members',
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
        $config = TableRegistry::exists('CommunityMembers') ? [] : ['className' => CommunityMembersTable::class];
        $this->CommunityMembers = TableRegistry::get('CommunityMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunityMembers);

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
