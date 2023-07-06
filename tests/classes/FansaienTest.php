<?php namespace October\Test\Tests\Classes;


use Backend\Widgets\Form;
use Model;
use PluginTestCase;
use System\Classes\PluginManager;


class FansaienTest extends PluginTestCase
{
    public function testCleanSaveDataInternal()
    {
        $form = new Form(null, [
            'model' => new class extends Model {},
            'fields' => [
                'name' => [
                    'label' => 'Author Name',
                    'commentAbove' => 'Text field, inside a popup.',
                ],
                'post[name]' => [
                    'comment' => 'This Comment belongs to the Post selected above.',
                    'disabled' => true
                ]
            ]
        ]);

        self::callProtectedMethod($form, 'defineFormFields');

        // $data = self::callProtectedMethod($form, 'cleanSaveDataInternal', [[
        //     'name' => 'First Level',
        //     'post' => ['name' => 'Second Level']
        // ]]);

        $data = self::callProtectedMethod($form, 'cleanSaveDataInternal', [[
            'name' => 'First Level'
        ]]);

        $this->assertEquals([
            'name' => 'First Level'
        ], $data);
    }
}