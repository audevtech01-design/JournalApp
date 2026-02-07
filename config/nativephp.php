<?php

return [
    'app' => [
        'name' => 'My Journal',
        'id' => 'com.yourcompany.journal', // Unique identifier
        'version' => '1.0.0',
    ],
    
    'mobile' => [
        'orientation' => 'portrait',
        'splash_screen' => true,
        'permissions' => [
            'camera' => true,
            'storage' => true,
            'notifications' => true,
        ],
    ],
    
    'ios' => [
        'bundle_id' => 'com.yourcompany.journal',
        'team_id' => 'YOUR_TEAM_ID', // From Apple Developer account
        'privacy' => [
            'camera' => 'We need camera access to add photos to your journal entries',
            'photo_library' => 'We need photo library access to save and view your journal photos',
        ],
    ],
    
    'android' => [
        'package_name' => 'com.yourcompany.journal',
        'permissions' => [
            'android.permission.CAMERA',
            'android.permission.READ_EXTERNAL_STORAGE',
            'android.permission.WRITE_EXTERNAL_STORAGE',
        ],
    ],
];