<?php

return [
    'paths' => ['api/*'], // Đường dẫn cần cho phép
    'allowed_methods' => ['*'], // Cho phép tất cả phương thức HTTP
    'allowed_origins' => ['*'], // Cho phép tất cả nguồn gốc (hoặc thêm domain cụ thể)
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Cho phép tất cả header
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
