<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .error-hero {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        .error-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .error-code {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(45deg, #6c757d, #495057);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .technical-details {
            font-family: 'SFMono-Regular', Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 0.85em;
        }

        .info-badge {
            font-size: 0.75rem;
            cursor: help;
        }

        .collapsible-section {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .collapsible-section:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }
    </style>
</head>

<body class="error-hero">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-emoji-frown fs-4"></i>
                <span class="ms-2">Error System</span>
            </a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="error-card bg-white p-4 p-md-5 mb-4">
                    <div class="text-center mb-4">
                        <div class="error-code mb-3">404</div>
                        <h1 class="h2 mb-3">Page Not Found</h1>
                        <p class="lead text-muted">
                            The requested URL <code><?= $_SERVER['REQUEST_URI'] ?></code> was not found on this server.
                        </p>
                        <div class="mt-4">
                            <a href="/" class="btn btn-primary px-4">
                                <i class="bi bi-house-door me-2"></i>
                                Return Home
                            </a>
                            <button class="btn btn-outline-secondary px-4 ms-2" onclick="history.back()">
                                <i class="bi bi-arrow-left me-2"></i>
                                Go Back
                            </button>
                        </div>
                    </div>

                    <div class="row g-4 mt-4">
                        <!-- Request Details -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-info-circle me-2"></i>Request Details</span>
                                    <span class="badge bg-primary info-badge" title="Time: <?= $_SERVER['REQUEST_TIME_FLOAT'] ?>">i</span>
                                </div>
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 text-muted">Method:</dt>
                                        <dd class="col-sm-8"><?= $_SERVER['REQUEST_METHOD'] ?></dd>

                                        <dt class="col-sm-4 text-muted">IP Address:</dt>
                                        <dd class="col-sm-8"><?= $_SERVER['REMOTE_ADDR'] ?></dd>

                                        <dt class="col-sm-4 text-muted">Query String:</dt>
                                        <dd class="col-sm-8">
                                            <?php
                                            (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] ? htmlspecialchars($_SERVER['QUERY_STRING']) : 'None') ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Client Info -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <i class="bi bi-pc me-2"></i>Client Information
                                </div>
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 text-muted">User Agent:</dt>
                                        <dd class="col-sm-8 small"><?= $_SERVER['HTTP_USER_AGENT'] ?></dd>

                                        <dt class="col-sm-4 text-muted">Accept:</dt>
                                        <dd class="col-sm-8 small"><?= $_SERVER['HTTP_ACCEPT'] ?? 'N/A' ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Technical Details Sections -->
                    <div class="mt-4">
                        <!-- Server Details -->
                        <div class="card mt-3">
                            <div class="card-header collapsible-section" data-bs-toggle="collapse" href="#serverDetails">
                                <i class="bi bi-server me-2"></i>Server Environment
                            </div>
                            <div class="collapse show" id="serverDetails">
                                <div class="card-body technical-details">
                                    <pre>
                                        <?php
                                        echo htmlspecialchars(json_encode([
                                            'timestamp' => date('c'),
                                            'server' => $_SERVER,
                                            'environment' => $_ENV
                                        ], JSON_PRETTY_PRINT))
                                        ?>
                                    </pre>
                                </div>
                            </div>
                        </div>

                        <!-- Application State -->
                        <div class="card mt-3">
                            <div class="card-header collapsible-section" data-bs-toggle="collapse" href="#appState">
                                <i class="bi bi-gear me-2"></i>Application State
                            </div>
                            <div class="collapse" id="appState">
                                <div class="card-body technical-details">
                                    <pre>
                                        <?php

                                            echo htmlspecialchars(json_encode([
                                                'cookies' => $_COOKIE,
                                                'session' => $_SESSION ?? [],
                                                'files' => $_FILES,
                                                'constants' => get_defined_constants(true)
                                            ], JSON_PRETTY_PRINT))
                                        ?>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="text-center text-muted mt-5">
                        <p class="small">
                            &copy; <?= date('Y') ?>  Error System.
                            <span class="text-muted">Generated in <?php echo round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3) ?></span>
                        </p>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add copy functionality if needed
    </script>
</body>

</html>