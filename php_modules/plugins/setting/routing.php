<?php 

return [
    'home' => [
        'fnc' => 'facts4me.home.home',
    ],
    'login' => [
        'fnc' => [
            'get' => 'facts4me.home.gate',
            'post' => 'facts4me.home.login',
        ]
    ],
    'about_us' => [
        'fnc' => [
            'get' => 'facts4me.home.about',
        ]
    ],
    'terms' => [
        'fnc' => [
            'get' => 'facts4me.home.terms',
        ]
    ],
    'contact' => [
        'fnc' => [
            'get' => 'facts4me.home.contact',
            'post' => 'facts4me.home.contact_mail',
        ]
    ],
    'tell_friend' => [
        'fnc' => [
            'get' => 'facts4me.home.tellFriend',
            'post' => 'facts4me.home.tellFriend_mail',
        ]
    ],
    'visitor' => [
        'fnc' => [
            'get' => 'facts4me.home.visitor',
        ]
    ],
    'subscription' => [
        'fnc' => [
            'get' => 'facts4me.home.sub',
            'post' => 'facts4me.home.sub',
        ]
    ],
    'renew' => [
        'fnc' => [
            'get' => 'facts4me.home.renew',
            'post' => 'facts4me.home.renew',
        ]
    ],
    'payment' => [
        'fnc' => [
            'get' => 'facts4me.stripe.payment',
            'post' => 'facts4me.payment.payment',
        ]
    ],
    'facts_users' => [
        'fnc' => [
            'get' => 'facts4me.home.facts_users',
        ]
    ],
    'topic_list' => [
        'fnc' => [
            'get' => 'facts4me.home.topic_list',
        ]
    ],
    'topics' => [
        'fnc' => [
            'get' => 'facts4me.home.topics',
            'post' => 'facts4me.home.topics', //search topic
        ],
    ],
    'disp_subject' => [
        'fnc' => [
            'get' => 'facts4me.home.disp_subject',
        ],
    ],
    // 'maint' => [
    //     'fnc' => [
    //         'get' => 'facts4me.admin.maint',
    //     ],
    // ],
    // 'maint/disp_users' => [
    //     'fnc' => [
    //         'get' => 'facts4me.admin.disp_users',
    //     ],
    // ],
    // 'maint/upd_topic' => [
    //     'fnc' => [
    //         'post' => 'facts4me.topic.upd_topic',
    //     ],
    // ],
    // 'maint/upd_topic1' => [
    //     'fnc' => [
    //         'get' => 'facts4me.topic.upd_topic1',
    //         'post' => 'facts4me.topic.add',
    //         'put' => 'facts4me.topic.update',
    //     ],
    // ],
    // 'maint/upd_subject' => [
    //     'fnc' => [
    //         'post' => 'facts4me.subject.upd_subject',
    //     ],
    // ],
    // 'maint/stripe' => [
    //     'fnc' => [
    //         'get' => 'facts4me.stripe.view',
    //         'post' => 'facts4me.stripe.update',
    //     ],
    // ],
    // 'maint/upd_sub_top' => [
    //     'fnc' => [
    //         'post' => 'facts4me.subtop.view',
    //     ],
    // ],
    // 'maint/upd_sub_top1' => [
    //     'fnc' => [
    //         'get' => 'facts4me.subtop.viewSubmit',
    //         'post' => 'facts4me.subtop.save',
    //     ],
    // ],
    // 'maint/upd_subject1' => [
    //     'fnc' => [
    //         'get' => 'facts4me.subject.upd_subject1',
    //         'post' => 'facts4me.subject.add',
    //         'put' => 'facts4me.subject.update',
    //     ],
    // ],
    // 'maint/process_cc' => [
    //     'fnc' => [
    //         'post' => 'facts4me.payment.process',
    //     ],
    // ],
    // 'maint/upd_user' => [
    //     'fnc' => [
    //         'post' => 'facts4me.user.view',
    //     ],
    // ],
    // 'maint/upd_user1' => [
    //     'fnc' => [
    //         'post' => 'facts4me.user.save',
    //     ],
    // ],
    'logout' => 'facts4me.home.logout',
    '/admin' => 'facts4me.subject.list',
    'admin' => [
        'users'=>[
            'fnc' => [
                'get' => 'facts4me.user.list',
                'post' => 'facts4me.user.list',
                'delete' => 'facts4me.user.delete'
            ],
        ],
        'user' => [
            'fnc' => [
                'get' => 'facts4me.user.detail',
                'post' => 'facts4me.user.add',
                'put' => 'facts4me.user.update',
                'delete' => 'facts4me.user.delete'
            ],
            'parameters' => ['id'],
        ],
        'posts' => [
            'fnc' => [
                'get' => 'facts4me.post.list',
                'post' => 'facts4me.post.list',
                'delete' => 'facts4me.post.delete'
            ],
        ],
        'post' => [
            'fnc' => [
                'get' => 'facts4me.post.detail',
                'post' => 'facts4me.post.add',
                'put' => 'facts4me.post.update',
                'delete' => 'facts4me.post.delete'
            ],
            'parameters' => ['id'],
        ],
        'topics'=>[
            'fnc' => [
                'get' => 'facts4me.topic.list',
                'post' => 'facts4me.topic.list',
                'delete' => 'facts4me.topic.delete'
            ],
        ],
        'topic' => [
            'fnc' => [
                'get' => 'facts4me.topic.detail',
                'post' => 'facts4me.topic.add',
                'put' => 'facts4me.topic.update',
                'delete' => 'facts4me.topic.delete'
            ],
            'parameters' => ['id'],
        ],

        'subjects'=>[
            'fnc' => [
                'get' => 'facts4me.subject.list',
                'post' => 'facts4me.subject.list',
                'delete' => 'facts4me.subject.delete'
            ],
        ],
        'subject' => [
            'fnc' => [
                'get' => 'facts4me.subject.detail',
                'post' => 'facts4me.subject.add',
                'put' => 'facts4me.subject.update',
                'delete' => 'facts4me.subject.delete'
            ],
            'parameters' => ['id'],
        ],
        'transactions'=>[
            'fnc' => [
                'get' => 'facts4me.transaction.list',
                'post' => 'facts4me.transaction.list',
                'delete' => 'facts4me.transaction.delete'
            ],
        ],
        'transaction' => [
            'fnc' => [
                'get' => 'facts4me.transaction.detail',
                'post' => 'facts4me.transaction.add',
                'put' => 'facts4me.transaction.update',
                'delete' => 'facts4me.transaction.delete'
            ],
            'parameters' => ['id'],
        ],
        'email_tmps'=>[
            'fnc' => [
                'get' => 'facts4me.email.list',
                'post' => 'facts4me.email.list',
                'delete' => 'facts4me.email.delete'
            ],
        ],
        'email_tmp' => [
            'fnc' => [
                'get' => 'facts4me.email.detail',
                'post' => 'facts4me.email.add',
                'put' => 'facts4me.email.update',
                'delete' => 'facts4me.email.delete'
            ],
            'parameters' => ['id'],
        ],
        'email_logs'=>[
            'fnc' => [
                'get' => 'facts4me.email.list',
                'post' => 'facts4me.email.list',
                'delete' => 'facts4me.email.delete'
            ],
        ],
        'email_log' => [
            'fnc' => [
                'get' => 'facts4me.email.detail',
                'post' => 'facts4me.email.add',
                'put' => 'facts4me.email.update',
                'delete' => 'facts4me.email.delete'
            ],
            'parameters' => ['id'],
        ],
        'setting'=>[
            'fnc' => [
                'get' => 'sdm.setting.form',
                'post' => 'sdm.setting.save',
            ],
        ],
        'login' => [
            'fnc' => [
                'get' => 'facts4me.admin.gate',
                'post' => 'facts4me.admin.login',
            ]
        ],
        'logout' => 'facts4me.admin.logout',
        'renew-special' => [
            'fnc' => [
                'post' => 'facts4me.user.renew',
            ]
        ],
        // 'topics' => 'facts4me.admin.list_topic',
        // 'form_topic' => 'facts4me.admin.form_topic',
        // 'users' => 'facts4me.admin.list_user',
        // 'form_user' => 'facts4me.admin.form_user',
        // 'subjects' => 'facts4me.admin.list_subject',
        // 'form_subject' => 'facts4me.admin.form_subject',
        // 'login' => 'facts4me.admin.login',
    ],
];
