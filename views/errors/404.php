<?php

// 404 error page
// This file is part of the application and should be included in the error handling process.
// It is not a standalone file and should not be accessed directly.
// It is included in the error handling process to provide a custom 404 error page.

echo "<h1>404 Not Found</h1>";
echo "<p>The page you are looking for does not exist.</p>";
echo "<p>Please check the URL or go back to the <a href='/'>home page</a>.</p>";
echo "<p>If you think this is a server error, please contact the administrator.</p>";
echo "<p>Request URL: " . htmlspecialchars($_SERVER['REQUEST_URI']) . "</p>";
echo "<p>Request Method: " . htmlspecialchars($_SERVER['REQUEST_METHOD']) . "</p>";
echo "<p>Request Time: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>Request IP: " . htmlspecialchars($_SERVER['REMOTE_ADDR']) . "</p>";
echo "<p>Request User Agent: " . htmlspecialchars($_SERVER['HTTP_USER_AGENT']) . "</p>";
echo "<p>Request Headers: " . htmlspecialchars(json_encode(getallheaders(), JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Query String: " . htmlspecialchars($_SERVER['QUERY_STRING']) . "</p>";
echo "<p>Request Body: " . htmlspecialchars(file_get_contents('php://input')) . "</p>";
echo "<p>Request Cookies: " . htmlspecialchars(json_encode($_COOKIE, JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Session: " . htmlspecialchars(json_encode($_SESSION, JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Files: " . htmlspecialchars(json_encode($_FILES, JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Server: " . htmlspecialchars(json_encode($_SERVER, JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Environment: " . htmlspecialchars(json_encode($_ENV, JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Constants: " . htmlspecialchars(json_encode(get_defined_constants(), JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Functions: " . htmlspecialchars(json_encode(get_defined_functions(), JSON_PRETTY_PRINT)) . "</p>";
echo "<p>Request Classes: " . htmlspecialchars(json_encode(get_declared_classes(), JSON_PRETTY_PRINT)) . "</p>";