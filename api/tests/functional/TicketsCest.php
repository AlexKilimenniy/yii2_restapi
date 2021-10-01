<?php
namespace api\tests\functional;


use api\tests\FunctionalTester;
use common\fixtures\TicketsFixture;

class TicketsCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => TicketsFixture::className(),
                'dataFile' => codecept_data_dir() . 'tickets.php'
            ]
        ];
    }

    /**
     * @param FunctionalTester $I
     */
    public function getList(FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/tickets');
        $I->seeResponseCodeIs(200);
    }

    /**
     * @param FunctionalTester $I
     */
    public function createErrorItem(FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/tickets', []);
        $I->seeResponseCodeIs(422);
    }

    /**
     * @param FunctionalTester $I
     */
    public function createItem(FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/tickets', ['title' => 'Tester1', 'description' => 'From test']);
        $I->seeResponseCodeIs(201);
    }

    /**
     * @param FunctionalTester $I
     */
    public function updateItem(FunctionalTester $I)
    {
        $I->sendAjaxRequest('PUT', '/tickets/1', ['title' => 'Tester1_new', 'description' => 'From new test', 'image' => '/uploads/337cdc4fb7475e307809.jpg']);
        $I->seeResponseCodeIs(200);
    }

    /**
     * @param FunctionalTester $I
     */
    public function getItem(FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/tickets/1');
        $I->seeResponseCodeIs(200);
    }

    /**
     * @param FunctionalTester $I
     */
    public function deleteItem(FunctionalTester $I)
    {
        $I->sendAjaxRequest('DELETE', '/tickets/1');
        $I->seeResponseCodeIs(204);
    }

}