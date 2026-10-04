<?php
// Secure logout handler: ends the authenticated PHP session before returning the customer to the public website.
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
logout_user();
start_session();
set_flash('You have been securely logged out of the DDB demonstration portal.', 'success');
redirect_to('index.php');
