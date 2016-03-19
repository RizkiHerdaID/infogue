<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the alert library to build
    | the simple message. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'error'             => [
        'generic'       => 'Ops, something is getting wrong',
        'database'      => 'We have trouble on our server, please try again!',
        'transaction'   => 'Transaction fail to proceed, database rolled back'
    ],
    'feedback'          => [
        'send'          => 'We have received your message and will get in touch shortly, Thanks!',
        'reply'         => 'Feedback ticket #<strong>:id</strong> has been sent to <strong>:email</strong>',
        'important'     => 'Feedback from <strong>:name</strong> marked as important',
        'archived'      => 'Feedback from <strong>:name</strong> marked as archive',
        'delete'        => '<strong>:name</strong>\'s feedback was deleted',
        'delete_all'    => ':count feedbacks were deleted',
    ],
    'setting'           => [
        'update'        => 'Settings have been updated by <strong>:name</strong>',
        'fail'          => 'Unable to save settings, try again!',
    ],
    'contributor'       => [
        'account'       => 'Account has been updated',
        'update'        => 'Contributor <strong>:name</strong> has been updated',
        'delete'        => 'Contributor <strong>:name</strong> was deleted',
        'delete_all'    => ':count contributors were deleted',
    ],
    'article'           => [
        'mark'          => 'The <strong>:title</strong> set :type as <strong>:label</strong>',
        'create'        => 'The <strong>:title</strong> has been created',
        'update'        => 'The <strong>:title</strong> has been updated',
        'delete'        => 'Article <strong>:title</strong> was deleted',
        'delete_all'    => ':count articles were deleted',
    ],
    'category'          => [
        'create'        => 'Category <strong>:category</strong> has been created',
        'update'        => 'Category <strong>:category</strong> has been updated',
        'delete'        => 'Category <strong>:category</strong> and all related subcategories were deleted',
        'delete_all'    => ':count categories were deleted',
    ],
    'subcategory'       => [
        'create'        => 'Subcategory <strong>:subcategory</strong> has been created',
        'update'        => 'Subcategory <strong>:subcategory</strong> has been updated',
        'delete'        => 'Subcategory <strong>:subcategory</strong> and all related articles were deleted',
        'delete_all'    => ':count subcategories were deleted',
    ],
    'message'           => [
        'send'          => 'Your message was sent to <strong>:receiver</strong>',
        'delete'        => 'Conversation with <strong>:receiver</strong> was deleted'
    ],
    'subscribe'         => [
        'broadcast'     => 'Newsletter: Subscribers has been received the newsletter on <strong>:period</strong> period',
        'noupdate'      => 'Newsletter: There is no new article on <strong>:period</strong> period'
    ]
];
