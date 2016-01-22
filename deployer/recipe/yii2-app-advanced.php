<?php
// this recipe has been slightly modified to take different
// environments into account

/* (c) Alexey Rogachev <arogachev90@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/common.php';

/**
 * Yii 2 Advanced Project Template configuration
 */

// Yii 2 Advanced Project Template shared dirs
set('shared_dirs', [
    'frontend/runtime',
    'backend/runtime',
    'console/runtime',
]);

// These cannot be shared (for some reason):
// Yii 2 Advanced Project Template shared files
//set('shared_files', [
//     'common/config/main-local.php',
//     'common/config/params-local.php',
//     'frontend/config/main-local.php',
//     'frontend/config/params-local.php',
//     'backend/config/main-local.php',
//     'backend/config/params-local.php',
//     'console/config/main-local.php',
//     'console/config/params-local.php',
// ]);

/**
 * Initialization
 */
task('deploy:init', function () {
    run('php {{release_path}}/init --env={{app.stage}} --overwrite=n');
})->desc('Initialization');

/**
 * Run migrations
 */
task('deploy:run_migrations', function () {
    run('php {{release_path}}/yii migrate up --interactive=0');
})->desc('Run migrations');

/**
 * Main task
 */
// Migrations turned off - for now
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:init',
    'deploy:symlink',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');
