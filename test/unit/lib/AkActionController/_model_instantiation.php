<?php

require_once(dirname(__FILE__).'/../../../fixtures/config/config.php');

class AkContionController_model_instantiation_TestCase extends AkWebTestCase
{
    public function test_setup()
    {
        $TestSetup = new AkUnitTest();
        $TestSetup->rebaseAppPaths();
        $TestSetup->installAndIncludeModels(array('Post','Comment','Tag'));
        $Post = $TestSetup->Post->create(array('title'=>'One','body'=>'First post'));
        foreach (range(1,5) as $n){
            $Post->comment->add(new Comment(array('body' => AkInflector::ordinalize($n).' post')));
        }
        $Post->save();
        $Post->reload();
        $Post->comment->load();
        $this->assertEqual($Post->comment->count(), 5);
        $this->post_id = $Post->id;
    }

    public function test_should_access_public_action()
    {
        $this->setMaximumRedirects(0);
        $this->get(AK_TESTING_URL.'/post/comments/'.$this->post_id);
        $this->assertResponse(200);
        $this->assertTextMatch('1st post2nd post3rd post4th post5th post');
    }
}

ak_test_run_case_if_executed('AkContionController_model_instantiation_TestCase');

