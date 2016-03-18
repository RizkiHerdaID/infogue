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

    'error'                 => [
        'generic'   => 'Ops, something is getting wrong',
        'action'    => ':action :module :status'
    ],
    'feedback'              => [
        'send'          => 'We have received your message and will get in touch shortly, Thanks!',
        'reply'         => 'Feedback ticket #<strong>:id</strong> has been sent to <strong>:email</strong>',
        'important'     => 'Feedback from <strong>:name</strong> marked as important',
        'archived'      => 'Feedback from <strong>:name</strong> marked as archive',
        'delete'        => '<strong>:name</strong>\'s feedback was deleted',
        'delete_all'    => ':count feedbacks were deleted',
    ],
    'setting'               => [
        'update'        => 'Settings have been updated by <strong>:name</strong>',
        'fail'          => 'Unable to save settings, try again!'
    ]

];
